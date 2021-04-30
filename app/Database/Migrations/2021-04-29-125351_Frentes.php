<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Frentes extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_ft'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'cliente_fk_id_ft'       => [
				'type'       	=> 'INT',
				'constraint' 	=> 11,
				'unsigned'      => true,
				'null'          => true,
			],
			'obra_fk_id_ft'      => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null'           => true,
			],
			'nome_ft'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'null'           => true,
			],
			'data_inicial_ft'       => [
				'type'           => 'DATETIME',
				'null'         	 => true,
			],
			'data_final_ft'       => [
				'type'           => 'DATETIME',
				'null'           => true,
			],
			'cep_ft'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '10',
				'null'           => true,
			],
			'estado_uf_ft'       => [
				'type'           => 'CHAR',
				'constraint'     => '2',
				'null'           => true,
			],
			'cidade_ft'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
				'null'           => true,
			],
			'bairro_ft'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
				'null'           => true,
			],
			'endereco_ft'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'null'           => true,
			],
			'numero_ft'       => [
				'type'           => 'INT',
				'constraint'     => '5',
				'null'           => true,
			],
			'ponto_referencia_ft'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
				'null'           => true,
			],
			'created_at'       => [
				'type'           => 'DATETIME',
				'null'         => true,
			],
			'updated_at'       => [
				'type'           => 'DATETIME',
				'null'          => true,
			],
			'deleted_at'       => [
				'type'           => 'DATETIME',
				'null'         	 => true,
			],
			'description_at' => [
				'type' => 'TEXT',
				'null' => true,
			],
		]);
		$this->forge->addKey('id_ft', true);
		$this->forge->addForeignKey('cliente_fk_id_ft','clientes','id_cli','CASCADE','CASCADE');
		$this->forge->addForeignKey('obra_fk_id_ft','obras','id','CASCADE','CASCADE');
		$this->forge->createTable('frentes');
	}

	public function down()
	{
		$this->forge->dropTable('frentes');
	}
}
