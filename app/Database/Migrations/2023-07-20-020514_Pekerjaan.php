<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pekerjaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nis' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
            'instansi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tahun_masuk' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'tahun_keluar' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
            ],
        ]);
        $this->forge->createTable('pekerjaan');
    }

    public function down()
    {
        $this->forge->dropTable('pekerjaan');
    }
}
