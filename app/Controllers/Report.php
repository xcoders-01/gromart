<?php

namespace App\Controllers;

use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\StoreModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Report extends ResourceController
{
    protected $store_id, $storeModel, $productModel, $orderModel, $orderDetailModel;

    public function __construct()
    {
        $this->store_id = getStoreId();
        $this->orderModel = new OrderModel();
        $this->storeModel = new StoreModel();
        $this->productModel = new ProductModel();
        $this->orderDetailModel = new OrderDetailModel();
    }
    public function index()
    {
        $data = [
            'submenu' => '',
            'subtitle' => '',
            'page' => 'report/index',
            'menu' => 'report',
            'title' => 'Laporan',
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
    public function show($type = null)
    {
        $data = [];
        if ($type == 'product') {
            $products = $this->productModel->productRelation(['p.store_id' => $this->store_id])->orderBy('p.name', 'desc')->get()->getResultArray();
            $data = [
                'products' => $products,
                'title' => 'Laporan Data Produk',
                'store' => $this->storeModel->find($this->store_id),
                'page' => 'report/print_product',
            ];
        } elseif ($type == 'daily') {
            $date = $this->request->getGet('date');
            $date = str_replace('-', '', $date);
            $ct_table = $date != '' ? $this->orderDetailModel->dailyReport($this->store_id, $date)->get()->getResultArray() : [];
            $data = [
                'title' => 'Laporan Penjualan Harian',
                'store' => $this->storeModel->find($this->store_id),
                'page' => 'report/daily_table',
                'ct_table' => $ct_table
            ];
        } elseif ($type == 'monthly') {
            $year = $this->request->getGet('year');
            $month = $this->request->getGet('month');
            $my_search = $year . '-' . $month;
            $ct_table = $this->orderModel->monthlyReport($this->store_id, $my_search)->get()->getResultArray();
            $data = [
                'title' => 'Laporan Penjualan Bulanan',
                'store' => $this->storeModel->find($this->store_id),
                'page' => 'report/monthly_table',
                'ct_table' => $ct_table,
                'month' => $month,
                'year' => $year
            ];
        } elseif ($type == 'yearly') {
            $year = $this->request->getGet('year');
            $ct_table = $this->orderModel->yearlyReport($this->store_id, $year)->get()->getResultArray();
            $data = [
                'title' => 'Laporan Penjualan Tahunan',
                'store' => $this->storeModel->find($this->store_id),
                'page' => 'report/yearly_table',
                'ct_table' => $ct_table,
                'year' => $year
            ];
        }

        return view('report/print_template', $data);
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
        $page = '';
        $type = $this->request->getPost('type');
        if ($type == 'daily') {
            $page = 'report/daily_table';
            $date = $this->request->getPost('date');
            $date = str_replace('-', '', $date);
            $ct_table = $date != '' ? $this->orderDetailModel->dailyReport($this->store_id, $date)->get()->getResultArray() : [];
            $return = ['ct_table' => $ct_table];
        } elseif ($type == 'monthly') {
            $page = 'report/monthly_table';
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
            $my_search = $year . '-' . $month;
            $ct_table = $this->orderModel->monthlyReport($this->store_id, $my_search)->get()->getResultArray();
            $return = ['ct_table' => $ct_table, 'month' => $month, 'year' => $year];
        } elseif ($type == 'yearly') {
            $page = 'report/yearly_table';
            $year = $this->request->getPost('year');
            $ct_table = $this->orderModel->yearlyReport($this->store_id, $year)->get()->getResultArray();
            $return = ['ct_table' => $ct_table, 'year' => $year];
        }

        echo json_encode([
            'data' => view($page, $return),
        ]);
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
        //
    }
}
