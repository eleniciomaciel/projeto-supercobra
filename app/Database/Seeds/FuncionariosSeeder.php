<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FuncionariosSeeder extends Seeder
{
	public function run()
	{
		$model = model('FuncionarioModel');

		for ($i = 0; $i < 10; $i++) {
			$model->insert([
				'f_nome'      		=> static::faker()->name,
				'f_cargo' 			=> 1,
				'f_fk_obra' 		=> 1,
				'f_Fk_frente' 		=> 1,
				'f_email_pessoal' 	=> static::faker()->email,
				'f_codigo' 			=> rand(),
				'f_matricula' 		=> rand(),
			]);
		}
	}
}
