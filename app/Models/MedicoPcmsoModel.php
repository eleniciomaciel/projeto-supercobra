<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicoPcmsoModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'medicopcmsos';
	protected $primaryKey           = 'medic_pcmso_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'medic_fk_pcmso_quem_cadastrou',
		'medic_pcmso_nome',
		'medic_pcmso_email',
		'medic_pcmso_crm',
		'medic_pcmso_description',
		'medic_pcmso_status',
	];

	// Dates
	protected $useTimestamps        = true;
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
}
