<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Partslog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'rma' => ['type' => 'VARCHAR', 'constraint' => 50],
            'engineer' => ['type' => 'VARCHAR', 'constraint' => 100],
            'part_id' => ['type' => 'VARCHAR', 'constraint' => 50],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'used' => ['type' => 'BOOLEAN'],
            'note' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('sparepart_log');
    }

    public function down()
    {
        $this->forge->dropTable('sparepart_log');
    }
}
