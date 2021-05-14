<?php

namespace App\Validation;
use App\Models\AcessousuariosModel;
class Userlocal
{
	public function validateLocal(string $str, string $fields, array $data)
    {
        $model = new AcessousuariosModel();
        
        $array = ['au_fk_frente' =>  $data['my_employer'], 'au_login_corp' => $data['email']];
		$user = $model->where($array)
            ->first();

        if (!$user) {
            return false;
        }
    }
}
