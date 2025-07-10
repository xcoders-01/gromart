<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\TemporaryOrderModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CartHandler extends ResourceController
{
    protected $user_id, $store_id, $orderModel, $productModel, $temporaryOrderModel;

    public function __construct()
    {
        $this->store_id = getStoreId();
        $this->orderModel = new OrderModel();
        $this->productModel = new ProductModel();
        $this->user_id = session()->get('user')['id'];
        $this->temporaryOrderModel = new TemporaryOrderModel();
    }

    public function index() {}

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
        $success = true;
        $message = 'Data Berhasil Diperbaharui';
        $quantity = $this->request->getPost('qty');

        $product = baseStore($this->productModel)->where('code', $this->request->getPost('code'))->first();
        if ($product['stock'] < $quantity) {
            $success = false;
            $message = 'Stok Tidak Cukup, tersisa : ' . $product['stock'];
        } else {
            $search_to = [
                'user_id' => $this->user_id,
                'store_id' => $this->store_id,
                'product_code' => $product['code'],
            ];
            $temp_order = $this->temporaryOrderModel->where($search_to)->first();

            if (!$temp_order) {
                $data = [
                    'quantity' => $quantity,
                    'user_id' => $this->user_id,
                    'store_id' => $this->store_id,
                    'product_code' => $product['code'],
                    'product_name' => $product['name'],
                    'purchase_price' => $product['purchase_price'],
                    'price' => $product['selling_price'],
                    'unit_name' => $this->request->getPost('unit'),
                    'subtotal' => $product['selling_price'] * $quantity,
                    'category_name' => $this->request->getPost('category'),

                ];

                $this->temporaryOrderModel->insert($data);
            } else {
                $new_qty = $temp_order['quantity'] + $quantity;
                if ($new_qty > $product['stock']) {
                    $success = false;
                    $message = 'Stok Tidak Cukup, tersisa : ' . $product['stock'];
                } else {
                    $data = [
                        'quantity' => $new_qty,
                        'subtotal' => $new_qty * $product['selling_price'],
                    ];
                    $this->temporaryOrderModel->where($search_to)->update($product['code'], $data);
                }
            }
        }

        return $this->response->setJSON(['success' => $success, 'message' => $message]);
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
        //
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
        baseStore($this->temporaryOrderModel)->where(['user_id' => $this->user_id])->delete();

        return redirect()->to(base_url('sales'));
    }
}
