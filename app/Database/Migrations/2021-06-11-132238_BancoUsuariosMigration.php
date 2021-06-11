<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BancoUsuariosMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_bu'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'fk_funcionario_bu'  => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 		 	 => true,
			],
			'fk_banco_bu'  => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null' 		 	 => true,
			],
			'tipo_conta_bu'      => [
				'type'           => 'ENUM',
				'constraint'     => ['Conta-Corrente', 'Conta-Digital', 'Conta-Poupança','Conta-Universitária','Conta-Salário'],
				'default'        => 'Conta-Salário',
			],
			'agencia_bu'  => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'null' 		 => true,
			],
			'digito_agencia_bu'  => [
				'type'       => 'CHAR',
				'constraint' => '5',
				'null' 		 => true,
			],
			'numero_conta_bu'  => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'null' 		 => true,
			],
			'digito_conta_bu'  => [
				'type'       => 'CHAR',
				'constraint' => '1',
				'null' 		 => true,
			],
			'status_conta_bu'      => [
				'type'           => 'ENUM',
				'constraint'     => ['Ativa', 'Inativa'],
				'default'        => 'Ativa',
			],
			'titular_status_bu'      => [
				'type'           => 'ENUM',
				'constraint'     => ['Sim', 'Não'],
				'default'        => 'Sim',
			],
			'data_vencimento_conta_bu'  => [
				'type'       => 'DATE',
				'null' 		 => true,
			],
			'observacao_bu' => [
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
		$this->forge->addKey('id_bu', true);
		$this->forge->addForeignKey('fk_funcionario_bu','funcionarios','f_id');
		$this->forge->addForeignKey('fk_banco_bu','bancos','id_b');
		$this->forge->createTable('bancousuarios');
	}

	public function down()
	{
		$this->forge->dropTable('bancousuarios');
	}
}
