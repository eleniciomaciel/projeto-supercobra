<?php

namespace App\Models;

use CodeIgniter\Model;

class FrentesModel extends Model
{
	protected $table                = 'frentes';
	protected $primaryKey           = 'id_ft';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['cliente_fk_id_ft','obra_fk_id_ft','nome_ft','data_inicial_ft','data_final_ft','cep_ft','estado_uf_ft','cidade_ft','bairro_ft','endereco_ft','numero_ft','ponto_referencia_ft'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function getFrentes($id = false)
	{
		if ($id === false) {
			
			return $this->asArray()
			->join('clientes', 'clientes.id_cli = frentes.id_ft')
			->join('obras', 'obras.id = frentes.id_ft')
			->findAll();
		}

		return $this->asArray()
			->join('clientes', 'clientes.id_cli = frentes.id_ft')
			->join('obras', 'obras.id = frentes.id_ft')
			->where(['id_ft' => $id])
			->first();
	}
}
