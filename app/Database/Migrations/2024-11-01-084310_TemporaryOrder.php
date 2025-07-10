<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TemporaryOrder extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_code'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '25',
            ],
            'product_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '99',
            ],
            'category_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '55',
            ],
            'unit_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '25',
            ],
            'purchase_price'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 0,
            ],
            'price'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 0,
            ],
            'quantity'       => [
                'type'           => 'FLOAT',
                'default'        => 0,
            ],
            'ppn'       => [
                'type'           => 'INT',
                'constraint'     => 6,
                'default'        => 0,
            ],
            'discount'       => [
                'type'           => 'INT',
                'constraint'     => 6,
                'default'        => 0,
            ],
            'subtotal'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'default'        => 0,
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => '6',
                'unsigned'       => true,
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

        $this->forge->addKey('product_code');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('store_id', 'stores', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('temporary_orders');
    }

    public function down()
    {
        $this->forge->dropTable('temporary_orders', true);
    }
}
