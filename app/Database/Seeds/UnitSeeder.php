<?php

namespace App\Database\Seeds;

use App\Models\UnitModel;
use CodeIgniter\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $this->db->query("SET FOREIGN_KEY_CHECKS=0;");

        $this->db->table('units')->truncate();
        $unit = new UnitModel();

        $unit->insertBatch($unit->data_default);


        $this->db->query("SET FOREIGN_KEY_CHECKS=1;");
    }
}
