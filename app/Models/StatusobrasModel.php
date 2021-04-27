<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusobrasModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'statusobras';
	protected $primaryKey           = 'st_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['st_title'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
