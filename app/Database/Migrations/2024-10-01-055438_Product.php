<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                 => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '25',
            ],
            'name'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '99',
            ],
            'unit_id'            => [
                'type'           => 'INT',
                'constraint'     => '2',
                'unsigned'       => true,
                'null'           => true,
            ],
            'category_id'        => [
                'type'           => 'INT',
                'constraint'     => '2',
                'unsigned'       => true,
            ],
            'purchase_price'     => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'selling_price'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'stock'              => [
                'type'           => 'INT',
                'constraint'     => '5',
                'default'        => 0,
            ],
            'store_id'           => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('code');
        $this->forge->addKey('stock');
        $this->forge->addForeignKey('unit_id', 'units', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('store_id', 'stores', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
