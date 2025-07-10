<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\StoreModel;
use App\Models\StoreUserModel;
use App\Models\UnitModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected $store_id, $userModel, $productModel, $categoryModel, $unitModel, $storeModel, $storeUserModel, $orderModel, $orderDetailModel;

    public function __construct()
    {
        $this->store_id = getStoreId();
        $this->userModel = new UserModel();
        $this->unitModel = new UnitModel();
        $this->orderModel = new OrderModel();
        $this->storeModel = new StoreModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->storeUserModel = new StoreUserModel();
        $this->orderDetailModel = new OrderDetailModel();
    }
    public function index()
    {
        $data = [];
        $page = 'pages/home';
        $layout = 'layouts/default';
        if (getLevel('id') == 1) {
            $data['users'] = $this->userModel->countAllResults();
            $data['stores'] = $this->storeModel->countAllResults();
            $page = 'pages/core/dashboard';
        } else if (getLevel('id') == 2) {
            $data['count_products'] = baseStore($this->productModel)->countAllResults();
            $data['count_categories'] = baseStore($this->categoryModel)->countAllResults();
            $data['count_units'] = baseStore($this->unitModel)->countAllResults();
            $data['count_users'] = getRecord($this->storeUserModel, ['store_id' => getStoreId()], 'user_id')->countAllResults();

            $inc_today = $this->orderModel->incomeDaily($this->store_id, date('Y-m-d'))->get()->getFirstRow();
            $inc_monthly = $this->orderModel->incomeMonthly($this->store_id, date('Y-m'))->get()->getFirstRow();
            $inc_yearly = $this->orderModel->incomeYearly($this->store_id, date('Y'))->get()->getFirstRow();
            $data['inc_today'] = $inc_today->grand_total ?? 0;
            $data['inc_monthly'] = $inc_monthly->grand_total ?? 0;
            $data['inc_yearly'] = $inc_yearly->grand_total ?? 0;
            $data['chart_data'] = $this->orderModel->monthlyReport($this->store_id, date('Y-m'))->get()->getResult();
        }

        $data['page'] = $page;
        $data['menu'] = 'dashboard';
        $data['title'] = 'Dashboard';
        $data['submenu'] = $data['subtitle'] = '';

        if (getLevel('id') == 3)
            return redirect()->to(base_url('sales'));
        return view($layout, $data);
    }
}
