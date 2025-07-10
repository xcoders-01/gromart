<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\TemporaryOrderModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Session;

class Sales extends ResourceController
{
    protected $user_id, $store_id, $productModel, $temporaryOrderModel, $orderModel, $orderDetailModel;

    public function __construct()
    {
        $this->store_id = getStoreId();
        $this->productModel = new ProductModel();
        $this->user_id = session()->get('user')['id'];
        $this->orderModel = new OrderModel();
        $this->orderDetailModel = new OrderDetailModel();
        $this->temporaryOrderModel = new TemporaryOrderModel();
    }

    public function index()
    {
        $no_invoice = noInvoice();
        $total_items = $grand_total = 0;
        $condition = ['user_id' => $this->user_id];
        $carts = baseStore($this->temporaryOrderModel)->where($condition)->get()->getResultArray();
        if ($carts) {
            $total_items = count($carts);

            $grand_total = baseStore($this->temporaryOrderModel)->where($condition)->selectSum('subtotal')->get()->getFirstRow();
            if ($grand_total) $grand_total = $grand_total->subtotal;
        }

        $products = $this->productModel->productRelation(['p.store_id' => $this->store_id, 'p.stock >' => '0'])->orderBy('p.id', 'desc')->get()->getResultArray();
        $data = [
            'carts' => $carts,
            'title' => 'Penjualan',
            'products' => $products,
            'no_invoice' => $no_invoice,
            'grand_total' => $grand_total,
            'page' => 'pages/sales/index',
            'total_items' => $total_items,
        ];
        return view('layouts/sales', $data);
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
        $success = true;
        $no_invoice = noInvoice();
        $message = 'Transaksi Pembayaran Berhasil';

        $grand_total = replaceString($this->request->getPost('grand_total'), '.', '');
        $payment_total = replaceString($this->request->getPost('payment_total'), '.', '');
        $payment_change = replaceString($this->request->getPost('payment_change'), '.', '');
        if ($grand_total > $payment_total) {
            $success = false;
            $message = 'Nominal pembayaran masih kurang';
        } else {
            // checking product stock
            $carts = baseStore($this->temporaryOrderModel)->where(['user_id' => $this->user_id])->get()->getResultArray();
            foreach ($carts as $cart) {
                $product = baseStore($this->productModel)->where(['code' => $cart['product_code'], 'store_id' => $this->store_id])->get()->getFirstRow();
                if ($product->stock < $cart['quantity']) {
                    $success = false;
                    $message = 'Stok tidak cukup (' . $product->name . '), tersisa : ' . $product->stock;
                }
            }
            if ($success) {
                $data_order = [
                    'id' => $no_invoice,
                    'payment' => $payment_total,
                    'change' => $payment_change,
                    'user_id' => $this->user_id,
                    'sales_date' => date('Y-m-d'),
                    'sales_time' => date('H:i:s'),
                    'grand_total' => $grand_total,
                    'store_id' => $this->store_id
                ];
                $this->orderModel->insert($data_order);
                $order = baseStore($this->orderModel)->where(['id' => $no_invoice])->get()->getFirstRow();
                if ($order) {
                    $purchase = 0;
                    foreach ($carts as $cart) {
                        $purchase += $cart['purchase_price'] * $cart['quantity'];
                        $data_detail = [
                            'order_id' => $no_invoice,
                            'price' => $cart['price'],
                            'user_id' => $this->user_id,
                            'store_id' => $this->store_id,
                            'quantity' => $cart['quantity'],
                            'subtotal' => $cart['subtotal'],
                            'unit_name' => $cart['unit_name'],
                            'product_code' => $cart['product_code'],
                            'product_name' => $cart['product_name'],
                            'category_name' => $cart['category_name'],
                            'purchase_price' => $cart['purchase_price'],
                        ];
                        $this->orderDetailModel->insert($data_detail);
                        $product = baseStore($this->productModel)->where(['code' => $cart['product_code'], 'store_id' => $this->store_id])->get()->getFirstRow();
                        if ($product)
                            baseStore($this->productModel)->where(['code' => $cart['product_code'], 'store_id' => $this->store_id])
                                ->update($product->id, ['stock' => ($product->stock - $cart['quantity'])]);
                    }

                    baseStore($this->orderModel)->where(['id' => $no_invoice])
                        ->update($order->id, ['purchase_total' => $purchase]);
                    $this->temporaryOrderModel->where(['user_id' => $this->user_id])->delete();
                }
            }
        }
        session()->setFlashdata('success', $message);
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
        $this->temporaryOrderModel->where([
            'product_code' => $id,
            'store_id' => getStoreId(),
            'user_id' => $this->user_id,
        ])->delete();
        return $this->response->setJSON(['success' => true]);
    }
}
