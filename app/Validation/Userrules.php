<?php

namespace App\Validation;
use App\Models\AcessousuariosModel;
class Userrules
{
	// public function custom_rule(): bool
	// {
	// 	return true;
	// }
	public function validateUser(string $str, string $fields, array $data)
    {
        $model = new AcessousuariosModel();
        
        $array = ['au_login_corp' => $data['email'], 'au_status' => '1'];
        $user = $model->where( $array)
            ->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['au_passwword']);
    }
}
