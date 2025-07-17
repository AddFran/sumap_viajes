<?php

namespace app\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExperienciasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'comunidad_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'descripcion' => [
                'type' => 'TEXT',
            ],
            'precio' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'fecha' => [
                'type' => 'DATE',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('comunidad_id', 'comunidades', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('experiencias');
    }

    public function down()
    {
        $this->forge->dropTable('experiencias');
    }
}
