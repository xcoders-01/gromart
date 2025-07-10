<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Store extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => false,
            ],
            'address'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'telp'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => true,
            ],
            'status'       => [
                'type'           => 'ENUM("active", "inactive")',
                'default'        => 'active',
                'null'           => false,
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

        $this->forge->createTable('stores');
    }

    public function down()
    {
        $this->forge->dropTable('stores', true);
    }
}
