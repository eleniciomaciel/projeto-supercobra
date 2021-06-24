<?php

namespace App\Models;

use CodeIgniter\Model;

class OficinasModel extends Model
{
	protected $table                = 'oficinas';
	protected $primaryKey           = 'ofic_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
	'ofic_fk_fornecedor_veiculo',
	'ofic_fk_frente',
	'ofic_fk_usuario',
	'ofic_nome_fantasia',
	'ofic_responsavel',
	'ofic_email',
	'ofic_telefone',
	'ofic_cnpj',
	'ofic_cep',
	'ofic_uf',
	'ofic_cidade',
	'ofic_bairro',
	'ofic_endereco',
	'ofic_description',
	'ofic_status',];

	// Dates
	protected $useTimestamps        = false;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

}
