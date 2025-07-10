<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'sales_date',
        'sales_time',
        'ppn_total',
        'discount_total',
        'purchase_total',
        'grand_total',
        'payment',
        'change',
        'user_id',
        'store_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function monthlyReport($store_id, $my_search)
    {
        return $this->where('store_id', $store_id)->like('sales_date', $my_search)
            ->select(['sales_date'])->selectSum('grand_total')
            ->select("SUM(grand_total) - SUM(purchase_total) as total_netto", false)
            ->orderBy('sales_date', 'asc')
            ->groupBy(['sales_date']);
    }
    public function yearlyReport($store_id, $year_search)
    {
        return $this->where('store_id', $store_id)->where('YEAR(sales_date)', $year_search)
            ->select('month(sales_date) as order_month')->selectSum('grand_total')
            ->select("SUM(grand_total) - SUM(purchase_total) as total_netto", false)
            ->orderBy('sales_date', 'asc')
            ->groupBy('month(sales_date)');
    }


    public function incomeDaily($store_id, $date)
    {
        return $this->where('store_id', $store_id)->like('sales_date', $date)
            ->selectSum('grand_total');
    }

    public function incomeMonthly($store_id, $my_search)
    {
        return $this->where('store_id', $store_id)->like('sales_date', $my_search)
            ->selectSum('grand_total');
    }

    public function incomeYearly($store_id, $year)
    {
        return $this->where('store_id', $store_id)->where('YEAR(sales_date) = ', $year)
            ->selectSum('grand_total');
    }
}
