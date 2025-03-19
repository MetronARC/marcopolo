<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Device extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'device' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('device');
    }

    public function down()
    {
        $this->forge->dropTable('device');
    }
}
