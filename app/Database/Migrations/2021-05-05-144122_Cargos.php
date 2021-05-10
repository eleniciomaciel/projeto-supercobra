<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cargos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_cargo'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'cargo_nome'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'cargo_description' => [
				'type' => 'TEXT',
				'null' => true,
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
		$this->forge->addKey('id_cargo', true);
		$this->forge->createTable('cargos');
	}

	public function down()
	{
		$this->forge->dropTable('cargos');
	}
}
