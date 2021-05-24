<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CentocustoSeeder extends Seeder
{
	public function run()
	{
		$model = model('CentocustoModel');

		for ($i = 0; $i < 2000; $i++) {
			$model->insert([
				'numero_cc'      	=> hexdec( uniqid()),
				'descricao_cc' 		=> static::faker()->name,
				'fk_obra_cc' 		=> 1,
				'fk_frente_cc' 		=> 1,
				'fk_departamento' 	=> 20,
				'observacao_cc' 	=> static::faker()->name,
		]);
		}
                
	}
}
