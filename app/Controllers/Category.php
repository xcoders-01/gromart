<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{
    protected  $store_id, $categoryModel;
    public function __construct()
    {
        $this->store_id = getStoreId();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        // for insert data default
        // $store_id =  $this->store_id;
        // $default = $this->categoryModel->data_default;
        // $data_with_store_id = array_map(function ($item) use ($store_id) {
        //     $item['store_id'] = $store_id;
        //     return $item;
        // }, $default);
        // $this->categoryModel->insertBatch($data_with_store_id);

        $categories = baseStore($this->categoryModel)->orderBy('name', 'asc')->findAll();
        $data = [
            'submenu' => 'category',
            'menu' => 'master_data',
            'subtitle' => 'Kategori',
            'title' => 'Master Data',
            'page' => 'pages/category',
            'categories' => $categories,
        ];

        return view('layouts/default', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $category_name = $this->request->getPost('name');
        if (baseStore($this->categoryModel)->where('name', $category_name)->first())
            session()->setFlashdata('error', 'Nama Kategori Sudah Tersedia.');
        else {
            $data = [
                'name' => $category_name,
                'store_id' => $this->store_id,
            ];
            $this->categoryModel->insert($data);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        }

        return redirect()->to(base_url('category'));
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
        $category_name = $this->request->getPost('name');
        $category = baseStore($this->categoryModel)->where(['name' => $category_name, 'id != ' => $id])->first();
        if ($category)
            session()->setFlashdata('error', 'Nama Kategori Sudah Tersedia.');
        else {
            $data = [
                'name' => $category_name,
            ];
            $this->categoryModel->update($id, $data);
            session()->setFlashdata('success', 'Data Berhasil Diperbaharui');
        }

        return redirect()->to(base_url('category'));
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
        $category = $this->categoryModel->find($id);
        if (empty($category))
            session()->setFlashdata('error', 'Data Tidak Ditemukan');
        else {
            $this->categoryModel->delete($id);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
        }
        return redirect()->to(base_url('category'));
    }
}
