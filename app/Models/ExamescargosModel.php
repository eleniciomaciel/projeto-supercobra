<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamescargosModel extends Model
{
	protected $table                = 'exames_funcao';
	protected $primaryKey           = 'ef_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['ef_fk_funcao','ef_fk_cargos_funcoes','ef_ek_exame','ef_tipos_ad','ef_tipos_d','ef_tipos_p','ef_tipos_m','ef_tipos_r','ef_tipos_is','ef_dias_1','ef_dias_2'];

	public function getCargosFuncoes($slug = false)
	{
		if ($slug === false) {
			return $this->findAll();
		}

		return $this->asArray()
			->join('exames', 'exames.id_ex = exames_funcao.ef_ek_exame')
			->where(['ef_fk_funcao' => $slug])
			->findAll();
	}
}
