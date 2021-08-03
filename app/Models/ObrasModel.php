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
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['obras_local','obras_abreviacao','cnpj_cli','data_inicio','data_fim','obras_cep','obras_estado','obras_cidade','obras_endereco','obras_numero','obras_bairro','obras_cliente','status','obras_description','datetime','created_at','updated_at','deleted_at'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function getObras($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}

		return $this->asArray()
			->join('clientes', 'clientes.id_cli = obras.id')
			->where(['id' => $id])
			->first();
	}

	public function getObrasId($id)
	{
		return $this->asArray()
			->join('clientes', 'clientes.id_cli = obras.id')
			->where(['id' => $id])
			->first();
	}
}