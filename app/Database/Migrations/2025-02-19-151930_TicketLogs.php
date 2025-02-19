<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TicketLogs extends Migration
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
            'ticket_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['New Ticket', 'Checking', 'Wait For Part', 'Processing', 'Wait For Customer Pickup', 'Finish'],
            ],
            'changed_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ticket_logs');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_logs');
    }
}
