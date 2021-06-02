<?php

namespace App\Models;

use CodeIgniter\Model;

class AcessousuariosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'acessousuarios';
	protected $primaryKey           = 'au_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['au_fk_usuario_corp','au_login_corp','au_passwword','au_fk_cargo', 'au_fk_frente','au_fk_obra','au_fk_departamento_func','au_status','role','au_token_active','au_token_expiracao'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
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
	public function getUsuariosLogin($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}
		return $this->asArray()
			->where(['id_cargo' => $id])
			->first();
	}
	public function getUsuarioAcesso($id)
	{
		return $this->asArray()
			->join('funcionarios', 'funcionarios.f_id = acessousuarios.au_fk_usuario_corp')
			->where(['au_fk_usuario_corp' => $id])
			->first();
	}
}
