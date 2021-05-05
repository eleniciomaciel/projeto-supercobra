<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Funcionarios extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'f_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'f_nome'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_email_pessoal'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'f_codigo'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
				'unique'     => true,
			],
			'f_matricula'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'f_cpf'       => [
				'type'       => 'VARCHAR',
				'constraint' => '20',
				'null'       => true,
			],
			'f_rg_numero'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'null'       => true,
			],
			'f_rg_emissor'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_rg_uf'       => [
				'type'       => 'CHAR',
				'constraint' => '2',
				'null'       => true,
			],
			'f_rg_data_emissao'       => [
				'type'       => 'DATETIME',
				'null'       => true,
			],
			'f_sexo'       => [
				'type' => 'ENUM',
				'constraint' 	=> "'Masculino','Feminino','Gay','Outros'",
				'default' 		=> 'Outros',
				'null' 			=> true,
			],
			'f_data_nascimento'       => [
				'type'         => 'DATETIME',
				'null'         => true,
			],
			'f_nacionalidade'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'f_naturalidade_cidade'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'f_nacionalidade_uf'       => [
				'type'       => 'CHAR',
				'constraint' => '2',
				'null'       => true,
			],
			'f_estado_civil'       => [
				'type' => 'ENUM',
				'constraint' 	=> "'Casado(a)','Solteiro(a)','Divorciado(a)','Viuvo(a)','Outros'",
				'default' 		=> 'Outros',
				'null' 			=> true,
			],
			'f_mae'       => [
				'type'       => 'VARCHAR',
				'constraint' => '70',
				'null'       => true,
			],
			'f_pai'       => [
				'type'       => 'VARCHAR',
				'constraint' => '70',
				'null'       => true,
			],
			'f_numero_reservista'   => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'f_numero_cartao_sus' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'f_cep'       => [
				'type'       => 'VARCHAR',
				'constraint' => '10',
				'null'       => true,
			],
			'f_estado'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_cidade'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_bairro'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_endereco'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_endereco_complemento'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_numero_casa'       => [
				'type'       => 'INT',
				'constraint' => '5',
				'null'       => true,
			],
			'f_telefone_pessoal'       => [
				'type'       => 'VARCHAR',
				'constraint' => '15',
				'null'       => true,
			],
			'f_telefone_contato'       => [
				'type'       => 'VARCHAR',
				'constraint' => '15',
				'null'       => true,
			],
			'f_titulo_eleitor_numero'       => [
				'type'       => 'VARCHAR',
				'constraint' => '40',
				'null'       => true,
			],
			'f_titulo_eleitor_nona'       => [
				'type'       => 'VARCHAR',
				'constraint' => '30',
				'null'       => true,
			],
			'f_titulo_eleitor_sessao'       => [
				'type'       => 'VARCHAR',
				'constraint' => '10',
				'null'       => true,
			],
			'f_titulo_eleitor_uf'       => [
				'type'       => 'CHAR',
				'constraint' => '2',
				'null'       => true,
			],
			'f_titulo_eleitor_data_emissao'       => [
				'type'       => 'DATETIME',
				'null'       => true,
			],
			'f_cnh_numero'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_cnh_categoria'       => [
				'type' 			=> 'ENUM',
				'constraint' 	=> "'A','AB','B','C','D','E'",
				'null' 			=> true,
			],
			'f_cnh_emissor' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'f_cnh_uf' => [
				'type'       => 'CHAR',
				'constraint' => '2',
				'null'       => true,
			],
			'f_cnh_data_emissao' => [
				'type'       => 'DATETIME',
				'null'       => true,
			],
			'f_cnh_data_vencimento' => [
				'type'       => 'DATETIME',
				'null'       => true,
			],
			'f_cnh_data_primeira' => [
				'type'       => 'DATETIME',
				'null'       => true,
			],
			'f_ctps_numero'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'f_ctps_numero_serie'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'f_ctps_uf'       => [
				'type'       => 'CHAR',
				'constraint' => '2',
				'null'       => true,
			],
			'f_status'       => [
				'type' => 'ENUM',
				'constraint' 	=> "'Ativo','Desativado'",
				'default' 		=> 'Ativo',
				'null' 			=> true,
			],
			'f_ctps_data_emissao' => [
				'type'       => 'DATETIME',
				'null'       => true,
			],
			'f_description' => [
				'type' => 'TEXT',
				'null' => true,
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
		]);
		$this->forge->addKey('f_id', true);
		$this->forge->createTable('funcionarios');
	}

	public function down()
	{
		$this->forge->dropTable('funcionarios');
	}
}
