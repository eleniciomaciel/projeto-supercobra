<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorContaModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'fornecedor_conta_bancaria';
	protected $primaryKey           = 'cbf_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'cbf_fornecedor_fk',
		'cbf_obra_fk',
		'cbf_frente_fk',
		'cbf_banco',
		'cbf_tipo_conta',
		'cbf_agencia',
		'cbf_numero_conta',
		'cbf_digito_conta',
		'cbf_Observacoes_conta'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_em';
	protected $updatedField         = 'updated_em';
	protected $deletedField         = 'deleted_em';

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
