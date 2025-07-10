<?php

namespace App\Controllers\Core;

use App\Models\StoreModel;
use App\Models\StoreUserModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Store extends ResourceController
{

    protected  $storeModel, $userModel, $storeUserModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->storeModel = new StoreModel();
        $this->storeUserModel = new StoreUserModel();
    }

    public function index()
    {
        $data = [
            'page' => 'pages/core/store',
            'submenu' => 'store',
            'subtitle' => 'Toko',
            'menu' => 'master_data',
            'title' => 'Master Data',
            'user_model' => $this->userModel,
            'stores' => $this->storeModel->findAll(),
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
        $store_users = $this->storeUserModel->where('store_id', $id)->findAll();
        $arr = array_column($store_users, 'user_id');
        return $this->response->setJSON(['store' => $this->storeModel->find($id), 'store_users' => $arr]);
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
                'rules'  => 'required|min_length[3]|is_unique[stores.name]',
                'errors' => validationError('store_name'),
            ],
        ]);

        if (!$validation)
            session()->setFlashdata('error', $this->validator->getErrors()['name']);
        else {
            $user_id = $this->request->getPost('user_id_new');
            $data = [
                'name' => $this->request->getPost('name'),
                'telp' => $this->request->getPost('telp'),
                'address' => $this->request->getPost('address'),
            ];
            $this->storeModel->insert($data);

            if (!empty($user_id)) {
                $store = $this->storeModel->find($this->storeModel->getInsertID());
                foreach ($user_id as  $user) {
                    $this->storeUserModel->insert([
                        'store_id' => $store['id'],
                        'user_id' => $user,
                    ]);
                }
            }
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        }

        return redirect()->to(base_url('core/store'));
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
            'name' => [
                'rules'  => "required|min_length[2]|is_unique[stores.name,id,{$id}]",
                'errors' => validationError('store_name'),
            ],
        ]);

        if (!$validation)
            session()->setFlashdata('error', $this->validator->getErrors()['name']);
        else {
            $this->storeUserModel->where('store_id', $id)->delete();
            $user_id = $this->request->getPost('user_id_edit');

            if (!empty($user_id))
                foreach ($user_id as  $user)
                    $this->storeUserModel->insert([
                        'store_id' => $id,
                        'user_id' => $user,
                    ]);

            $data = [
                'name' => $this->request->getPost('name'),
                'telp' => $this->request->getPost('telp'),
                'status' => $this->request->getPost('status'),
                'address' => $this->request->getPost('address'),
            ];

            $this->storeModel->update($id, $data);
            session()->setFlashdata('success', 'Data Berhasil Diperbaharui');
        }

        return redirect()->to(base_url('core/store'));
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
        $unit = $this->storeModel->find($id);
        if (empty($unit))
            session()->setFlashdata('error', 'Data Tidak Ditemukan');
        else {
            $this->storeUserModel->where('store_id', $id)->delete();
            $this->storeModel->delete($id);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
        }
        return redirect()->to(base_url('core/store'));
    }

    function storeUser()
    {
        $store_users = $this->storeUserModel->findAll();
        $arr = array_column($store_users, 'user_id');
        if ($this->request->getGet('status') == 'edit') {
            $store_id = $this->request->getGet('store_id');
            $store_users_search = $this->storeUserModel->where('store_id', $store_id)->findAll();
            if (!empty($store_users_search)) {
                $arr_search = array_column($store_users_search, 'user_id');
                foreach ($arr_search as $value) {
                    $pos = array_search($value, $arr);
                    if ($pos !== false) {
                        unset($arr[$pos]);
                    }
                }
            }
        }

        $unlisted_user = $this->userModel;
        if (!empty($arr)) $unlisted_user = $unlisted_user->whereNotIn('id', $arr);
        $unlisted_user = $unlisted_user->where('level_id >=', '2')
            ->select('id, CONCAT(name, " ( ", username," )") as text ')
            ->get()->getResultArray();
        return $this->response->setJSON($unlisted_user);
    }
}
