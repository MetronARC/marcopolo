<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ticket extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'rma' => ['type' => 'VARCHAR', 'constraint' => 50],
            'service_no' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'customer_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'customer_address' => ['type' => 'TEXT'],
            'customer_phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'customer_email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'device' => ['type' => 'VARCHAR', 'constraint' => 100],
            'brand' => ['type' => 'VARCHAR', 'constraint' => 100],
            'type' => ['type' => 'VARCHAR', 'constraint' => 100],
            'sn' => ['type' => 'VARCHAR', 'constraint' => 100],
            'warranty' => ['type' => 'BOOLEAN'],
            'warranty_date' => ['type' => 'VARCHAR', 'constraint' => 100],
            'device_condition' => ['type' => 'TEXT'],
            'problem' => ['type' => 'TEXT'],
            'detail_problem' => ['type' => 'TEXT'],
            'accessories' => ['type' => 'TEXT'],
            'engineer' => ['type' => 'VARCHAR', 'constraint' => 100],
            'ticket_status' => ['type' => 'VARCHAR', 'constraint' => 50],
            'close_date' => ['type' => 'DATETIME', 'null' => true],
            'payment' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'payment_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
            'payment_at' => ['type' => 'DATETIME', 'null' => true],
            'payment_note' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ticket');
    }

    public function down()
    {
        $this->forge->dropTable('ticket');
    }
}
