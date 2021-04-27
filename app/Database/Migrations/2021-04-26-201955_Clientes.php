<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_cli'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nome_cli'  => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'unique'     => true,
				'null' 		 => true,
			],
			'cnpj_cli'  => [
				'type'       => 'VARCHAR',
				'constraint' => '18',
				'unique'     => true,
				'null' 		 => true,
			],
			'data_inicio_cli' => [
				'type'           => '	DATE',
				'null'           => true,
			],
			'data_final_cli' => [
				'type'           => 'DATE',
				'null'           => true,
			],
			'cep_cli'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
				'null'           => true,
			],
			'uf_cli'      => [
				'type'           => 'CHAR',
				'constraint'     => 2,
				'null'           => true,
			],
			'cidade_cli'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'           => true,
			],
			'endereco_cli'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'           => true,
			],
			'numero_cli'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'null'           => true,
			],
			'bairro_cli'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'           => true,
			],
			'description_cli' => [
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
		$this->forge->addKey('id_cli', true);
		$this->forge->createTable('clientes');
	}

	public function down()
	{
		$this->forge->dropTable('clientes');
	}
}
