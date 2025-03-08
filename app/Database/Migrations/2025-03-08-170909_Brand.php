<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Brand extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'brand' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('brand');
    }

    public function down()
    {
        $this->forge->dropTable('brand');
    }
}
