<?php

namespace App\Controllers;

use App\Models\StoreModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Setting extends ResourceController
{
    protected $store_id, $storeModel;
    public function __construct()
    {
        $this->store_id = getStoreId();
        $this->storeModel = new StoreModel();
    }
    public function index()
    {
        $data = [
            'submenu' => '',
            'subtitle' => '',
            'page' => 'pages/setting',
            'menu' => 'setting',
            'title' => 'Pengaturan',
            'store' => $this->storeModel->find($this->store_id),
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
        //
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
        //
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
        $data = [
            'name' => $this->request->getPost('name'),
            'telp' => $this->request->getPost('telp'),
            'address' => $this->request->getPost('address'),
        ];

        $this->storeModel->update($id, $data);
        session()->setFlashdata('success', 'Data Berhasil Diperbaharui');
        return redirect()->to(base_url('setting'));
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
        //
    }
}
