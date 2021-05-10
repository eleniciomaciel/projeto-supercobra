<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncionarioModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'funcionarios';
	protected $primaryKey           = 'f_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'f_nome',
		'f_cargo',
		'f_email_pessoal',
		'f_codigo',
		'f_fk_obra',
		'f_Fk_frente',
		'f_matricula',
		'f_cpf',
		'f_rg_numero',
		'f_rg_emissor',
		'f_rg_uf',
		'f_rg_data_emissao',
		'f_sexo',
		'f_data_nascimento',
		'f_nacionalidade',
		'f_naturalidade_cidade',
		'f_nacionalidade_uf',
		'f_estado_civil',
		'f_mae',
		'f_pai',
		'f_numero_reservista',
		'f_numero_cartao_sus',
		'f_cep',
		'f_estado',
		'f_cidade',
		'f_bairro',
		'f_endereco',
		'f_endereco_complemento',
		'f_numero_casa',
		'f_telefone_pessoal',
		'f_telefone_contato',
		'f_titulo_eleitor_numero',
		'f_titulo_eleitor_nona',
		'f_titulo_eleitor_sessao',
		'f_titulo_eleitor_uf',
		'f_titulo_eleitor_data_emissao',
		'f_cnh_numero',
		'f_cnh_categoria',
		'f_cnh_emissor',
		'f_cnh_uf',
		'f_cnh_data_emissao',
		'f_cnh_data_vencimento',
		'f_cnh_data_primeira',
		'f_ctps_numero',
		'f_ctps_numero_serie',
		'f_ctps_uf',
		'f_status',
		'f_ctps_data_emissao',
		'f_description'
	];

	// Dates
	protected $useTimestamps        = false;
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
}
