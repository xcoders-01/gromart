<?php

namespace App\Database\Seeds;

use App\Models\LevelModel;
use CodeIgniter\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        $this->db->query("SET FOREIGN_KEY_CHECKS=0;");


        $this->db->table('levels')->truncate();
        $data = [
            [
                'name' => 'Super Admin',
                'description' => 'Super Administrator Account',
            ],
            [
                'name' => 'Admin',
                'description' => 'Administrator Account',
            ],
            [
                'name' => 'Cashier',
                'description' => 'Cashier Account',
            ],
        ];

        $level = new LevelModel();
        $level->insertBatch($data);

        $this->db->query("SET FOREIGN_KEY_CHECKS=1;");
    }
}
