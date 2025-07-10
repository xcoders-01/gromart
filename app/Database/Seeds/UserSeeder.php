<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->query("SET FOREIGN_KEY_CHECKS=0;");

        $this->db->table('users')->truncate();
        $data = [
            [
                'name' => 'master',
                'username' => 'master',
                'email' => 'master@gromart.com',
                'password' => password_hash('secret', PASSWORD_BCRYPT),
                'level_id' => 1,
            ],
        ];

        $user = new UserModel();
        $user->insertBatch($data);

        $this->db->query("SET FOREIGN_KEY_CHECKS=1;");
    }
}
