<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pendidikan extends Migration
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
            'riwayat_pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'nama_kampus' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tahun_masuk_kampus' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => true,
            ],
            'tahun_lulus_kampus' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => true,
            ],
            'prodi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('pendidikan');
    }

    public function down()
    {
        $this->forge->dropTable('pendidikan');
    }
}
