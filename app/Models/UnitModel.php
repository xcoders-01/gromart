<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table            = 'units';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'store_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $data_default = [
        ['name' => 'Kg'],
        ['name' => 'Pcs'],
        ['name' => 'Box'],
        ['name' => 'Buah'],
        ['name' => 'Unit'],
        ['name' => 'Lusin'],
        ['name' => 'Bungkus'],

        ['name' => 'Ltr'],
        ['name' => 'Rim'],
        ['name' => 'Pack'],
        ['name' => 'Paket'],
        ['name' => 'Botol'],
        ['name' => 'Lembar'],
        ['name' => 'Keping'],

    ];
}
