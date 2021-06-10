<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExamesocupacionaisriscosMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_r'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'fk_user_eor' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'fk_funcao_eor' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'eor_nome' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '100',
				'null' 			=> true,
			],
			'eor_grau_risco'      => [
				'type'           => 'ENUM',
				'constraint'     => ['Nenhum','Físicos', 'Químicos', 'Biológicos', 'Ergonômicos', 'Acidentais', 'Mecânicos'],
				'default'        => 'Nenhum',
			],
			'eor_combo_risco' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '100',
				'null' 			=> true,
			],
			'eor_description_risco' => [
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

		$this->forge->addKey('id_r', true);
		$this->forge->addForeignKey('fk_user_eor','funcionarios','f_id');
		$this->forge->addForeignKey('fk_funcao_eor','cargofuncoes','id');
		$this->forge->createTable('examesocupacionaisriscos');
	}

	public function down()
	{
		$this->forge->dropTable('examesocupacionaisriscos');
	}
}
