<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Parts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'brand' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'stock' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('parts');
    }

    public function down()
    {
        $this->forge->dropTable('parts');
    }
}
