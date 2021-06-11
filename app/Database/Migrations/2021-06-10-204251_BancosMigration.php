<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BancosMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_b'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'b_nome'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'unique'     => true,
				'null' 		 => false,
			],
			'b_numero' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unique'         => true,
				'null' 			 => false,
			],
		]);
		$this->forge->addKey('id_b', true);
		$this->forge->createTable('bancos');
	}

	public function down()
	{
		$this->forge->dropTable('bancos');
	}
}
