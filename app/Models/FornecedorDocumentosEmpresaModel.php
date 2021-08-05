<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorDocumentosEmpresaModel extends Model
{
	protected $table                = 'fornecedor_documentos_empresas';
	protected $primaryKey           = 'f_doc_emp_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'f_doc_emp_empresa_fk',
		'f_doc_emp_empresario_fornecedor_fk',
		'f_doc_emp_quem_cadastrou_fk',
		'f_doc_emp_file_documento',
		'f_doc_emp_description',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

}
