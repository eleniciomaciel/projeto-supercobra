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
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'for_fk_obra',
		'for_fk_frente',
		'for_fk_usuario',
		'for_nome_fantasia',
		'for_responsavel',
		'for_email',
		'for_telefone',
		'for_telefone2',
		'for_cnpj',
		'for_cep',
		'for_uf',
		'for_cidade',
		'for_bairro',
		'for_endereco',
		'for_description',
		'for_status'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('fornecedorveiculos');
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
				<a class="dropdown-item" href="/transporte-fornecedor/dados-fornecedor/'.$row['for_id'].'"><i class="fas fa-eye"></i> Visualizar</a>
				<a class="dropdown-item" href="/transporte-fornecedor/contas-fornecedor/'.$row['for_id'].'"><i class="fas fa-university"></i> Contas Bancárias</a>
				<a class="dropdown-item" href="/transporte-fornecedor/contratos-fornecedor/'.$row['for_id'].'"><i class="fas fa-archive"></i> Contratos</a>
				<a class="dropdown-item" href="/transporte-fornecedor/documentos-fornecedor/'.$row['for_id'].'"><i class="fas fa-file-pdf"></i> Documentos</a>
				<a class="dropdown-item" href="/transporte-fornecedor/empresas-fornecedor/'.$row['for_id'].'"><i class="fas fa-building"></i> Empresas</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="/transporte-fornecedor/deletar-fornecedor/'.$row['for_id'].'"><i class="fas fa-trash"></i> Deletar</a>
			  </div>
			</div>
				';
		};

		return $action_button;
	}

	public function pesquisarCpfRepresentante($term)
	{
		if ($term === null) {
			return [];
		} 

		return $this->select('for_id, for_responsavel, for_cnpj')
		->like('for_cnpj', $term)
		->where('deleted_at', NULL)
		->get()
		->getResult();
	}
}
