<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 6,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'username'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '15',
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '200',
            ],
            'level_id'       => [
                'type'           => 'INT',
                'constraint'     => '2',
                'unsigned'       => true,
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
        $this->forge->addKey('level_id');
        $this->forge->addKey('username');
        $this->forge->addForeignKey('level_id', 'levels', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
