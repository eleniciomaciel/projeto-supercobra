<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Estados extends Migration
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
			'nome'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null' => true,
			],
			'uf' => [
				'type'       => 'CHAR',
				'constraint' => '2',
				'null' => true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('estados');
	}

	public function down()
	{
		$this->forge->dropTable('estados');
	}
}
