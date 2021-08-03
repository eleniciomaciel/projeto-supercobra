<?php

namespace App\Validation;
use App\Models\SolicitacaoMaterialEquipamentosServicosModel;

class SolicitacaoUsuarioJaExiste
{
	public function validateRequestMaterialsEquipmentServices(string $str, string $fields, array $data)
	{
		$model = new SolicitacaoMaterialEquipamentosServicosModel();

		$departamento = $data['s_usuario_departamento'];
		$ano_registro = $data['s_ano_registro'];
		$n_sequencias = $data['s_sequencia'];

		$array = ['smes_departamento_fk' => $departamento, 'smes_ano_registro' => $ano_registro, 'smes_sequencia_numerica_original' => $n_sequencias];
		$sequencia_exists = $model->where($array)->first();

		if ($sequencia_exists > 0) {
			return false;
		}
		return true;
	}
}
