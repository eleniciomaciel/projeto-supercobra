<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorempresaModel extends Model
{
	protected $table                = 'fornecedor_empresas';
	protected $primaryKey           = 'ef_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'ef_razao_social',
		'ef_fk_quem_cadastrou',
		'ef_fk_fornecedor',
		'ef_tipo_dono',
		'ef_nome_dono',
		'ef_cnae',
		'ef_classificacao_empresa',
		'ef_cnpj',
		'ef_incricao_estadual',
		'ef_incricao_municial',
		'ef_cep',
		'ef_uf',
		'ef_cidade',
		'ef_bairro',
		'ef_endereco',
		'ef_description'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';


	public function noticeTable($id)
	{
		$builder = $this->db->table('fornecedor_empresas');
		$builder->where('ef_fk_fornecedor', $id);
		$builder->where('deleted_at', NULL);
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<!-- Example single danger button -->
			<div class="btn-group dropleft">
			  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Opções
			  </button>
			  <div class="dropdown-menu">
				<a class="verEmpresaFornecedor dropdown-item" href="#" data-id="'.$row['ef_id'].'"><i class="fas fa-eye"></i> Visualizar</a>
				<div class="dropdown-divider"></div>
				<a class="delEmpresaFornecedor dropdown-item" href="#" data-id="'.$row['ef_id'].'"><i class="fas fa-trash"></i> Deletar</a>
			  </div>
			</div>
				';
		};

		return $action_button;
	}

	public function pesquisarEmpresa($term)
	{
		if ($term === null) {
			return [];
		} 

		return $this->select('ef_id, ef_fk_fornecedor, ef_razao_social')
		->like('ef_razao_social', $term)
		->where('deleted_at', NULL)
		->get()
		->getResult();
	}
}
