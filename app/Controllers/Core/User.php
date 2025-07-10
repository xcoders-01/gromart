<?php

namespace App\Controllers\Core;

use App\Models\StoreModel;
use App\Models\StoreUserModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    protected  $userModel, $storeModel, $storeUserModel, $define_url = '/core/user';
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->storeModel = new StoreModel();
        $this->storeUserModel = new StoreUserModel();
        if (session()->get('user')['level_id'] != 1) $this->define_url = '/user';
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $users = $this->userModel->userRecord();
        $level_id = getLevel('id');
        if ($level_id == 1) $users = $users->get()->getResultArray();
        else if ($level_id != 1) {
            $store_users = getRecord($this->storeUserModel, ['store_id' => getStoreId()], 'user_id')->get()->getResultArray();
            $arr = array_column($store_users, 'user_id');
            if (!empty($store_users))
                $users = $users->where('level_id !=', 1)->whereIn('u.id', $arr)->get()->getResultArray();
            else $users = [];
        }

        $data = [
            'users' => $users,
            'submenu' => 'user',
            'level_id' => $level_id,
            'menu' => 'master_data',
            'subtitle' => 'Pengguna',
            'title' => 'Master Data',
            'page' => 'pages/core/user',
        ];

        return view('layouts/default', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        return $this->response->setJSON($this->userModel->find($id));
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = $this->validate([
            'name' => [
                'rules'  => 'required|min_length[3]|',
                'errors' => validationError('unit_name'),
            ],
            'email' => [
                'rules'  => 'permit_empty|valid_email|min_length[3]|is_unique[users.email]',
                'errors' => validationError('email'),
            ],
            'username' => [
                'rules'  => 'required|min_length[4]|is_unique[users.username]',
                'errors' => validationError('username'),
            ],
        ]);
        if (!$validation) {
            $errno = $this->validator->getErrors();
            $err_val = array_values($errno);
            $err_msg = $err_val[0];
            session()->setFlashdata('error', $err_msg);
        } else {
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'level_id' => $this->request->getPost('level_id'),
            ];

            $this->userModel->insert($data);
            if (session()->get('user')['level_id'] != 1) {
                $this->storeUserModel->insert([
                    'store_id' => getStoreId(),
                    'user_id' => $this->userModel->getInsertID(),
                ]);
            }
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        }

        return redirect()->to(base_url($this->define_url));
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $validation = $this->validate([
            'email' => [
                'rules'  => "permit_empty|valid_email|min_length[3]|is_unique[users.email,id,{$id}]",
                'errors' => validationError('email'),
            ],
            'username' => [
                'rules'  => "required|min_length[4]|is_unique[users.username,id,{$id}]",
                'errors' => validationError('username'),
            ],
        ]);
        if (!$validation) {
            $errno = $this->validator->getErrors();
            $err_val = array_values($errno);
            $err_msg = $err_val[0];
            session()->setFlashdata('error', $err_msg);
        } else {
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'status' => $this->request->getPost('status'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'level_id' => $this->request->getPost('level_id'),
            ];
            if (empty($this->request->getPost('password')))
                unset($data['password']);
            $this->userModel->update($id, $data);
            session()->setFlashdata('success', 'Data Berhasil Diperbaharui');
        }

        return redirect()->to(base_url($this->define_url));
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $unit = $this->userModel->find($id);
        if (empty($unit))
            session()->setFlashdata('error', 'Data Tidak Ditemukan');
        else {
            $this->storeUserModel->where('user_id', $id)->delete();
            $this->userModel->delete($id);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
        }
        return redirect()->to(base_url($this->define_url));
    }
}
