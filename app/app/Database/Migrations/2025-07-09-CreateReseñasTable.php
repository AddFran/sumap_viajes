<?php

namespace app\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReseñasTable extends Migration
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
            'usuario_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'experiencia_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'comentario' => [
                'type' => 'TEXT',
            ],
            'calificacion' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('experiencia_id', 'experiencias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reseñas');
    }

    public function down()
    {
        $this->forge->dropTable('reseñas');
    }
}
