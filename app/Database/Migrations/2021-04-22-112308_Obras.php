<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Obras extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'obras_local'       => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '100',
				'unique'        => true,
				'null'          => true,
			],
			'obras_estado'       => [
				'type'       	=> 'CHAR',
				'constraint' 	=> '2',
				'null'          => true,
			],
			'obras_cidade'       => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
				'unique'        => true,
				'null'          => true,
			],
			'obras_description' => [
				'type' => 'TEXT',
				'null' => true,
			],
			'status'      => [
				'type'           => 'ENUM',
				'constraint'     => ['ativo', 'pendente', 'concluido'],
				'default'        => 'pendente',
			],
			'datetime'       => [
				'type'           => 'DATETIME',
				'null'         => true,
			],
			'created_at'       => [
				'type'           => 'DATETIME',
				'null'         => true,
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
				'null'         => true,
			],
			'deleted_at'       => [
				'type'           => 'DATETIME',
				'null'         => true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('obras');
	}

	public function down()
	{
		$this->forge->dropTable('obras');
	}
}
