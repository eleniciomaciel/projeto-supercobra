<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DocumentoscolaboradorMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'doc_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'doc_fk_funcioanrio' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'doc_fk_obra' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'doc_fk_frente' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'doc_descricao' => [
				'type' => 'TEXT',
				'null' => true,
			],
			'doc_arquivo'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'null'           => true,
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
		$this->forge->addKey('doc_id', true);
		$this->forge->addForeignKey('doc_fk_funcioanrio','funcionarios','f_id');
		$this->forge->addForeignKey('doc_fk_obra','obras','id');
		$this->forge->addForeignKey('doc_fk_frente','frentes','id_ft');
		$this->forge->createTable('documentos_colaborador');
	}

	public function down()
	{
		$this->forge->dropTable('documentos_colaborador');
	}
}
