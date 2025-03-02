<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ticketlog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'rma' => ['type' => 'VARCHAR', 'constraint' => 50],
            'note' => ['type' => 'TEXT'],
            'user' => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ticket_log');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_log');
    }
}
