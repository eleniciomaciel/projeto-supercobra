<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitaitenscompraModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'solicitacao_itens_compra';
	protected $primaryKey           = 'isc_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'isc_id_fk_solicitacao_compra',
		'isc_fk_id_solicitante',
		'isc_unidade',
		'isc_quantidade',
		'isc_descricao_da_requisicao',
		'isc_requisito_meio_ambiente',
		'isc_cento_custo',
		'isc_data_necessidade',
		'isc_observacoes',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
