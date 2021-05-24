<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AtividadesMigration extends Migration
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
			'titulo_fk_author'  => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'titulo_nome' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null' 	     => true,
			],
			'titulo_description' => [
				'type' => 'TEXT',
				'null' => true,
			],
			'created_at' => [
				'type'         => 'DATETIME',
				'null'         => true,
			],
			'updated_at'  => [
				'type'         => 'DATETIME',
				'null'         => true,
			],
			'deleted_at'  => [
				'type'         => 'DATETIME',
				'null'         => true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('titulo_fk_author','acessousuarios','au_fk_usuario_corp');
		$this->forge->createTable('atividades');
	}

	public function down()
	{
		$this->forge->dropTable('atividades');
	}
}
