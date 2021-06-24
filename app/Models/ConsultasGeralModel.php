<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsultasGeralModel extends Model
{
	public function __construct() {
        parent::__construct();
        //$this->load->database();
        $db = \Config\Database::connect();
    }

    public function getRiscos() {

       $query = $this->db->query('select * from examesocupacionaisriscos');
       return $query->getResult();
    }

    public function getRiscosFuncao($postData) {
		$builder = $this->db->table('examesocupacionaisriscos');
		$builder->select('*');
		$builder->join('cargos', 'cargos.id_cargo = examesocupacionaisriscos.fk_funcao_eor');
		$builder->where('fk_funcao_eor',$postData['id_func']);
		$query = $builder->get();
		return $query->getResult();
	}

	public function getRiscosFuncaoCargo($postData) {
		$builder = $this->db->table('examesocupacionaisriscos');
		$builder->select('*');
		$builder->where('fk_funcao_eor',$postData['id_risc']);
		$query = $builder->get();
		return $query->getResult();
	}
	
   public function getLocadosUsuario($id) {
		$builder = $this->db->table('funcionarios');
		$builder->select('*');
		$builder->join('obras', 'obras.id = funcionarios.f_fk_obra');
		$builder->join('frentes', 'frentes.	id_ft = funcionarios.f_Fk_frente');
		$builder->join('cargos', 'cargos.id_cargo = funcionarios.f_cargo');
		$builder->where('f_id',$id);
		$query = $builder->get();
		return $query->getRowArray();
	}

	public function getExamesRiscos($id)
	{
		$builder = $this->db->table('exames');
		$builder->select('*');
		$builder->join('examescontratuais', 'examescontratuais.id = exames.ex_fk_tipo_contato');
		$builder->where('ex_fk_funcao',$id);
		$query = $builder->get();
		return $query->getResult();
	}
}
