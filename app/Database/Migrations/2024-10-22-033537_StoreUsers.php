<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StoreUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'store_id'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => '6',
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

        $this->forge->addKey('user_id');
        $this->forge->addKey('store_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'NO ACTION', 'NO ACTION');
        $this->forge->addForeignKey('store_id', 'stores', 'id', 'NO ACTION', 'NO ACTION');

        $this->forge->createTable('store_users', true);
    }

    public function down()
    {
        $this->forge->dropTable('store_users', true);
    }
}
