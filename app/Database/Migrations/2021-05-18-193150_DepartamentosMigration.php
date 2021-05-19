<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DepartamentosMigration extends Migration
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
			'dep_name' => [
				'type'          => 'VARCHAR',
				'constraint'    => '100',
				'null' 	     	=> true,
				'unique'     	=> true,
			],
			'dep_description' => [
				'type'       => 'TEXT',
				'null' 	     => true,
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
		$this->forge->addKey('id', true);
		$this->forge->createTable('departamentos');
	}

	public function down()
	{
		$this->forge->dropTable('departamentos');
	}
}
