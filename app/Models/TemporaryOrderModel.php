<?php

namespace App\Models;

use CodeIgniter\Model;

class TemporaryOrderModel extends Model
{
    protected $table            = 'temporary_orders';
    protected $primaryKey       = 'product_code';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'product_code',
        'product_name',
        'category_name',
        'unit_name',
        'purchase_price',
        'price',
        'quantity',
        'ppn',
        'discount',
        'subtotal',
        'user_id',
        'store_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
