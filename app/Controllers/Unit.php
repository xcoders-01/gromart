<?php

namespace App\Controllers;

use App\Models\UnitModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Unit extends ResourceController
{
    protected  $store_id, $unitModel;
    public function __construct()
    {
        $this->store_id = getStoreId();
        $this->unitModel = new UnitModel();
    }

    public function index()
    {
        // for insert data default
        // $store_id =  $this->store_id;
        // $default = $this->unitModel->data_default;
        // $data_with_store_id = array_map(function ($item) use ($store_id) {
        //     $item['store_id'] = $store_id;
        //     return $item;
        // }, $default);
        // $this->unitModel->insertBatch($data_with_store_id);

        $units = baseStore($this->unitModel)->orderBy('name', 'asc')->findAll();
        $data = [
            'units' => $units,
            'submenu' => 'unit',
            'page' => 'pages/unit',
            'subtitle' => 'Satuan',
            'menu' => 'master_data',
            'title' => 'Master Data',
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
        $unit_name = $this->request->getPost('name');
        if (baseStore($this->unitModel)->where('name', $unit_name)->first())
            session()->setFlashdata('error', 'Nama Satuan Sudah Tersedia.');
        else {
            $data = [
                'name' => $unit_name,
                'store_id' => $this->store_id,
            ];
            $this->unitModel->insert($data);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        }

        return redirect()->to(base_url('unit'));
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
        $unit_name = $this->request->getPost('name');
        $unit = baseStore($this->unitModel)->where(['name' => $unit_name, 'id != ' => $id])->first();
        if ($unit)
            session()->setFlashdata('error', 'Nama Satuan Sudah Tersedia.');
        else {
            $data = [
                'name' => $unit_name,
            ];
            $this->unitModel->update($id, $data);
            session()->setFlashdata('success', 'Data Berhasil Diperbaharui');
        }

        return redirect()->to(base_url('unit'));
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
        $unit = $this->unitModel->find($id);
        if (empty($unit))
            session()->setFlashdata('error', 'Data Tidak Ditemukan');
        else {
            $this->unitModel->delete($id);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
        }
        return redirect()->to(base_url('unit'));
    }
}
