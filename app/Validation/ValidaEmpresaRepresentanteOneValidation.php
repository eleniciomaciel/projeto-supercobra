<?php

namespace App\Validation;
use App\Models\FornecedorAuxiliarEmpresaRepresentanteModel;

class ValidaEmpresaRepresentanteOneValidation
{
	public function evenVericaExistesDoisCadastros(string $str, string $fields, array $data)
	{
		$model 			= new FornecedorAuxiliarEmpresaRepresentanteModel();
		$empresa 		= $data['userid_hide'];
		$representante 	= $data['userid_representante_hide'];

		$array = ['faer_fk_empresa' => $empresa, 'faer_fk_representante' => $representante];
        $retorno = $model->where($array)->first();

        if ($retorno > 0) {
            return false;
        }
		return true;
	}
}
