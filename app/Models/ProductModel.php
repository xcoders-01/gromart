<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['code', 'name', 'unit_id', 'category_id', 'purchase_price', 'selling_price', 'stock', 'store_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function productRelation($where = null)
    {
        $builder = $this->db->table('products as p')
            ->join('units as u', 'u.id = p.unit_id')
            ->join('categories as c', 'c.id = p.category_id')
            ->select('p.*,u.name as unit_name, c.name as category_name');
        if ($where)
            $builder->where($where);
        return $builder;
    }
}
