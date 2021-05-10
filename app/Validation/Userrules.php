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
        $user = $model->where('au_login_corp', $data['email'])
            ->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['au_passwword']);
    }
}
