<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsultasGeralModel extends Model
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$db = \Config\Database::connect();
	}

	public function getRiscos()
	{

		$query = $this->db->query('select * from examesocupacionaisriscos');
		return $query->getResult();
	}

	public function getRiscosFuncao($postData)
	{
		$builder = $this->db->table('examesocupacionaisriscos');
		$builder->select('*');
		$builder->join('cargos', 'cargos.id_cargo = examesocupacionaisriscos.fk_funcao_eor');
		$builder->where('fk_funcao_eor', $postData['id_func']);
		$query = $builder->get();
		return $query->getResult();
	}

	public function getRiscosFuncaoCargo($postData)
	{
		$builder = $this->db->table('examesocupacionaisriscos');
		$builder->select('*');
		$builder->where('fk_funcao_eor', $postData['id_risc']);
		$query = $builder->get();
		return $query->getResult();
	}

	public function getLocadosUsuario($id)
	{
		$builder = $this->db->table('funcionarios');
		$builder->select('*');
		$builder->join('obras', 'obras.id = funcionarios.f_fk_obra');
		$builder->join('frentes', 'frentes.	id_ft = funcionarios.f_Fk_frente');
		$builder->join('cargos', 'cargos.id_cargo = funcionarios.f_cargo');
		$builder->where('f_id', $id);
		$query = $builder->get();
		return $query->getRowArray();
	}

	public function getExamesRiscos($id)
	{
		$builder = $this->db->table('exames');
		$builder->select('*');
		$builder->join('examescontratuais', 'examescontratuais.id = exames.ex_fk_tipo_contato');
		$builder->where('ex_fk_funcao', $id);
		$query = $builder->get();
		return $query->getResult();
	}

	public function getFrente($postData)
	{
		$builder = $this->db->table('cento_custo');
		$builder->select('*');
		$builder->join('frentes', 'frentes.id_ft = cento_custo.fk_frente_cc');
		$builder->join('departamentos', 'departamentos.id = cento_custo.fk_departamento');
		$builder->join('atividades', 'atividades.id = cento_custo.fk_atividade_cc');
		$builder->where('id_cc', $postData['id_cc']);
		$query = $builder->get();
		return $query->getResult();
	}

	public function getDeparatemntoFrente($postData)
	{

		$builder = $this->db->table('transferencialocalizacao');
		$builder->select('*');
		$builder->join('departamentos', 'departamentos.id = transferencialocalizacao.trf_fk_departamento');
		$builder->where('trf_fk_frente', $postData['id_frente']);
		$query = $builder->get();
		return $query->getResult();
	}

	public function getDepartamentoVeiculoPlaca($postData)
	{

		$builder = $this->db->table('transferencialocalizacao');
		$builder->select('*');
		$builder->join('veiculos', 'veiculos.vaic_id = transferencialocalizacao.trf_fk_veiculo');
		$builder->where('trf_fk_departamento', $postData['id_department_frent']);
		$query = $builder->get();
		return $query->getResult();
	}

	public function getVeiculoCcLocalDaAtividade($postData)
	{
		$builder = $this->db->table('transferencialocalizacao');
		$builder->select('*');
		$builder->join('cento_custo', 'cento_custo.id_cc = transferencialocalizacao.trf_fk_cc');
		$builder->where('trf_id', $postData['id_veiculo_transferencia_local_cc']);
		$query = $builder->get();
		return $query->getResult();
	}

	public function listaDadosUsuario($id)
	{
		$builder = $this->db->table('funcionarios');
		$builder->select('*');
		$builder->join('cargos', 'cargos.id_cargo = funcionarios.f_cargo');
		$builder->join('obras', 'obras.id = funcionarios.f_fk_obra');
		$builder->join('frentes', 'frentes.id_ft = funcionarios.f_Fk_frente');
		$builder->where('f_id', $id);
		$query = $builder->get();
		return $query->getRowArray();
	}

	public function getFuncionarioObra($id)
	{

		$builder = $this->db->table('obras');
		$builder->select('*');
		$builder->where('id', $id);
		$query = $builder->get();
		return $query->getRowArray();
	}
}
