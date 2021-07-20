<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuarioscargosMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'uc_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'uc_fk_id_rh_que_cadastratou' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'uc_fk_id_funcionario' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'uc_fk_id_cargo' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'uc_fk_id_departamento' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'uc_fk_id_atividade' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'uc_description' => [
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
		$this->forge->addKey('uc_id', true);
		// $this->forge->addForeignKey('uc_fk_id_rh_que_cadastratou','funcionarios','f_id');
		// $this->forge->addForeignKey('uc_fk_id_funcionario','funcionarios','f_id');
		// $this->forge->addForeignKey('uc_fk_id_cargo','cargofuncoes','id');
		// $this->forge->addForeignKey('uc_fk_id_departamento','departamentos','id');
		// $this->forge->addForeignKey('uc_fk_id_atividade','atividades','id');
		$this->forge->createTable('usuarioscargos');
	}

	public function down()
	{
		$this->forge->dropTable('usuarioscargos');
	}
}
