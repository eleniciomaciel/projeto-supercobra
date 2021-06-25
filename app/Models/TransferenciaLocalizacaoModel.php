<?php

namespace App\Models;

use CodeIgniter\Model;

class TransferenciaLocalizacaoModel extends Model
{
	protected $table                = 'transferencialocalizacao';
	protected $primaryKey           = 'trf_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['trf_fk_veiculo','trf_fk_cc','trf_fk_frente','trf_fk_departamento','trf_fk_atividade','trf_description'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function listaTransferenciaVeiculo()
	{
		return $this->asArray()
			->join('veiculos', 'veiculos.vaic_id = transferencialocalizacao.trf_fk_veiculo')
			->join('frentes', 'frentes.id_ft = transferencialocalizacao.trf_fk_frente')
			->join('cento_custo', 'cento_custo.id_cc = transferencialocalizacao.trf_fk_cc')
			->findAll();
	}
}
