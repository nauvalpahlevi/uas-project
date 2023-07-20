<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jobs extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment'=> true
                ],
                'nis'=> [
                    'type' => 'INT',
                    'constraint' => 11,

                ],
                'instansi' => [
                    'type'=> 'VARCHAR',
                    'constraint' => 50,
                ],
                'tahun_masuk' => [
                    'type'=> 'DATE'
                ],
                'tahun_keluar' => [
                    'type' => 'DATE'
                ],
        ]);
         $this->forge->addPrimaryKey('id');
         $this->forge->createTable('jobs');
    }

    public function down()
    {
         $this->forge->dropTable('jobs');
    }
}
