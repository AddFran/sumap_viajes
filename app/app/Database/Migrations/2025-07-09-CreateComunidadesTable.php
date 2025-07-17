<?php

namespace app\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateComunidadesTable extends Migration
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
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ubicacion' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'descripcion' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('comunidades');
    }

    public function down()
    {
        $this->forge->dropTable('comunidades');
    }
}
