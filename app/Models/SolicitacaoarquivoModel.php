<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitacaoarquivoModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'solicitacao_arquivos';
	protected $primaryKey           = 'doc_solic_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'doc_solic_id_fk_solicitacao',
		'doc_solic_arquivo_nome',
		'doc_solic_descricao',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_em';
	protected $updatedField         = 'updated_em';
	protected $deletedField         = 'deleted_em';
}
