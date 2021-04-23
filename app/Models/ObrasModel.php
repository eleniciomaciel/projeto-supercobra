<?php

namespace App\Models;

use CodeIgniter\Model;

class ObrasModel extends Model
{
	protected $table                = 'obras';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['obras_local','obras_estado','obras_cidade','obras_description','status'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'obras_local'     		=> 'required|alpha_numeric_space|min_length[3]|max_length[100]|is_unique[users.email]',
        'obras_estado'        	=> 'required|exact_length[2]',
        'obras_cidade'     		=> 'required|min_length[2]|max_length[50]',
        'obras_description' 	=> 'required',
        'status' 				=> 'required'
	];
	protected $validationMessages   = [
		'obras_local'        => [
            'is_unique' => 'Ops. Esse local já foi cadastrado.'
        ]
	];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
