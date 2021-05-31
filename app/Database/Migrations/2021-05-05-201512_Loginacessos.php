<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loginacessos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'au_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'au_fk_usuario_corp'   => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null'           => true,
			],
			'au_login_corp'       => [
				'type'       		=> 'VARCHAR',
				'constraint' 		=> '50',
				'unique'         	=> true,
				'null'           	=> true,
			],
			'au_passwword'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'       => true,
			],
			'au_fk_cargo'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null'           => true,
			],
			'au_fk_frente'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null'           => true,
			],
			'au_fk_obra'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'null'           => true,
			],
			'au_token_active'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'       => true,
			],
			'au_token_expiracao' => [
				'type'         => 'DATETIME',
				'null'         => true,
			],
			'au_status'       => [
				'type' 			=> 'ENUM',
				'constraint' 	=> "'0','1'",
				'default' 		=> '0',
				'null' 			=> true,
			],
			'role'       => [
				'type' 			=> 'ENUM',
				'constraint' 	=> "'RH','ADMIN','USER'",
				'default' 		=> 'USER',
				'null' 			=> true,
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
		$this->forge->addKey('au_id', true);
		$this->forge->addForeignKey('au_fk_obra','obras','id');
		$this->forge->addForeignKey('au_fk_frente','frentes','id_ft','CASCADE','CASCADE');
		$this->forge->addForeignKey('au_fk_cargo','cargos','id_cargo','CASCADE','CASCADE');
		$this->forge->createTable('acessousuarios');
	}

	public function down()
	{
		$this->forge->dropTable('acessousuarios');
	}
}
