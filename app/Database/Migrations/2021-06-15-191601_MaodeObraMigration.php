<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MaodeObraMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tmo'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nome_tmo' => [
				'type'           => 'VARCHAR',
                'constraint'     => '40',
                'unique'         => true,
				'null' 			 => true,
			],
			'description_tmo' => [
				'type' 			=> 'TEXT',
				'null' 			=> true,
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
		$this->forge->addKey('id_tmo', true);
		$this->forge->createTable('tipomaodeobras');
	}

	public function down()
	{
		$this->forge->dropTable('tipomaodeobras');
	}
}
