<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Parts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'part_id' => ['type' => 'VARCHAR', 'constraint' => 50],
            'brand' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'type' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'part_number' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'part_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'part_sn' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'part_case_no' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'awb_no' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'rma' => ['type' => 'VARCHAR', 'constraint' => 50],
            'used_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('sparepart');
    }

    public function down()
    {
        $this->forge->dropTable('sparepart');
    }
}
