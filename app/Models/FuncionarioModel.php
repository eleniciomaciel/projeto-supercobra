<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncionarioModel extends Model
{
	protected $table                = 'funcionarios';
	protected $primaryKey           = 'f_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes        = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'f_nome',
		'f_conjugue',
		'f_codigo',
		'f_matricula',
		'f_sexo',
		'f_estado_civil',
		'f_grau_instrucao',
		'f_nacionalidade',
		'f_nacionalidade_uf',
		'f_naturalidade_cidade',
		'f_data_nascimento',
		'f_mae',
		'f_pai',
		'f_telefone_pessoal',
		'f_contato_alternativo',
		'f_telefone_contato',
		'f_email_pessoal',
		'f_cep',
		'f_estado',
		'f_cidade',
		'f_bairro',
		'f_numero_casa',
		'f_endereco',
		'f_endereco_complemento',
		'f_rg_numero',
		'f_rg_uf',
		'f_rg_data_emissao',
		'f_rg_emissor',
		'f_titulo_eleitor_numero',
		'f_titulo_eleitor_nona',
		'f_titulo_eleitor_sessao',
		'f_titulo_eleitor_uf',
		'f_titulo_eleitor_data_emissao',
		'f_cpf',
		'f_pis',
		'f_numero_reservista',
		'f_numero_cartao_sus',
		'f_ctps_numero',
		'f_ctps_numero_serie',
		'f_ctps_data_emissao',
		'f_ctps_uf',
		'f_fgts_categoria',
		'f_fgts_codigo',
		'f_uniforme_camisa',
		'f_uniforme_calca',
		'f_tipo_sangue',
		'f_cargo',
		'f_fk_obra',
		'f_Fk_frente',
		'f_fk_cento_custo',
		'f_horas_trabalho',
		'f_fk_id_departamento',
		'f_fk_encarregado',
		'f_situacao',
		'f_admissao',
		'f_desligamento',
		'f_salario',
		'f_tipo_pagamento',
		'f_tipo_salario',
		'f_insalubridade',
		'f_periculosidade',
		'f_desconto_sindical',
		'f_ps',
		'f_funcao',
		'f_cnh_numero',
		'f_cnh_categoria',
		'f_cnh_emissor',
		'f_cnh_uf',
		'f_cnh_data_emissao',
		'f_cnh_data_vencimento',
		'f_cnh_data_primeira',
		'f_status',
		'f_fk_local_trabalho',
		'f_tipo_moradia',
		'f_description',
		'f_aeroporto_cep',
		'f_aeroporto_uf',
		'f_aeroporto_cidade',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getFuncionarios($slug = false)
	{
		if ($slug === false) {
			return $this->asArray()
			->join('cargos', 'cargos.id_cargo = funcionarios.f_cargo')
			->findAll();
		}

		return $this->asArray()
			->where(['f_id' => $slug])
			->first();
	}

	/**lista funcionarios do rh */
	public function getFuncionariosId($id)
	{
		return $this->asArray()
			->where(['f_id' => $id])
			->first();
	}
	
	public function getHabilitacaoUser($id_frente)
	{
		$data_hoje = date('Y-m-d');
		$builder = $this->db->table('funcionarios');
		$query = $builder->select('*')
                 ->where('f_Fk_frente', $id_frente)
                 ->where('f_cnh_data_vencimento !=', 'NULL')
                 ->where('f_cnh_data_vencimento <=', $data_hoje)
                 ->get();
		return $query->getResult();
	}
	/**lista funcionarios do rh da frente */
	public function getFuncionariosFrente($id)
	{
		return $this->asArray()
			->where(['f_Fk_frente' => $id])
			->findAll();
	}
	public function noticeTable()
	{
		$builder = $this->db->table('funcionarios');
		$builder->where('f_status', 'Ativo');
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group">
				<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Opções
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="/Rh/CadastrocolaboradorController/visualizaDadosCadastrado/'.esc($row['f_id']).'"><i class="fas fa-eye"></i>&nbsp;Visualizar</a>
					<a class="cl_func_doc dropdown-item" href="/Rh/Documentos/DocumentosController/index/'.esc($row['f_id']).'" data-id="'.$row['f_id'].'"><i class="fas fa-file-pdf"></i>&nbsp;Documentos</a>
					<a class="dropdown-item" href="/Rh/Documentos/DocumentosController/habilitacao/'.esc($row['f_id']).'" data-id="'.$row['f_id'].'"><i class="fas fa-id-card"></i>&nbsp;Habilitação</a>
					<a class="cl_func_aso dropdown-item" href="/aso/gerar-aso/'.$row['f_id'].'"><i class="fas fa-file-medical-alt"></i>&nbsp;ASO</a>
					<a class="dropdown-item" href="'. site_url('/banco/page-banco/'.$row['f_id']).'"><i class="fas fa-university"></i>&nbsp;Banco</a>
					<a class="dropdown-item" href="'. site_url('/transferencia/funcionario-transfere/'.$row['f_id']).'"><i class="fas fa-user-cog"></i>&nbsp;Transferir</a>
				<div class="dropdown-divider"></div>
					<a class="cl_func_desabilita dropdown-item" href="#" id="'.$row['f_id'].'"><i class="fas fa-power-off"></i>&nbsp;Desativar</a>
				</div>
			</div>
				';
		};

		return $action_button;
	}


	/**
	 * lista os colaboradores não ativos
	 */

	public function noticeTableDesativados()
	{
		$builder = $this->db->table('funcionarios');
		$builder->where('f_status', 'Desativado');
		return $builder;
	}

	public function button_desativado()
	{
		$action_button = function($row){
			return '
			<div class="btn-group">
				<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Opções
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="/Rh/CadastrocolaboradorController/visualizaDadosCadastrado/'.esc($row['f_id']).'"><i class="fas fa-eye"></i>&nbsp;Visualizar</a>
					<a class="cl_func_doc dropdown-item" href="/Rh/Documentos/DocumentosController/index/'.esc($row['f_id']).'" data-id="'.$row['f_id'].'"><i class="fas fa-file-pdf"></i>&nbsp;Documentos</a>
					<a class="dropdown-item" href="/Rh/Documentos/DocumentosController/habilitacao/'.esc($row['f_id']).'" data-id="'.$row['f_id'].'"><i class="fas fa-id-card"></i>&nbsp;Habilitação</a>
					<a class="cl_func_aso dropdown-item" href="/aso/gerar-aso/'.$row['f_id'].'"><i class="fas fa-file-medical-alt"></i>&nbsp;ASO</a>
					<a class="dropdown-item" href="'. site_url('/banco/page-banco/'.$row['f_id']).'"><i class="fas fa-university"></i>&nbsp;Banco</a>
					<a class="dropdown-item" href="'. site_url('/transferencia/funcionario-transfere/'.$row['f_id']).'"><i class="fas fa-user-cog"></i>&nbsp;Transferir</a>
					<a class="dropdown-item" href="'. base_url('Rh/CadastrocolaboradorController/ativaColaborador/'.$row['f_id']).'"><i class="fas fa-user-check"></i>&nbsp;Ativar Colaborador</a>
				<div class="dropdown-divider"></div>
					<a class="cl_func_desabilita dropdown-item" href="#" id="'.$row['f_id'].'"><i class="fas fa-power-off"></i>&nbsp;Desativar</a>
				</div>
			</div>
				';
		};

		return $action_button;
	}

}
