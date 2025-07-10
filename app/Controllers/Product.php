<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UnitModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Product extends ResourceController
{
    protected $store_id, $productModel, $unitModel, $categoryModel;

    public function __construct()
    {
        $this->store_id = getStoreId();
        $this->unitModel = new UnitModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $products = $this->productModel->productRelation(['p.store_id' => $this->store_id])->orderBy('p.id', 'desc')->get()->getResultArray();

        $data = [
            'submenu' => 'product',
            'subtitle' => 'Produk',
            'menu' => 'master_data',
            'products' => $products,
            'title' => 'Master Data',
            'page' => 'pages/product',
            'units' => baseStore($this->unitModel)->orderBy('name', 'asc')->findAll(),
            'categories' => baseStore($this->categoryModel)->orderBy('name', 'asc')->findAll(),
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
        return $this->response->setJSON($this->productModel->find($id));
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
        $product_code = $this->request->getPost('code');
        $product_name = $this->request->getPost('name');
        if (baseStore($this->productModel)->where('code', $product_code)->first())
            session()->setFlashdata('error', 'Kode Produk Sudah Tersedia.');
        else if (baseStore($this->productModel)->where('name', $product_name)->first())
            session()->setFlashdata('error', 'Nama Produk Sudah Tersedia.');
        else {
            $data = [
                'code' => $product_code,
                'name' => $product_name,
                'unit_id' => $this->request->getPost('unit_id'),
                'category_id' => $this->request->getPost('category_id'),
                'purchase_price' => replaceString($this->request->getPost('purchase_price'), '.', ''),
                'selling_price' => replaceString($this->request->getPost('selling_price'), '.', ''),
                'stock' => $this->request->getPost('stock'),
                'store_id' => $this->store_id,
            ];
            $this->productModel->insert($data);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        }

        return redirect()->to(base_url('product'));
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
        $product_code = $this->request->getPost('code');
        $product_name = $this->request->getPost('name');
        if (baseStore($this->productModel)->where(['code' => $product_code, 'id != ' => $id])->first())
            session()->setFlashdata('error', 'Kode Produk Sudah Tersedia.');
        else if (baseStore($this->productModel)->where(['name' => $product_name, 'id != ' => $id])->first())
            session()->setFlashdata('error', 'Nama Produk Sudah Tersedia.');
        else {
            $data = [
                'code' => $product_code,
                'name' => $product_name,
                'unit_id' => $this->request->getPost('unit_id'),
                'category_id' => $this->request->getPost('category_id'),
                'purchase_price' => replaceString($this->request->getPost('purchase_price'), '.', ''),
                'selling_price' => replaceString($this->request->getPost('selling_price'), '.', ''),
                'stock' => $this->request->getPost('stock'),
            ];
            $this->productModel->update($id, $data);
            session()->setFlashdata('success', 'Data Berhasil Diperbaharui');
        }

        return redirect()->to(base_url('product'));
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
        $product = $this->productModel->find($id);
        if (empty($product))
            session()->setFlashdata('error', 'Data Tidak Ditemukan');
        else {
            $this->productModel->delete($id);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
        }
        return redirect()->to(base_url('product'));
    }

    public function fetchProduct()
    {
        $product_code = $this->request->getPost('product_code');
        $product = $this->productModel->productRelation()->where(['p.code' => $product_code])->get()->getFirstRow();

        return $this->response->setJSON($product);
    }

    public function productMoreZero()
    {
        $products = $this->productModel->productRelation(['p.store_id' => $this->store_id, 'p.stock >' => '0'])->orderBy('p.id', 'desc')->get()->getResultArray();

        return $this->response->setJSON($products);
    }
}
