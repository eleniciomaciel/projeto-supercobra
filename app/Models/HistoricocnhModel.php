<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoricocnhModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'historicocnh';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['fk_usuario_cnh','file_cnh','deleted_at'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable($id)
	{
		$builder = $this->db->table('historicocnh');
		$builder->where('fk_usuario_cnh', $id);
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
					<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
						<a class="btn btn-info" href="/Rh/Documentos/DocumentosController/baixarDadosCNH/'.esc($row['file_cnh']).'" target="_blank">
							<i class="fas fa-cloud-download-alt"></i>
						</a>
						
						<button type="button" class="deleteCNH btn btn-danger" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></button>
					</div>
				';
		};

		return $action_button;
	}
}
