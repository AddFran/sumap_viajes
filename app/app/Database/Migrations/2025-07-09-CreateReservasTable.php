<?php

namespace app\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservasTable extends Migration
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
            'fecha_reserva' => [
                'type' => 'DATE',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('experiencia_id', 'experiencias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reservas');
    }

    public function down()
    {
        $this->forge->dropTable('reservas');
    }
}
