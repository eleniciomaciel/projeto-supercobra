<?php

namespace App\Validation;
use App\Models\ExamescargosModel;

class TwoExamsAlreadyExistrulesValidation
{
	public function alreadyExists(string $str, string $fields, array $data){
    
		$model = new ExamescargosModel();
		$funcao = $data['select_cargos_p_aso'];
		$exames = $data['new_exames_select'];

		$array = ['ef_fk_funcao'=>$funcao, 'ef_ek_exame'=> $exames];
        $user = $model->where($array)->first();

        if ($user > 0) {
            return false;
        }
		return true;
	  }
}
