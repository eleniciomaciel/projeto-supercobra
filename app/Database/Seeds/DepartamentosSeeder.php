<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
	public function run()
	{
		$model = model('DepartamentosModel');

		for ($i = 0; $i < 880; $i++) {
			$model->insert([
				'dep_name'      		=> static::faker()->company,
				'dep_description' 		=> static::faker()->name,
			]);
		}
	}
}
