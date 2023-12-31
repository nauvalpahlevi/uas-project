<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pekerjaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nis' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'instansi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tahun_masuk' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => true,
            ],
            'tahun_keluar' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => true,
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
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pekerjaan');
    }

    public function down()
    {
        $this->forge->dropTable('pekerjaan');
    }
}
