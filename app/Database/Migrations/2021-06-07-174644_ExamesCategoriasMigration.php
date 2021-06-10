<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExamesCategoriasMigration extends Migration
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
			'fk_user_ect' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'ect_nome' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '100',
				'null' 			=> true,
			],
			'ect_description' => [
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
		$this->forge->addForeignKey('fk_user_ect','funcionarios','f_id');
		$this->forge->createTable('examescontratuais');
	}

	public function down()
	{
		$this->forge->dropTable('examescontratuais');
	}
}
