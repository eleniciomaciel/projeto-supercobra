<?php

namespace App\Validation;
use App\Models\QualidadeDocumentosModel;

class QualidadeQuantidade
{
	public function validateQuantidade(string $str, string $fields, array $data)
    {
        $model = new QualidadeDocumentosModel();
        $qtd = $model->where('qld_id', $data['id_documento'])->first();

        if ($qtd['qld_versao'] >= $data['qld_versao']) {
            return false;
        }
		return true;
    }
}
