<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExamesMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_ex'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'ex_fk_tipo_contato' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'unsigned'   	=> true,
				'null' 		 	=> true,
			],
			'ex_fk_funcao' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'unsigned'   	=> true,
				'null' 		 	=> true,
			],
			'ex_fk_risco' => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'unsigned'   	=> true,
				'null' 		 	=> true,
			],
			'ex_tipo_exame' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null' 		 => true,
			],
			'ex_validade_meses' => [
				'type'       	=> 'INT',
				'constraint' 	=> 2,
				'null' 		 	=> true,
			],
			'ex_description' => [
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

		$this->forge->addKey('id_ex', true);
		$this->forge->addForeignKey('ex_fk_tipo_contato','examescontratuais','id');
		$this->forge->addForeignKey('ex_fk_risco','examesocupacionaisriscos','id_r');
		$this->forge->addForeignKey('ex_fk_funcao','cargofuncoes','id');
		$this->forge->createTable('exames');
	}

	public function down()
	{
		$this->forge->dropTable('exames');
	}
}
