<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\TipoMaoDeObraModel;

class MaoObraEntity extends Entity
{

	public function noticeTable()
	{
		$builder = $this->db->table('user_table');

		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
				<button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="'.$row['id'].'">Edit</button>
				&nbsp;
				<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row['id'].'">Delete</button>
				';
		};

		return $action_button;
	}
	
	protected $datamap = [];
	protected $dates   = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $casts   = [];
}
