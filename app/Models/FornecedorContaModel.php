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
		'cbf_empresa_fk',
		'cbf_obra_fk',
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

	public function noticeTable($id)
	{
		$builder = $this->db->table('fornecedor_conta_bancaria');
		$builder->where('cbf_empresa_fk', $id);
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group dropleft">
  				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Opções
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item active" href="#"><i class="fas fa-eye"></i> Visualizar</a>
				<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Deletar</a>
				</div>
		  	</div>
				';
		};

		return $action_button;
	}
}
