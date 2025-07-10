<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table            = 'order_details';
    protected $primaryKey       = 'order_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_id',
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
        'store_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function dailyReport($store_id, $date)
    {
        return $this->where('store_id', $store_id)->like('order_id', $date)
            ->like('order_id', $date)
            ->select(['product_code', 'product_name', 'price', 'purchase_price']) // Call select() separately for each column
            ->selectSum('quantity')
            ->selectSum('subtotal')
            ->select("SUM(subtotal) - SUM(purchase_price * quantity) as total_netto", false)
            ->groupBy(['product_code', 'product_name', 'price', 'purchase_price']) // Group by both columns
        ;
    }
}
