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
            'device' => ['type' => 'VARCHAR', 'constraint' => 100],
            'brand' => ['type' => 'VARCHAR', 'constraint' => 100],
            'type' => ['type' => 'VARCHAR', 'constraint' => 100],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'rma' => ['type' => 'VARCHAR', 'constraint' => 50],
            'used_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('sparepart');
    }

    public function down()
    {
        $this->forge->dropTable('sparepart');
    }
}
