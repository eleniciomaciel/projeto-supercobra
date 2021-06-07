<?php

namespace App\Models;

use CodeIgniter\Model;

class ClinicasModel extends Model
{
	//protected $DBGroup = 'group_name';
	protected $table                = 'clinicas';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'fk_frente',
		'cli_nome',
		'cli_responsavel',
		'cli_cnpj',
		'cli_telefone',
		'cli_email',
		'cli_cep',
		'cli_estado',
		'cli_cidade',
		'cli_bairro',
		'cli_endereco',
		'cli_dias_1',
		'cli_dias_2',
		'cli_dias_3',
		'cli_dias_4',
		'cli_dias_5',
		'cli_dias_6',
		'cli_dias_7',
		'cli_observacoes'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable($id_frente)
	{
		$builder = $this->db->table('clinicas');
		$builder->where('fk_frente', $id_frente);
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
				<button type="button" class="viewClinica btn btn-info" data-id="'.$row['id'].'"><i class="fas fa-eye"></i></button>
				<button type="button" class="deleteClinica btn btn-danger" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></button>
			</div>
				';
		};

		return $action_button;
	}

}
