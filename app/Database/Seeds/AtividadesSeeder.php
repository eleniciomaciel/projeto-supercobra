<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AtividadesSeeder extends Seeder
{
	public function run()
	{
		$model = model('AtividadesModel');

		for ($i = 0; $i < 880; $i++) {
			$model->insert([
				'titulo_fk_author'      => 1,
				'titulo_nome' 			=> static::faker()->company,
				'titulo_description' 	=> static::faker()->name,
			]);
		}
	}
}
