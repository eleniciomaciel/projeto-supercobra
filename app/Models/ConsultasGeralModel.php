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
		$builder->join('cargofuncoes', 'cargofuncoes.id = examesocupacionaisriscos.fk_funcao_eor');
		$builder->where('fk_funcao_eor',$postData['id_func']);
		$query = $builder->get();
		return $query->getResult();
	}
}
