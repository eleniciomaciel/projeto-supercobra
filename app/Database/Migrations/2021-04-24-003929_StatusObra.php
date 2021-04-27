<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusObra extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'st_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'st_title'       => [
				'type'       => 'VARCHAR',
				'unique'        => true,
				'constraint' => '50',
			],
			'datetime'       => [
				'type'           => 'DATETIME',
				'null'         => true,
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
		$this->forge->addKey('st_id', true);
		$this->forge->createTable('statusobras');
	}

	public function down()
	{
		$this->forge->dropTable('statusobras');
	}
}
