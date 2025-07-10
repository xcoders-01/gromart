<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '15',
            ],
            'sales_date'       => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'sales_time'       => [
                'type'           => 'TIME',
                'null'           => true,
            ],
            'purchase_total'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'ppn_total'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'discount_total'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'grand_total'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'payment'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'change'       => [
                'type'           => 'INT',
                'constraint'     => '11',
                'default'        => 0,
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => '6',
                'unsigned'       => true,
            ],
            'store_id'       => [
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('store_id', 'stores', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders', true);
    }
}
