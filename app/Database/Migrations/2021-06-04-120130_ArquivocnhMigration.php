<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ArquivocnhMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'  => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'fk_usuario_cnh' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 			 => true,
			],
			'file_cnh' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null' 		 => true,
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
		$this->forge->addForeignKey('fk_usuario_cnh','funcionarios','f_id');
		$this->forge->createTable('historicocnh');
	}

	public function down()
	{
		$this->forge->dropTable('historicocnh');
	}
}
