<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitacaoMaterialEquipamentosServicosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'solicitacao_material_equipamentos_servicos';
	protected $primaryKey           = 'smes_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'smes_departamento_fk',
		'smes_usuarios_solicitante_fk',
		'smes_frente_solicitante_fk',
		'smes_obra_solicitante_fk',
		'smes_cargo_solicitante_fk',
		'smes_local_entrega',
		'smes_documento_qualidade_revisao_numero',
		'smes_documento_qualidade_codigo_revisao',
		'smes_solicitado_por',
		'smes_sequencia_numerica',
		'smes_sequencia_numerica_original',
		'smes_aplicacao',
		'smes_ano_registro',
		'datetime',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function getSolicitacoesMES($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}

		return $this->asArray()
			->where(['smes_id' => $id])
			->first();
	}
	
	public function getDadosSolictanteMES($id)
	{
		return $this->asArray()
			->join('departamentos', 'departamentos.id = solicitacao_material_equipamentos_servicos.smes_departamento_fk')
			->join('frentes', 'frentes.id_ft = solicitacao_material_equipamentos_servicos.smes_frente_solicitante_fk')
			->where(['smes_id' => $id])
			->first();
	}
}
