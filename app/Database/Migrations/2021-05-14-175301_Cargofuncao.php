<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cargofuncao extends Migration
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
			'cf_fk_funcao' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'cf_nome_cargo_funcao' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null' 	     => true,
				'unique'     => true,
			],
			'cf_description_cargo_funcao' => [
				'type' => 'TEXT',
				'null' => true,
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
		$this->forge->addForeignKey('cf_fk_funcao','obras','id');
		$this->forge->createTable('cargofuncoes');
	}

	public function down()
	{
		$this->forge->dropTable('cargofuncoes');
	}
}
