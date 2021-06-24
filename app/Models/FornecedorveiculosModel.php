<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorveiculosModel extends Model
{
	protected $table                = 'fornecedorveiculos';
	protected $primaryKey           = 'for_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['for_fk_obra','for_fk_frente','for_fk_usuario','for_nome_fantasia','for_responsavel','for_email','for_telefone','for_cnpj','for_cep','for_uf','for_cidade','for_bairro','for_endereco','for_description','for_status',];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

}
