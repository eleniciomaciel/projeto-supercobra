<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FrentesTrabalhoMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_ftbr'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nome_ftbr' => [
				'type'       	=> 'VARCHAR',
				'constraint' 	=> '100',
				'unique'        => true,
				'null' 			=> true,
			],
			'description_ftbr' => [
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
		$this->forge->addKey('id_ftbr', true);
		$this->forge->createTable('frentestrabalho');
	}

	public function down()
	{
		$this->forge->dropTable('frentestrabalho');
	}
}
