<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreQualidadeDocumentoModel extends Model
{
	protected $table                = 'qualidade_store_documentos';
	protected $primaryKey           = 'id_st';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['st_origem','st_descricao','st_data','st_justificativa','st_versao'];
}
