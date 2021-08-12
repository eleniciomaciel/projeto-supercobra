<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorAuxiliarEmpresaRepresentanteModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'fornecedor_auxiliar_e_r';
	protected $primaryKey           = 'faer_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'faer_fk_representante',
		'faer_fk_empresa',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('fornecedor_auxiliar_e_r');
		$builder->join('fornecedorveiculos', 'fornecedorveiculos.for_id = fornecedor_auxiliar_e_r.faer_fk_representante');
		$builder->join('fornecedor_empresas', 'fornecedor_empresas.ef_id = fornecedor_auxiliar_e_r.faer_fk_empresa');
		//$builder->where('deleted_at', 'NULL');
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<!-- Example single danger button -->
			<div class="btn-group dropleft">
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Opções
			  	</button>
				<div class="dropdown-menu">
					<a class="empresacontaBanco dropdown-item" href="javascript:void(0)" data-id="'.$row['faer_id'].'"><i class="fas fa-university"></i> Bancos</a>
					<a class="empreaDocumentos dropdown-item" href="javascript:void(0)" data-id="'.$row['faer_fk_empresa'].'"><i class="fas fa-folder-plus"></i> Documentos</a>
					<div class="dropdown-divider"></div>
					<a class="empresaDelete dropdown-item" href="javascript:void(0)" data-id="'.$row['faer_id'].'"><i class="fas fa-trash"></i> Deletar</a>
				</div>
			</div>
				';
		};

		return $action_button;
	}
}
