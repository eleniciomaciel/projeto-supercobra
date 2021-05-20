<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Centocusto extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_cc'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'numero_cc'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'unique'         => true,
				'null'           => true,
			],
			'descricao_cc'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'           => true,
			],
			'fk_obra_cc'       => [
				'type'           => 'INT',
				'constraint' 	 => 11,
				'null'           => true,
			],
			'fk_frente_cc'       => [
				'type'           => 'INT',
				'constraint' 	 => 11,
				'null'           => true,
			],
			'status_cc'       => [
				'type' => 'ENUM',
				'constraint' 	=> "'active','inactive','deleted'",
				'default' 		=> 'active',
				'null' 			=> true,
			],
			'created_at'       => [
				'type'           => 'DATETIME',
				'null'         => true,
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
				'null'          => true,
			],
			'deleted_at'       => [
				'type'           => 'DATETIME',
				'null'         	 => true,
			],
		]);
		$this->forge->addKey('id_cc', true);
		$this->forge->addForeignKey('fk_obra_cc','obras','id');
		$this->forge->addForeignKey('fk_frente_cc','frentes','id_ft');
		$this->forge->createTable('cento_custo');
	}

	public function down()
	{
		$this->forge->dropTable('cento_custo');
	}
}
