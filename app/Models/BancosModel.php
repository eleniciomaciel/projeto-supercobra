<?php

namespace App\Models;

use CodeIgniter\Model;

class BancosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'bancos';
	protected $primaryKey           = 'id_b';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['b_nome','b_numero'];

	public function noticeTable()
	{
		$builder = $this->db->table('bancos');

		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
				<div class="dropdown">
					<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Opções
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="clickListBanco dropdown-item" href="#" data-id="'.$row['id_b'].'"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>
						<a class="deleteBanco dropdown-item" href="#" data-id="'.$row['id_b'].'"><i class="fa fa-power-off"></i>&nbsp;Desativar</a>
					</div>
				</div>
				';
		};

		return $action_button;
	}
}
