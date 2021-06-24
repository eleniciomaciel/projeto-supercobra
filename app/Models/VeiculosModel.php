<?php

namespace App\Models;

use CodeIgniter\Model;

class VeiculosModel extends Model
{
	protected $table                = 'veiculos';
	protected $primaryKey           = 'vaic_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'vaic_fk_fornecedor',
		'vaic_fk_frente',
		'vaic_nome',
		'vaic_marca',
		'vaic_modelo',
		'vaic_ano',
		'vaic_placa',
		'vaic_chassi',
		'vaic_cor',
		'vaic_data_compra',
		'vaic_valor_veiculo',
		'vaic_tipo_combustivel',
		'vaic_description',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	
}
