<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengurus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nik' => [
                'type'       => 'INT',
                'constraint' => '100',
            ],
            'rt' => [
                'type'       => 'INT',
                'constraint' => '100',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengurus');
    }

    public function down()
    {
        $this->forge->dropTable('pengurus');
    }
}
