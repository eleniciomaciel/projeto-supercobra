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
			'data_inicio'       => [
				'type'           => 'DATETIME',
				'null'         => true,
			],
			'data_fim'       => [
				'type'           => 'DATETIME',
				'null'         => true,
			],
			'obras_cep'       => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '10',
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
				'null'          => true,
			],
			'obras_endereco'       => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '80',
				'unique'        => true,
				'null'          => true,
			],
			'obras_numero'       => [
				'type'       	=> 'INT',
				'constraint' 	=> '4',
				'null'          => true,
			],
			'obras_bairro'       => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '50',
				'null'          => true,
			],
			'obras_cliente'       => [
				'type'       	=> 'INT',
				'constraint' 	=> '11',
				'unsigned'      => true,
				'null'          => true,
			],
			'status'      => [
				'type'       	=> 'INT',
				'constraint' 	=> '11',
				'unsigned'      => true,
			],
			'obras_description' => [
				'type' => 'TEXT',
				'null' => true,
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
