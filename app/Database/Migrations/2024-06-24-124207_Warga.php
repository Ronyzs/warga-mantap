<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Warga extends Migration
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
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'rt' => [
                'type'       => 'INT',
                'constraint' => '100',
            ],
            'rw' => [
                'type'       => 'INT',
                'constraint' => '100',
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'timses' => [
                'type'       => 'VARCHAR',
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
        $this->forge->createTable('warga');
    }

    public function down()
    {
        $this->forge->dropTable('warga');
    }
}
