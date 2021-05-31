<?php

namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\Estados\EstadosModel;
use App\Models\CargofuncoesModel;
use App\Models\CargosModel;
use App\Models\DepartamentosModel;
use App\Models\CentocustoModel;
use monken\TablesIgniter;
use App\Models\FuncionarioModel;
use App\Models\FrentesModel;


class CadastrocolaboradorController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'cadastro-colaborador')
	{
		if (!is_file(APPPATH . 'Views/frentesObras/frenteRh/layout/pages/colaborador/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data['title'] = ucfirst($page); 
		echo view('frentesObras/frenteRh/layout/pages/colaborador/' . $page, $data);
	}

	public function cadastro($page = 'cadastrar-dados')
	{
		$id_frente = session()->get('log_frente');

		$estados 		= new EstadosModel();
		$funcao 		= new CargosModel();
		$departamento  	= new DepartamentosModel();
		$cento_custo    = new CentocustoModel();
		$frentes        = new FrentesModel();

		if (!is_file(APPPATH . 'Views/frentesObras/frenteRh/layout/pages/colaborador/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data = [
			'estados' 		=> $estados->getEstados(),
			'funcao'  		=> $funcao->findAll(),
			'departamento'  => $departamento->findAll(),
			'list_c_custo'  => $cento_custo->getFrenteCC($id_frente),
			'list_frente'   => $frentes->findAll(),
		]; 
		echo view('frentesObras/frenteRh/layout/pages/colaborador/' . $page, $data);
	}

	/**cadastro */
	public function addNovoFuncionario()
	{
		if($this->request->getMethod() === 'post')
		{

			$x_add_colab_nome_error = '';
            $x_add_colab_conjuge_nome_error = '';
            $x_add_colab_codigo_error = '';

			$x_add_colab_matricula_error = '';
            $add_colab_sexo_error = '';
            $add_colab_estado_civil_error = '';

			$add_colab_escolaridade_error = '';
            $add_colab_nacionalidade_error = '';
            $add_colab_naturalidade_error = '';

			$add_colab_uf_naturalidade_error = '';
            $add_colab_data_nacimento_error = '';
            $add_colab_nome_mae_error = '';
            $add_colab_do_pai_error = '';

			//dados do contato
			$add_colab_contato_pricipal_error = '';
            $add_colab_contato_alternativo_error = '';
            $add_colab_contato_familiar_error = '';
            $add_colab_email_pessoal_error = '';

			//endereço
			$add_colab_cep_moradia_error = '';
            $add_colab_uf_moradia_error = '';
            $add_colab_cidade_moradia_error = '';
            $add_colab_bairro_moraddia_error = '';
			$add_colab_rua_moradia_error = '';
            $add_colab_numero_moradia_error = '';
            $add_colab_complemento_morada_error = '';

			//documentos
			$add_colab_doc_numero_rg_error = '';
            $add_colab_doc_orgao_emissor_rg_error = '';
            $add_colab_doc_data_rg_emissao_error = '';
            $add_colab_doc_uf_rg_error = '';
			$add_colab_titulo_numero_error = '';
            $add_colab_titulo_zona_error = '';
            $add_colab_titulo_sessao_error = '';
			$add_colab_titulo_data_emissao_error = '';
            $add_colab_titulo_uf_emissao_error = '';
            $add_colab_cpf_numero_error = '';
            $add_colab_numero_pis_error = '';
			$add_colab_reservista_numero_error = '';
            $add_colab_sus_numero_error = '';

			//CTPS--FGTS
			$add_colab_ctps_numero_error = '';
            $add_colab_ctps_serie_error = '';
            $add_colab_data_emissao_error = '';
            $add_colab_uf_emissor_error = '';
			$add_colab_fgts_categoria_error = '';
            $add_colab_fgts_codigo_error = '';

			//UNIFORME -- TIPO SANGUE
			$add_colab_uniforme_tamanho_error = '';
			$add_colab_uniforme_calca_error = '';
            $add_colab_tipo_sangue_error = '';

			//FUNCIONAIS
			$add_colab_funcao_cargo_error = '';
			$add_colab_funcao_situacao_error = '';
            $add_colab_funcao_admissao_data_error = '';

			$add_colab_funcao_desligamento_data_data_error = '';
			$add_colab_funcao_hora_extra_fixa_error = '';
            $add_colab_funcao_salario_error = '';
			
			$add_colab_funcao_tipo_pagamento_error = '';
			$add_colab_funcao_tipo_salario_error = '';
            $add_colab_funcao_departamento_error = '';

			$add_colab_cento_de_custo_error = '';
			$add_colab_funcao_hora_extras_error = '';
            //$add_colab_funcao_encarregado_error = '';

			$add_colab_funcao_periculosidade_error = '';
			$add_colab_funcao_insalubridade_error = '';
            $add_colab_funcao_desconto_sindical_error = '';
			$add_colab_funcao_ps_error = '';

			//Aeroporto
			$add_colab_cep_aeroporto_error = '';
			$add_colab_uf_eroporto_error = '';
			$add_colab_cidade_aeroporto_error = '';

			//outros
			$add_colab_outros_local_trabalho_error = '';
			$add_colab_outros_tipo_moradia_error = '';
			$add_colab_outros_observacao_error = '';

            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([

				'x_add_colab_nome' => ['label' => 'funcionário', 'rules' => 'required|max_length[100]|is_unique[funcionarios.f_nome]'],
				'x_add_colab_conjuge' => ['label' => 'conjugue', 'rules' => 'required|max_length[100]|is_unique[funcionarios.f_conjugue]'],
				'x_add_colab_codigo' => ['label' => 'código', 'rules' => 'required|integer|max_length[20]|is_unique[funcionarios.f_codigo]'],
				'x_add_colab_matricula' => ['label' => 'matrícula', 'rules' => 'required|integer|max_length[20]|is_unique[funcionarios.f_matricula]'],
				'add_colab_sexo' => ['label' => 'sexo', 'rules' => 'required'],
				'add_colab_estado_civil' => ['label' => 'estado civil', 'rules' => 'required'],
				'add_colab_escolaridade' => ['label' => 'escolaridade', 'rules' => 'required'],
				'add_colab_nacionalidade' => ['label' => 'nacionalidade', 'rules' => 'required'],
				'add_colab_naturalidade' => ['label' => 'naturalidade', 'rules' => 'required'],
				'add_colab_uf_naturalidade' => ['label' => 'uf naturalidade', 'rules' => 'required'],
				'add_colab_data_nacimento' => ['label' => 'data de nascimento', 'rules' => 'required'],
				'add_colab_nome_mae' => ['label' => 'nome da mãe', 'rules' => 'required|min_length[5]|max_length[100]'],
				'add_colab_do_pai' => ['label' => 'nome do pai', 'rules' => 'required|min_length[5]|max_length[100]'],

				//contat
				'add_colab_contato_pricipal' => ['label' => 'telefone principal', 'rules' => 'required|min_length[15]'],
				'add_colab_contato_alternativo' => ['label' => 'telefone alternativo', 'rules' => 'required|min_length[15]'],
				'add_colab_contato_familiar' => ['label' => 'contato familiar', 'rules' => 'required|min_length[15]'],
				'add_colab_email_pessoal' => ['label' => 'email pessoal', 'rules' => 'valid_email|min_length[5]|max_length[100]|is_unique[funcionarios.f_email_pessoal]'],

				//endereço
				'add_colab_cep_moradia' => ['label' => 'cep', 'rules' => 'required|exact_length[10]'],
				'add_colab_uf_moradia' => ['label' => 'uf', 'rules' => 'required'],
				'add_colab_cidade_moradia' => ['label' => 'cidade', 'rules' => 'required'],
				'add_colab_bairro_moraddia' => ['label' => 'bairro', 'rules' => 'required|min_length[5]'],
				'add_colab_rua_moradia' => ['label' => 'rua', 'rules' => 'required|min_length[10]'],
				'add_colab_numero_moradia' => ['label' => 'número', 'rules' => 'required|integer'],
				'add_colab_complemento_morada' => ['label' => 'complemento', 'rules' => 'required|min_length[10]'],

				//documentos 13
				'add_colab_doc_numero_rg' => ['label' => 'RG', 'rules' => 'required|min_length[5]|max_length[30]|is_unique[funcionarios.f_rg_numero]'],
				'add_colab_doc_orgao_emissor_rg' => ['label' => 'uf', 'rules' => 'required'],
				'add_colab_doc_data_rg_emissao' => ['label' => 'data', 'rules' => 'required|valid_date'],
				'add_colab_doc_uf_rg' => ['label' => 'uf o rg', 'rules' => 'required'],
				'add_colab_titulo_numero' => ['label' => 'número do título', 'rules' => 'required|min_length[5]|max_length[30]|is_unique[funcionarios.f_titulo_eleitor_numero]'],
				'add_colab_titulo_zona' => ['label' => 'zona', 'rules' => 'required|max_length[30]'],
				'add_colab_titulo_sessao' => ['label' => 'sessão', 'rules' => 'required|max_length[30]'],
				'add_colab_titulo_data_emissao' => ['label' => 'data do título', 'rules' => 'required|valid_date'],
				'add_colab_titulo_uf_emissao' => ['label' => 'uf do título', 'rules' => 'required'],
				'add_colab_cpf_numero' => ['label' => 'CPF', 'rules' => 'required|exact_length[14]|is_unique[funcionarios.f_cpf]'],
				'add_colab_numero_pis' => ['label' => 'número do PIS', 'rules' => 'required|min_length[10]|max_length[30]|is_unique[funcionarios.f_pis]'],
				'add_colab_reservista_numero' => ['label' => 'número da reservista', 'rules' => 'required|min_length[5]|max_length[30]|is_unique[funcionarios.f_numero_reservista]'],
				'add_colab_sus_numero' => ['label' => 'número do cartão SUS', 'rules' => 'required|max_length[30]|is_unique[funcionarios.f_numero_cartao_sus]'],

				//CTPS--FGTS
				'add_colab_ctps_numero' 	=> ['label' => 'CTPS', 'rules' => 'required|min_length[10]|max_length[50]|is_unique[funcionarios.f_ctps_numero]'],
				'add_colab_ctps_serie' 		=> ['label' => 'SÉRIE', 'rules' => 'required|min_length[10]|max_length[50]|is_unique[funcionarios.f_ctps_numero_serie]'],
				'add_colab_data_emissao' 	=> ['label' => 'EMISSOR', 'rules' => 'required|min_length[10]'],
				'add_colab_uf_emissor' 		=> ['label' => 'UF', 'rules' => 'required'],
				'add_colab_fgts_categoria' 	=> ['label' => 'número do FGTS', 'rules' => 'required'],
				'add_colab_fgts_codigo' 	=> ['label' => 'código do FGTS', 'rules' => 'required|min_length[5]|max_length[50]|is_unique[funcionarios.f_fgts_codigo]'],

				//UNIFORME -- TIPO SANGUE
				'add_colab_uniforme_tamanho'=> ['label' => 'CAMISA', 'rules' => 'required'],
				'add_colab_uniforme_calca' 	=> ['label' => 'CALÇA', 'rules' => 'required'],
				'add_colab_tipo_sangue' 	=> ['label' => 'SANGUE', 'rules' => 'required'],

				//FUNCIONAIS
				'add_colab_funcao_cargo' 	=> ['label' => 'FUNÇÃO', 'rules' => 'required'],
				'add_colab_funcao_situacao' 	=> ['label' => 'SITUAÇÃO', 'rules' => 'required'],
				'add_colab_funcao_admissao_data' 	=> ['label' => 'ADIMISSÃO', 'rules' => 'required|valid_date'],
				'add_colab_funcao_desligamento_data' 	=> ['label' => 'DESLIGAMENTO', 'rules' => 'required|valid_date'],

				'add_colab_funcao_hora_extra_fixa' 	=> ['label' => 'H.: EXTRAS FIXA', 'rules' => 'required'],
				'add_colab_funcao_salario' 	=> ['label' => 'SALÁRIO', 'rules' => 'required'],
				'add_colab_funcao_tipo_pagamento' 	=> ['label' => 'TIPO DE PAGAMENTO', 'rules' => 'required'],
				'add_colab_funcao_tipo_salario' 	=> ['label' => 'TIPO DE SALÁRIO', 'rules' => 'required'],
				
				'add_colab_funcao_departamento' 	=> ['label' => 'DEPARTAMENTO', 'rules' => 'required'],
				'add_colab_cento_de_custo' 	=> ['label' => 'CENTO DE CUSTO', 'rules' => 'required'],
				'add_colab_funcao_hora_extras' 	=> ['label' => 'H.: EXTRAS', 'rules' => 'required'],
				//'add_colab_funcao_encarregado' 	=> ['label' => 'ENCARREGADO', 'rules' => 'required'],

				'add_colab_funcao_periculosidade' 	=> ['label' => 'PERICULOSIDADE', 'rules' => 'required'],
				'add_colab_funcao_insalubridade' 	=> ['label' => 'INSALUBRIDADE', 'rules' => 'required'],
				'add_colab_funcao_desconto_sindical' 	=> ['label' => 'DESCONTO SINDICAL', 'rules' => 'required'],
				'add_colab_funcao_ps' 	=> ['label' => 'PS', 'rules' => 'required'],

				//Aeroporto
				'add_colab_cep_aeroporto' 	=> ['label' => 'CEP', 'rules' => 'required|exact_length[10]'],
				'add_colab_uf_eroporto' 	=> ['label' => 'UF', 'rules' => 'required|exact_length[2]'],
				'add_colab_cidade_aeroporto' 	=> ['label' => 'CIDADE', 'rules' => 'required'],

				//Outros
				'add_colab_outros_local_trabalho' 	=> ['label' => 'LOCAL', 'rules' => 'required'],
				'add_colab_outros_tipo_moradia' 	=> ['label' => 'MORADIA', 'rules' => 'required'],
				'add_colab_outros_observacao' 	=> ['label' => 'OBSERVAÇÃO', 'rules' => 'required'],

				//foreing key
				

            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('x_add_colab_nome'))
            	{
            		$x_add_colab_nome_error = $validation->getError('x_add_colab_nome');
            	}

            	if($validation->getError('x_add_colab_conjuge'))
            	{
            		$x_add_colab_conjuge_nome_error = $validation->getError('x_add_colab_conjuge');
            	}

            	if($validation->getError('x_add_colab_codigo'))
            	{
            		$x_add_colab_codigo_error = $validation->getError('x_add_colab_codigo');
            	}
				if($validation->getError('x_add_colab_matricula'))
            	{
            		$x_add_colab_matricula_error = $validation->getError('x_add_colab_matricula');
            	}
				if($validation->getError('add_colab_sexo'))
            	{
            		$add_colab_sexo_error = $validation->getError('add_colab_sexo');
            	}
				if($validation->getError('add_colab_estado_civil'))
            	{
            		$add_colab_estado_civil_error = $validation->getError('add_colab_estado_civil');
            	}
				if($validation->getError('add_colab_escolaridade'))
            	{
            		$add_colab_escolaridade_error = $validation->getError('add_colab_escolaridade');
            	}
				if($validation->getError('add_colab_nacionalidade'))
            	{
            		$add_colab_nacionalidade_error = $validation->getError('add_colab_nacionalidade');
            	}
				if($validation->getError('add_colab_naturalidade'))
            	{
            		$add_colab_naturalidade_error = $validation->getError('add_colab_naturalidade');
            	}

				if($validation->getError('add_colab_uf_naturalidade'))
            	{
            		$add_colab_uf_naturalidade_error = $validation->getError('add_colab_uf_naturalidade');
            	}
				if($validation->getError('add_colab_data_nacimento'))
            	{
            		$add_colab_data_nacimento_error = $validation->getError('add_colab_data_nacimento');
            	}
				if($validation->getError('add_colab_nome_mae'))
            	{
            		$add_colab_nome_mae_error = $validation->getError('add_colab_nome_mae');
            	}
				if($validation->getError('add_colab_do_pai'))
            	{
            		$add_colab_do_pai_error = $validation->getError('add_colab_do_pai');
            	}

				//dados do contato
				if($validation->getError('add_colab_contato_pricipal'))
            	{
            		$add_colab_contato_pricipal_error = $validation->getError('add_colab_contato_pricipal');
            	}
				if($validation->getError('add_colab_contato_alternativo'))
            	{
            		$add_colab_contato_alternativo_error = $validation->getError('add_colab_contato_alternativo');
            	}
				if($validation->getError('add_colab_contato_familiar'))
            	{
            		$add_colab_contato_familiar_error = $validation->getError('add_colab_contato_familiar');
            	}
				if($validation->getError('add_colab_email_pessoal'))
            	{
            		$add_colab_email_pessoal_error = $validation->getError('add_colab_email_pessoal');
            	}

				//endereço
				if($validation->getError('add_colab_cep_moradia'))
            	{
            		$add_colab_cep_moradia_error = $validation->getError('add_colab_cep_moradia');
            	}
				if($validation->getError('add_colab_uf_moradia'))
            	{
            		$add_colab_uf_moradia_error = $validation->getError('add_colab_uf_moradia');
            	}
				if($validation->getError('add_colab_cidade_moradia'))
            	{
            		$add_colab_cidade_moradia_error = $validation->getError('add_colab_cidade_moradia');
            	}
				if($validation->getError('add_colab_bairro_moraddia'))
            	{
            		$add_colab_bairro_moraddia_error = $validation->getError('add_colab_bairro_moraddia');
            	}
				if($validation->getError('add_colab_rua_moradia'))
            	{
            		$add_colab_rua_moradia_error = $validation->getError('add_colab_rua_moradia');
            	}
				if($validation->getError('add_colab_numero_moradia'))
            	{
            		$add_colab_numero_moradia_error = $validation->getError('add_colab_numero_moradia');
            	}
				if($validation->getError('add_colab_complemento_morada'))
            	{
            		$add_colab_complemento_morada_error = $validation->getError('add_colab_complemento_morada');
            	}

				//documentos 13
				if($validation->getError('add_colab_doc_numero_rg'))
            	{
            		$add_colab_doc_numero_rg_error = $validation->getError('add_colab_doc_numero_rg');
            	}
				if($validation->getError('add_colab_doc_orgao_emissor_rg'))
            	{
            		$add_colab_doc_orgao_emissor_rg_error = $validation->getError('add_colab_doc_orgao_emissor_rg');
            	}
				if($validation->getError('add_colab_doc_data_rg_emissao'))
            	{
            		$add_colab_doc_data_rg_emissao_error = $validation->getError('add_colab_doc_data_rg_emissao');
            	}
				if($validation->getError('add_colab_doc_uf_rg'))
            	{
            		$add_colab_doc_uf_rg_error = $validation->getError('add_colab_doc_uf_rg');
            	}
				if($validation->getError('add_colab_titulo_numero'))
            	{
            		$add_colab_titulo_numero_error = $validation->getError('add_colab_titulo_numero');
            	}
				if($validation->getError('add_colab_titulo_zona'))
            	{
            		$add_colab_titulo_zona_error = $validation->getError('add_colab_titulo_zona');
            	}
				if($validation->getError('add_colab_titulo_sessao'))
            	{
            		$add_colab_titulo_sessao_error = $validation->getError('add_colab_titulo_sessao');
            	}
				if($validation->getError('add_colab_titulo_data_emissao'))
            	{
            		$add_colab_titulo_data_emissao_error = $validation->getError('add_colab_titulo_data_emissao');
            	}
				if($validation->getError('add_colab_titulo_uf_emissao'))
            	{
            		$add_colab_titulo_uf_emissao_error = $validation->getError('add_colab_titulo_uf_emissao');
            	}
				if($validation->getError('add_colab_cpf_numero'))
            	{
            		$add_colab_cpf_numero_error = $validation->getError('add_colab_cpf_numero');
            	}
				if($validation->getError('add_colab_numero_pis'))
            	{
            		$add_colab_numero_pis_error = $validation->getError('add_colab_numero_pis');
            	}
				if($validation->getError('add_colab_reservista_numero'))
            	{
            		$add_colab_reservista_numero_error = $validation->getError('add_colab_reservista_numero');
            	}
				if($validation->getError('add_colab_sus_numero'))
            	{
            		$add_colab_sus_numero_error = $validation->getError('add_colab_sus_numero');
            	}

				//CTPS--FGTS
				if($validation->getError('add_colab_ctps_numero'))
            	{
            		$add_colab_ctps_numero_error = $validation->getError('add_colab_ctps_numero');
            	}
				if($validation->getError('add_colab_ctps_serie'))
            	{
            		$add_colab_ctps_serie_error = $validation->getError('add_colab_ctps_serie');
            	}
				if($validation->getError('add_colab_data_emissao'))
            	{
            		$add_colab_data_emissao_error = $validation->getError('add_colab_data_emissao');
            	}
				if($validation->getError('add_colab_uf_emissor'))
            	{
            		$add_colab_uf_emissor_error = $validation->getError('add_colab_uf_emissor');
            	}
				if($validation->getError('add_colab_fgts_categoria'))
            	{
            		$add_colab_fgts_categoria_error = $validation->getError('add_colab_fgts_categoria');
            	}
				if($validation->getError('add_colab_fgts_codigo'))
            	{
            		$add_colab_fgts_codigo_error = $validation->getError('add_colab_fgts_codigo');
            	}

				//UNIFORME -- TIPO SANGUE
				if($validation->getError('add_colab_uniforme_tamanho'))
            	{
            		$add_colab_uniforme_tamanho_error = $validation->getError('add_colab_uniforme_tamanho');
            	}
				if($validation->getError('add_colab_uniforme_calca'))
            	{
            		$add_colab_uniforme_calca_error = $validation->getError('add_colab_uniforme_calca');
            	}
				if($validation->getError('add_colab_tipo_sangue'))
            	{
            		$add_colab_tipo_sangue_error = $validation->getError('add_colab_tipo_sangue');
            	}

				//FUNCIONAIS
				if($validation->getError('add_colab_funcao_cargo'))
            	{
            		$add_colab_funcao_cargo_error = $validation->getError('add_colab_funcao_cargo');
            	}
				if($validation->getError('add_colab_funcao_situacao'))
            	{
            		$add_colab_funcao_situacao_error = $validation->getError('add_colab_funcao_situacao');
            	}
				if($validation->getError('add_colab_funcao_admissao_data'))
            	{
            		$add_colab_funcao_admissao_data_error = $validation->getError('add_colab_funcao_admissao_data');
            	}

				if($validation->getError('add_colab_funcao_desligamento_data'))
            	{
            		$add_colab_funcao_desligamento_data_data_error = $validation->getError('add_colab_funcao_desligamento_data');
            	}
				if($validation->getError('add_colab_funcao_hora_extra_fixa'))
            	{
            		$add_colab_funcao_hora_extra_fixa_error = $validation->getError('add_colab_funcao_hora_extra_fixa');
            	}
				if($validation->getError('add_colab_funcao_salario'))
            	{
            		$add_colab_funcao_salario_error = $validation->getError('add_colab_funcao_salario');
            	}

				if($validation->getError('add_colab_funcao_tipo_pagamento'))
            	{
            		$add_colab_funcao_tipo_pagamento_error = $validation->getError('add_colab_funcao_tipo_pagamento');
            	}
				if($validation->getError('add_colab_funcao_tipo_salario'))
            	{
            		$add_colab_funcao_tipo_salario_error = $validation->getError('add_colab_funcao_tipo_salario');
            	}
				if($validation->getError('add_colab_funcao_departamento'))
            	{
            		$add_colab_funcao_departamento_error = $validation->getError('add_colab_funcao_departamento');
            	}

				if($validation->getError('add_colab_cento_de_custo'))
            	{
            		$add_colab_cento_de_custo_error = $validation->getError('add_colab_cento_de_custo');
            	}
				if($validation->getError('add_colab_funcao_hora_extras'))
            	{
            		$add_colab_funcao_hora_extras_error = $validation->getError('add_colab_funcao_hora_extras');
            	}
				// if($validation->getError('add_colab_funcao_encarregado'))
            	// {
            	// 	$add_colab_funcao_encarregado_error = $validation->getError('add_colab_funcao_encarregado');
            	// }

				if($validation->getError('add_colab_funcao_periculosidade'))
            	{
            		$add_colab_funcao_periculosidade_error = $validation->getError('add_colab_funcao_periculosidade');
            	}
				if($validation->getError('add_colab_funcao_insalubridade'))
            	{
            		$add_colab_funcao_insalubridade_error = $validation->getError('add_colab_funcao_insalubridade');
            	}
				if($validation->getError('add_colab_funcao_desconto_sindical'))
            	{
            		$add_colab_funcao_desconto_sindical_error = $validation->getError('add_colab_funcao_desconto_sindical');
            	}

				if($validation->getError('add_colab_funcao_ps'))
            	{
            		$add_colab_funcao_ps_error = $validation->getError('add_colab_funcao_ps');
            	}

				//Aeroporto
				if($validation->getError('add_colab_cep_aeroporto'))
            	{
            		$add_colab_cep_aeroporto_error = $validation->getError('add_colab_cep_aeroporto');
            	}
				if($validation->getError('add_colab_uf_eroporto'))
            	{
            		$add_colab_uf_eroporto_error = $validation->getError('add_colab_uf_eroporto');
            	}

				if($validation->getError('add_colab_cidade_aeroporto'))
            	{
            		$add_colab_cidade_aeroporto_error = $validation->getError('add_colab_cidade_aeroporto');
            	}

				//Outros
				if($validation->getError('add_colab_outros_local_trabalho'))
            	{
            		$add_colab_outros_local_trabalho_error = $validation->getError('add_colab_outros_local_trabalho');
            	}
				if($validation->getError('add_colab_outros_tipo_moradia'))
            	{
            		$add_colab_outros_tipo_moradia_error = $validation->getError('add_colab_outros_tipo_moradia');
            	}

				if($validation->getError('add_colab_outros_observacao'))
            	{
            		$add_colab_outros_observacao_error = $validation->getError('add_colab_outros_observacao');
            	}

            }
            else
            {
            	$success = 'yes';
            	$model = new FuncionarioModel();
            		$model->save([
            			'f_nome'				=>	$this->request->getVar('x_add_colab_nome'),
            			'f_conjugue'			=>	$this->request->getVar('x_add_colab_conjuge'),
            			'f_codigo'				=>	$this->request->getVar('x_add_colab_codigo'),
            			'f_matricula'			=>	$this->request->getVar('x_add_colab_matricula'),
            			'f_sexo'				=>	$this->request->getVar('add_colab_sexo'),
            			'f_estado_civil'		=>	$this->request->getVar('add_colab_estado_civil'),
            			'f_grau_instrucao'		=>	$this->request->getVar('add_colab_escolaridade'),
            			'f_nacionalidade'		=>	$this->request->getVar('add_colab_nacionalidade'),
            			'f_nacionalidade_uf'	=>	$this->request->getVar('add_colab_uf_naturalidade'),
            			'f_naturalidade_cidade'	=>	$this->request->getVar('add_colab_naturalidade'),
            			'f_data_nascimento'		=>	$this->request->getVar('add_colab_data_nacimento'),
            			'f_mae'					=>	$this->request->getVar('add_colab_nome_mae'),
            			'f_pai'					=>	$this->request->getVar('add_colab_do_pai'),


            			'f_telefone_pessoal'	=>	$this->request->getVar('add_colab_contato_pricipal'),
            			'f_contato_alternativo'	=>	$this->request->getVar('add_colab_contato_alternativo'),
            			'f_telefone_contato'	=>	$this->request->getVar('add_colab_contato_familiar'),
            			'f_email_pessoal'		=>	$this->request->getVar('add_colab_email_pessoal'),


            			'f_cep'					=>	$this->request->getVar('add_colab_cep_moradia'),
            			'f_estado'				=>	$this->request->getVar('add_colab_uf_moradia'),
            			'f_cidade'				=>	$this->request->getVar('add_colab_cidade_moradia'),
            			'f_bairro'				=>	$this->request->getVar('add_colab_bairro_moraddia'),
            			'f_numero_casa'			=>	$this->request->getVar('add_colab_numero_moradia'),
            			'f_endereco'			=>	$this->request->getVar('add_colab_rua_moradia'),
            			'f_endereco_complemento'=>	$this->request->getVar('add_colab_complemento_morada'),


            			'f_rg_numero'			=>	$this->request->getVar('add_colab_doc_numero_rg'),
            			'f_rg_uf'				=>	$this->request->getVar('add_colab_doc_uf_rg'),
            			'f_rg_data_emissao'		=>	$this->request->getVar('add_colab_doc_data_rg_emissao'),
            			'f_rg_emissor'			=>	$this->request->getVar('add_colab_doc_orgao_emissor_rg'),

            			'f_titulo_eleitor_numero'=>	$this->request->getVar('add_colab_titulo_numero'),
            			'f_titulo_eleitor_nona'	=>	$this->request->getVar('add_colab_titulo_zona'),
            			'f_titulo_eleitor_sessao'=>	$this->request->getVar('add_colab_titulo_sessao'),
            			'f_titulo_eleitor_uf'	=>	$this->request->getVar('add_colab_titulo_uf_emissao'),
            			'f_titulo_eleitor_data_emissao'	=>	$this->request->getVar('add_colab_titulo_data_emissao'),

            			'f_cpf'					=>	$this->request->getVar('add_colab_cpf_numero'),
            			'f_pis'					=>	$this->request->getVar('add_colab_numero_pis'),
            			'f_numero_reservista'	=>	$this->request->getVar('add_colab_reservista_numero'),
            			'f_numero_cartao_sus'	=>	$this->request->getVar('add_colab_sus_numero'),

            			'f_ctps_numero'			=>	$this->request->getVar('add_colab_ctps_numero'),
            			'f_ctps_numero_serie'	=>	$this->request->getVar('add_colab_ctps_serie'),
            			'f_ctps_data_emissao'	=>	$this->request->getVar('add_colab_data_emissao'),
            			'f_ctps_uf'				=>	$this->request->getVar('add_colab_uf_emissor'),
            			'f_fgts_categoria'		=>	$this->request->getVar('add_colab_fgts_categoria'),
            			'f_fgts_codigo'			=>	$this->request->getVar('add_colab_fgts_codigo'),

						
            			'f_uniforme_camisa'		=>	$this->request->getVar('add_colab_uniforme_tamanho'),
            			'f_uniforme_calca'		=>	$this->request->getVar('add_colab_uniforme_calca'),
            			'f_tipo_sangue'			=>	$this->request->getVar('add_colab_tipo_sangue'),


            			'f_cargo'				=>	$this->request->getVar('add_colab_funcao_cargo'),
            			'f_fk_obra'				=>	$this->request->getVar('obra_quem_cadastra'),
            			'f_Fk_frente'			=>	$this->request->getVar('frente_quem_cadastra'),
            			'f_fk_cento_custo'		=>	$this->request->getVar('add_colab_cento_de_custo'),
            			'f_horas_trabalho'		=>	$this->request->getVar('add_colab_funcao_hora_extras'),
            			'f_fk_id_departamento'	=>	$this->request->getVar('add_colab_funcao_departamento'),

            			//'f_fk_encarregado'		=>	$this->request->getVar('add_colab_funcao_encarregado'),
            			'f_situacao'			=>	$this->request->getVar('add_colab_funcao_situacao'),
            			'f_admissao'			=>	$this->request->getVar('add_colab_funcao_admissao_data'),
            			'f_desligamento'		=>	$this->request->getVar('add_colab_funcao_desligamento_data'),
            			'f_salario'				=>	$this->request->getVar('add_colab_funcao_salario'),
            			'f_tipo_pagamento'		=>	$this->request->getVar('add_colab_funcao_tipo_pagamento'),
            			'f_tipo_salario'		=>	$this->request->getVar('add_colab_funcao_tipo_salario'),
            			'f_insalubridade'		=>	$this->request->getVar('add_colab_funcao_insalubridade'),
            			'f_periculosidade'		=>	$this->request->getVar('add_colab_funcao_periculosidade'),
            			'f_desconto_sindical'	=>	$this->request->getVar('add_colab_funcao_desconto_sindical'),
            			'f_ps'					=>	$this->request->getVar('add_colab_funcao_ps'),

            			// 'f_cnh_numero'			=>	$this->request->getVar('gender'),
            			// 'f_cnh_categoria'		=>	$this->request->getVar('gender'),
            			// 'f_cnh_emissor'			=>	$this->request->getVar('gender'),
            			// 'f_cnh_uf'				=>	$this->request->getVar('gender'),
            			// 'f_cnh_data_emissao'	=>	$this->request->getVar('gender'),
            			// 'f_cnh_data_vencimento'	=>	$this->request->getVar('gender'),
            			// 'f_cnh_data_primeira'	=>	$this->request->getVar('gender'),


            			'f_fk_local_trabalho'	=>	$this->request->getVar('add_colab_outros_local_trabalho'),
            			'f_tipo_moradia'		=>	$this->request->getVar('add_colab_outros_tipo_moradia'),
            			'f_description'			=>	$this->request->getVar('add_colab_outros_observacao'),

            			'f_aeroporto_cep'		=>	$this->request->getVar('add_colab_cep_aeroporto'),
            			'f_aeroporto_uf'		=>	$this->request->getVar('add_colab_uf_eroporto'),
            			'f_aeroporto_cidade'	=>	$this->request->getVar('add_colab_cidade_aeroporto'),
            		]);

            		$message = '<div class="alert alert-success">Colaborador adicionado com sucesso!</div>';

            }

            $output = array(
            	'x_add_colab_nome_error'			=>	$x_add_colab_nome_error,
            	'x_add_colab_conjuge_nome_error'	=>	$x_add_colab_conjuge_nome_error,
            	'x_add_colab_codigo_error'			=>	$x_add_colab_codigo_error,
				'x_add_colab_matricula_error'		=>	$x_add_colab_matricula_error,
            	'add_colab_sexo_error'				=>	$add_colab_sexo_error,
            	'add_colab_estado_civil_error'		=>	$add_colab_estado_civil_error,
				'add_colab_escolaridade_error'		=>	$add_colab_escolaridade_error,
            	'add_colab_nacionalidade_error'		=>	$add_colab_nacionalidade_error,
            	'add_colab_naturalidade_error'		=>	$add_colab_naturalidade_error,

				'add_colab_uf_naturalidade_error'	=>	$add_colab_uf_naturalidade_error,
            	'add_colab_data_nacimento_error'	=>	$add_colab_data_nacimento_error,
            	'add_colab_nome_mae_error'			=>	$add_colab_nome_mae_error,
				'add_colab_do_pai_error'			=>	$add_colab_do_pai_error,

				//dados do contato
				'add_colab_contato_pricipal_error'		=>	$add_colab_contato_pricipal_error,
            	'add_colab_contato_alternativo_error'	=>	$add_colab_contato_alternativo_error,
            	'add_colab_contato_familiar_error'		=>	$add_colab_contato_familiar_error,
				'add_colab_email_pessoal_error'			=>	$add_colab_email_pessoal_error,

				//endereço
				'add_colab_cep_moradia_error'		=>	$add_colab_cep_moradia_error,
            	'add_colab_uf_moradia_error'		=>	$add_colab_uf_moradia_error,
            	'add_colab_cidade_moradia_error'	=>	$add_colab_cidade_moradia_error,
				'add_colab_bairro_moraddia_error'	=>	$add_colab_bairro_moraddia_error,
				'add_colab_rua_moradia_error'		=>	$add_colab_rua_moradia_error,
            	'add_colab_numero_moradia_error'	=>	$add_colab_numero_moradia_error,
            	'add_colab_complemento_morada_error'=>	$add_colab_complemento_morada_error,

				//documentos
				'add_colab_doc_numero_rg_error'			=>	$add_colab_doc_numero_rg_error,
            	'add_colab_doc_orgao_emissor_rg_error'	=>	$add_colab_doc_orgao_emissor_rg_error,
            	'add_colab_doc_data_rg_emissao_error'	=>	$add_colab_doc_data_rg_emissao_error,
				'add_colab_doc_uf_rg_error'				=>	$add_colab_doc_uf_rg_error,
				'add_colab_titulo_numero_error'			=>	$add_colab_titulo_numero_error,
            	'add_colab_titulo_zona_error'			=>	$add_colab_titulo_zona_error,
            	'add_colab_titulo_sessao_error'			=>	$add_colab_titulo_sessao_error,
				'add_colab_titulo_data_emissao_error'	=>	$add_colab_titulo_data_emissao_error,
            	'add_colab_titulo_uf_emissao_error'		=>	$add_colab_titulo_uf_emissao_error,
            	'add_colab_cpf_numero_error'			=>	$add_colab_cpf_numero_error,
				'add_colab_numero_pis_error'			=>	$add_colab_numero_pis_error,
				'add_colab_reservista_numero_error'		=>	$add_colab_reservista_numero_error,
            	'add_colab_sus_numero_error'			=>	$add_colab_sus_numero_error,

				//CTPS--FGTS
				'add_colab_ctps_numero_error'	=>	$add_colab_ctps_numero_error,
            	'add_colab_ctps_serie_error'		=>	$add_colab_ctps_serie_error,
            	'add_colab_data_emissao_error'			=>	$add_colab_data_emissao_error,
				'add_colab_uf_emissor_error'			=>	$add_colab_uf_emissor_error,
				'add_colab_fgts_categoria_error'		=>	$add_colab_fgts_categoria_error,
            	'add_colab_fgts_codigo_error'			=>	$add_colab_fgts_codigo_error,

				//UNIFORME -- TIPO SANGUE
				'add_colab_uniforme_tamanho_error'		=>	$add_colab_uniforme_tamanho_error,
				'add_colab_uniforme_calca_error'		=>	$add_colab_uniforme_calca_error,
            	'add_colab_tipo_sangue_error'			=>	$add_colab_tipo_sangue_error,

				//FUNCIONAIS
				'add_colab_funcao_cargo_error'		=>	$add_colab_funcao_cargo_error,
				'add_colab_funcao_situacao_error'		=>	$add_colab_funcao_situacao_error,
            	'add_colab_funcao_admissao_data_error'			=>	$add_colab_funcao_admissao_data_error,

				'add_colab_funcao_desligamento_data_data_error'	=>	$add_colab_funcao_desligamento_data_data_error,
				'add_colab_funcao_hora_extra_fixa_error'		=>	$add_colab_funcao_hora_extra_fixa_error,
            	'add_colab_funcao_salario_error'			=>	$add_colab_funcao_salario_error,

				'add_colab_funcao_tipo_pagamento_error'		=>	$add_colab_funcao_tipo_pagamento_error,
				'add_colab_funcao_tipo_salario_error'		=>	$add_colab_funcao_tipo_salario_error,
            	'add_colab_funcao_departamento_error'		=>	$add_colab_funcao_departamento_error,

				'add_colab_cento_de_custo_error'		=>	$add_colab_cento_de_custo_error,
				'add_colab_funcao_hora_extras_error'		=>	$add_colab_funcao_hora_extras_error,
            	//'add_colab_funcao_encarregado_error'			=>	$add_colab_funcao_encarregado_error,

				'add_colab_funcao_periculosidade_error'		=>	$add_colab_funcao_periculosidade_error,
				'add_colab_funcao_insalubridade_error'		=>	$add_colab_funcao_insalubridade_error,
            	'add_colab_funcao_desconto_sindical_error'			=>	$add_colab_funcao_desconto_sindical_error,
				'add_colab_funcao_ps_error'		=>	$add_colab_funcao_ps_error,

				//Aeroporto
				'add_colab_cep_aeroporto_error'		=>	$add_colab_cep_aeroporto_error,
				'add_colab_uf_eroporto_error'		=>	$add_colab_uf_eroporto_error,
				'add_colab_cidade_aeroporto_error'	=>	$add_colab_cidade_aeroporto_error,

				//Outros
				'add_colab_outros_local_trabalho_error'		=>	$add_colab_outros_local_trabalho_error,
				'add_colab_outros_tipo_moradia_error'		=>	$add_colab_outros_tipo_moradia_error,
				'add_colab_outros_observacao_error'	=>	$add_colab_outros_observacao_error,


            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );

            echo json_encode($output);
		}
	}

	/**lista todos os colaboradores */
	public function listFuncionarios()
	{
		$model = new FuncionarioModel();
		$data_table = new TablesIgniter();
		$data_table->setTable($model->noticeTable())
				   ->setDefaultOrder("f_id", "DESC")
				   ->setSearch(["f_nome","f_telefone_pessoal","f_email_pessoal", "f_codigo"])
				   ->setOrder(["f_admissao", "f_nome","f_telefone_pessoal","f_email_pessoal", "f_codigo", "f_matricula"])
				   ->setOutput(["f_admissao", "f_nome","f_telefone_pessoal","f_email_pessoal", "f_codigo", "f_matricula", $model->button()]);
		return $data_table->getDatatable();
	
	}

	/**dados do colaborador */
	public function visualizaDadosCadastrado($id)
	{
		$id_frente = session()->get('log_frente');
		$page = 'informacoes-cadastrais-do-colaborador';
		$estados 		= new EstadosModel();
		$funcao 		= new CargosModel();
		$departamento  	= new DepartamentosModel();
		$cento_custo    = new CentocustoModel();
		$frentes        = new FrentesModel();
		$model 			= new FuncionarioModel();

		$data['info'] = $model->where('f_id', $id);
		if (empty($data['info'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Funcionario não encontrado na base de dados: ' . $id);
		}

		$data = [
			'estados' 			=> $estados->getEstados(),
			'funcao'  			=> $funcao->findAll(),
			'departamento'  	=> $departamento->findAll(),
			'list_c_custo'  	=> $cento_custo->getFrenteCC($id_frente),
			'list_frente'   	=> $frentes->findAll(),
			'dd_funcionarios'   => $model->getFuncionarios($id),
		]; 
		echo view('frentesObras/frenteRh/layout/pages/colaborador/' . $page, $data);
	}

	/**altera dados de cadastro do funcionario */
	public function alteraCadastroFuncionario()
	{
		if($this->request->getMethod() === 'post')
		{

			$x_add_colab_nome_error_up = '';
            $x_add_colab_conjuge_nome_error_up = '';
            $x_add_colab_codigo_error_up = '';

			$x_add_colab_matricula_error_up = '';
            $add_colab_sexo_error_up = '';
            $add_colab_estado_civil_error_up = '';

			$add_colab_escolaridade_error_up = '';
            $add_colab_nacionalidade_error_up = '';
            $add_colab_naturalidade_error_up = '';

			$add_colab_uf_naturalidade_error_up = '';
            $add_colab_data_nacimento_error_up = '';
            $add_colab_nome_mae_error_up = '';
            $add_colab_do_pai_error_up = '';

			//dados do contato
			$add_colab_contato_pricipal_error_up = '';
            $add_colab_contato_alternativo_error_up = '';
            $add_colab_contato_familiar_error_up = '';
            $add_colab_email_pessoal_error_up = '';

			//endereço
			$add_colab_cep_moradia_error_up = '';
            $add_colab_uf_moradia_error_up = '';
            $add_colab_cidade_moradia_error_up = '';
            $add_colab_bairro_moraddia_error_up = '';
			$add_colab_rua_moradia_error_up = '';
            $add_colab_numero_moradia_error_up = '';
            $add_colab_complemento_morada_error_up = '';

			//documentos
			$add_colab_doc_numero_rg_error_up = '';
            $add_colab_doc_orgao_emissor_rg_error_up = '';
            $add_colab_doc_data_rg_emissao_error_up = '';
            $add_colab_doc_uf_rg_error_up = '';
			$add_colab_titulo_numero_error_up = '';
            $add_colab_titulo_zona_error_up = '';
            $add_colab_titulo_sessao_error_up = '';
			$add_colab_titulo_data_emissao_error_up = '';
            $add_colab_titulo_uf_emissao_error_up = '';
            $add_colab_cpf_numero_error_up = '';
            $add_colab_numero_pis_error_up = '';
			$add_colab_reservista_numero_error_up = '';
            $add_colab_sus_numero_error_up = '';

			//CTPS--FGTS
			$add_colab_ctps_numero_error_up = '';
            $add_colab_ctps_serie_error_up = '';
            $add_colab_data_emissao_error_up = '';
            $add_colab_uf_emissor_error_up = '';
			$add_colab_fgts_categoria_error_up = '';
            $add_colab_fgts_codigo_error_up = '';

			//UNIFORME -- TIPO SANGUE
			$add_colab_uniforme_tamanho_error_up = '';
			$add_colab_uniforme_calca_error_up = '';
            $add_colab_tipo_sangue_error_up = '';

			//FUNCIONAIS
			$add_colab_funcao_cargo_error_up = '';
			$add_colab_funcao_situacao_error_up = '';
            $add_colab_funcao_admissao_data_error_up = '';

			$add_colab_funcao_desligamento_data_data_error_up = '';
			$add_colab_funcao_hora_extra_fixa_error_up = '';
            $add_colab_funcao_salario_error_up = '';
			
			$add_colab_funcao_tipo_pagamento_error_up = '';
			$add_colab_funcao_tipo_salario_error_up = '';
            $add_colab_funcao_departamento_error_up = '';

			$add_colab_cento_de_custo_error_up = '';
			$add_colab_funcao_hora_extras_error_up = '';
            //$add_colab_funcao_encarregado_error_up = '';

			$add_colab_funcao_periculosidade_error_up = '';
			$add_colab_funcao_insalubridade_error_up = '';
            $add_colab_funcao_desconto_sindical_error_up = '';
			$add_colab_funcao_ps_error_up = '';

			//Aeroporto
			$add_colab_cep_aeroporto_error_up = '';
			$add_colab_uf_eroporto_error_up = '';
			$add_colab_cidade_aeroporto_error_up = '';

			//outros
			$add_colab_outros_local_trabalho_error_up = '';
			$add_colab_outros_tipo_moradia_error_up = '';
			$add_colab_outros_observacao_error_up = '';

            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([

				'x_add_colab_nome' => ['label' => 'funcionário', 'rules' => 'required|max_length[100]'],
				'x_add_colab_conjuge' => ['label' => 'conjugue', 'rules' => 'required|max_length[100]'],
				'x_add_colab_codigo' => ['label' => 'código', 'rules' => 'required|integer|max_length[20]'],
				'x_add_colab_matricula' => ['label' => 'matrícula', 'rules' => 'required|integer|max_length[20]'],
				'add_colab_sexo' => ['label' => 'sexo', 'rules' => 'required'],
				'add_colab_estado_civil' => ['label' => 'estado civil', 'rules' => 'required'],
				'add_colab_escolaridade' => ['label' => 'escolaridade', 'rules' => 'required'],
				'add_colab_nacionalidade' => ['label' => 'nacionalidade', 'rules' => 'required'],
				'add_colab_naturalidade' => ['label' => 'naturalidade', 'rules' => 'required'],
				'add_colab_uf_naturalidade' => ['label' => 'uf naturalidade', 'rules' => 'required'],
				'add_colab_data_nacimento' => ['label' => 'data de nascimento', 'rules' => 'required'],
				'add_colab_nome_mae' => ['label' => 'nome da mãe', 'rules' => 'required|min_length[5]|max_length[100]'],
				'add_colab_do_pai' => ['label' => 'nome do pai', 'rules' => 'required|min_length[5]|max_length[100]'],

				//contat
				'add_colab_contato_pricipal' => ['label' => 'telefone principal', 'rules' => 'required|min_length[15]'],
				'add_colab_contato_alternativo' => ['label' => 'telefone alternativo', 'rules' => 'required|min_length[15]'],
				'add_colab_contato_familiar' => ['label' => 'contato familiar', 'rules' => 'required|min_length[15]'],
				'add_colab_email_pessoal' => ['label' => 'email pessoal', 'rules' => 'valid_email|min_length[5]|max_length[100]'],

				//endereço
				'add_colab_cep_moradia' => ['label' => 'cep', 'rules' => 'required|exact_length[10]'],
				'add_colab_uf_moradia' => ['label' => 'uf', 'rules' => 'required'],
				'add_colab_cidade_moradia' => ['label' => 'cidade', 'rules' => 'required'],
				'add_colab_bairro_moraddia' => ['label' => 'bairro', 'rules' => 'required|min_length[5]'],
				'add_colab_rua_moradia' => ['label' => 'rua', 'rules' => 'required|min_length[10]'],
				'add_colab_numero_moradia' => ['label' => 'número', 'rules' => 'required|integer'],
				'add_colab_complemento_morada' => ['label' => 'complemento', 'rules' => 'required|min_length[10]'],

				//documentos 13
				'add_colab_doc_numero_rg' => ['label' => 'RG', 'rules' => 'required|min_length[5]|max_length[30]'],
				'add_colab_doc_orgao_emissor_rg' => ['label' => 'uf', 'rules' => 'required'],
				'add_colab_doc_data_rg_emissao' => ['label' => 'data', 'rules' => 'required|valid_date'],
				'add_colab_doc_uf_rg' => ['label' => 'uf o rg', 'rules' => 'required'],
				'add_colab_titulo_numero' => ['label' => 'número do título', 'rules' => 'required|min_length[5]|max_length[30]'],
				'add_colab_titulo_zona' => ['label' => 'zona', 'rules' => 'required|max_length[30]'],
				'add_colab_titulo_sessao' => ['label' => 'sessão', 'rules' => 'required|max_length[30]'],
				'add_colab_titulo_data_emissao' => ['label' => 'data do título', 'rules' => 'required|valid_date'],
				'add_colab_titulo_uf_emissao' => ['label' => 'uf do título', 'rules' => 'required'],
				'add_colab_cpf_numero' => ['label' => 'CPF', 'rules' => 'required|exact_length[14]'],
				'add_colab_numero_pis' => ['label' => 'número do PIS', 'rules' => 'required|min_length[10]|max_length[30]'],
				'add_colab_reservista_numero' => ['label' => 'número da reservista', 'rules' => 'required|min_length[5]|max_length[30]'],
				'add_colab_sus_numero' => ['label' => 'número do cartão SUS', 'rules' => 'required|max_length[30]'],

				//CTPS--FGTS
				'add_colab_ctps_numero' 	=> ['label' => 'CTPS', 'rules' => 'required|min_length[10]|max_length[50]'],
				'add_colab_ctps_serie' 		=> ['label' => 'SÉRIE', 'rules' => 'required|min_length[10]|max_length[50]'],
				'add_colab_data_emissao' 	=> ['label' => 'EMISSOR', 'rules' => 'required|min_length[10]'],
				'add_colab_uf_emissor' 		=> ['label' => 'UF', 'rules' => 'required'],
				'add_colab_fgts_categoria' 	=> ['label' => 'número do FGTS', 'rules' => 'required'],
				'add_colab_fgts_codigo' 	=> ['label' => 'código do FGTS', 'rules' => 'required|min_length[5]|max_length[50]'],

				//UNIFORME -- TIPO SANGUE
				'add_colab_uniforme_tamanho'=> ['label' => 'CAMISA', 'rules' => 'required'],
				'add_colab_uniforme_calca' 	=> ['label' => 'CALÇA', 'rules' => 'required'],
				'add_colab_tipo_sangue' 	=> ['label' => 'SANGUE', 'rules' => 'required'],

				//FUNCIONAIS
				'add_colab_funcao_cargo' 	=> ['label' => 'FUNÇÃO', 'rules' => 'required'],
				'add_colab_funcao_situacao' 	=> ['label' => 'SITUAÇÃO', 'rules' => 'required'],
				'add_colab_funcao_admissao_data' 	=> ['label' => 'ADIMISSÃO', 'rules' => 'required|valid_date'],
				'add_colab_funcao_desligamento_data' 	=> ['label' => 'DESLIGAMENTO', 'rules' => 'required|valid_date'],

				'add_colab_funcao_hora_extra_fixa' 	=> ['label' => 'H.: EXTRAS FIXA', 'rules' => 'required'],
				'add_colab_funcao_salario' 	=> ['label' => 'SALÁRIO', 'rules' => 'required'],
				'add_colab_funcao_tipo_pagamento' 	=> ['label' => 'TIPO DE PAGAMENTO', 'rules' => 'required'],
				'add_colab_funcao_tipo_salario' 	=> ['label' => 'TIPO DE SALÁRIO', 'rules' => 'required'],
				
				'add_colab_funcao_departamento' 	=> ['label' => 'DEPARTAMENTO', 'rules' => 'required'],
				'add_colab_cento_de_custo' 	=> ['label' => 'CENTO DE CUSTO', 'rules' => 'required'],
				'add_colab_funcao_hora_extras' 	=> ['label' => 'H.: EXTRAS', 'rules' => 'required'],
				//'add_colab_funcao_encarregado' 	=> ['label' => 'ENCARREGADO', 'rules' => 'required'],

				'add_colab_funcao_periculosidade' 	=> ['label' => 'PERICULOSIDADE', 'rules' => 'required'],
				'add_colab_funcao_insalubridade' 	=> ['label' => 'INSALUBRIDADE', 'rules' => 'required'],
				'add_colab_funcao_desconto_sindical' 	=> ['label' => 'DESCONTO SINDICAL', 'rules' => 'required'],
				'add_colab_funcao_ps' 	=> ['label' => 'PS', 'rules' => 'required'],

				//Aeroporto
				'add_colab_cep_aeroporto' 	=> ['label' => 'CEP', 'rules' => 'required|exact_length[10]'],
				'add_colab_uf_eroporto' 	=> ['label' => 'UF', 'rules' => 'required|exact_length[2]'],
				'add_colab_cidade_aeroporto' 	=> ['label' => 'CIDADE', 'rules' => 'required'],

				//Outros
				'add_colab_outros_local_trabalho' 	=> ['label' => 'LOCAL', 'rules' => 'required'],
				'add_colab_outros_tipo_moradia' 	=> ['label' => 'MORADIA', 'rules' => 'required'],
				'add_colab_outros_observacao' 	=> ['label' => 'OBSERVAÇÃO', 'rules' => 'required'],

				//foreing key
				

            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('x_add_colab_nome'))
            	{
            		$x_add_colab_nome_error_up = $validation->getError('x_add_colab_nome');
            	}

            	if($validation->getError('x_add_colab_conjuge'))
            	{
            		$x_add_colab_conjuge_nome_error_up = $validation->getError('x_add_colab_conjuge');
            	}

            	if($validation->getError('x_add_colab_codigo'))
            	{
            		$x_add_colab_codigo_error_up = $validation->getError('x_add_colab_codigo');
            	}
				if($validation->getError('x_add_colab_matricula'))
            	{
            		$x_add_colab_matricula_error_up = $validation->getError('x_add_colab_matricula');
            	}
				if($validation->getError('add_colab_sexo'))
            	{
            		$add_colab_sexo_error_up = $validation->getError('add_colab_sexo');
            	}
				if($validation->getError('add_colab_estado_civil'))
            	{
            		$add_colab_estado_civil_error_up = $validation->getError('add_colab_estado_civil');
            	}
				if($validation->getError('add_colab_escolaridade'))
            	{
            		$add_colab_escolaridade_error_up = $validation->getError('add_colab_escolaridade');
            	}
				if($validation->getError('add_colab_nacionalidade'))
            	{
            		$add_colab_nacionalidade_error_up = $validation->getError('add_colab_nacionalidade');
            	}
				if($validation->getError('add_colab_naturalidade'))
            	{
            		$add_colab_naturalidade_error_up = $validation->getError('add_colab_naturalidade');
            	}

				if($validation->getError('add_colab_uf_naturalidade'))
            	{
            		$add_colab_uf_naturalidade_error_up = $validation->getError('add_colab_uf_naturalidade');
            	}
				if($validation->getError('add_colab_data_nacimento'))
            	{
            		$add_colab_data_nacimento_error_up = $validation->getError('add_colab_data_nacimento');
            	}
				if($validation->getError('add_colab_nome_mae'))
            	{
            		$add_colab_nome_mae_error_up = $validation->getError('add_colab_nome_mae');
            	}
				if($validation->getError('add_colab_do_pai'))
            	{
            		$add_colab_do_pai_error_up = $validation->getError('add_colab_do_pai');
            	}

				//dados do contato
				if($validation->getError('add_colab_contato_pricipal'))
            	{
            		$add_colab_contato_pricipal_error_up = $validation->getError('add_colab_contato_pricipal');
            	}
				if($validation->getError('add_colab_contato_alternativo'))
            	{
            		$add_colab_contato_alternativo_error_up = $validation->getError('add_colab_contato_alternativo');
            	}
				if($validation->getError('add_colab_contato_familiar'))
            	{
            		$add_colab_contato_familiar_error_up = $validation->getError('add_colab_contato_familiar');
            	}
				if($validation->getError('add_colab_email_pessoal'))
            	{
            		$add_colab_email_pessoal_error_up = $validation->getError('add_colab_email_pessoal');
            	}

				//endereço
				if($validation->getError('add_colab_cep_moradia'))
            	{
            		$add_colab_cep_moradia_error_up = $validation->getError('add_colab_cep_moradia');
            	}
				if($validation->getError('add_colab_uf_moradia'))
            	{
            		$add_colab_uf_moradia_error_up = $validation->getError('add_colab_uf_moradia');
            	}
				if($validation->getError('add_colab_cidade_moradia'))
            	{
            		$add_colab_cidade_moradia_error_up = $validation->getError('add_colab_cidade_moradia');
            	}
				if($validation->getError('add_colab_bairro_moraddia'))
            	{
            		$add_colab_bairro_moraddia_error_up = $validation->getError('add_colab_bairro_moraddia');
            	}
				if($validation->getError('add_colab_rua_moradia'))
            	{
            		$add_colab_rua_moradia_error_up = $validation->getError('add_colab_rua_moradia');
            	}
				if($validation->getError('add_colab_numero_moradia'))
            	{
            		$add_colab_numero_moradia_error_up = $validation->getError('add_colab_numero_moradia');
            	}
				if($validation->getError('add_colab_complemento_morada'))
            	{
            		$add_colab_complemento_morada_error_up = $validation->getError('add_colab_complemento_morada');
            	}

				//documentos 13
				if($validation->getError('add_colab_doc_numero_rg'))
            	{
            		$add_colab_doc_numero_rg_error_up = $validation->getError('add_colab_doc_numero_rg');
            	}
				if($validation->getError('add_colab_doc_orgao_emissor_rg'))
            	{
            		$add_colab_doc_orgao_emissor_rg_error_up = $validation->getError('add_colab_doc_orgao_emissor_rg');
            	}
				if($validation->getError('add_colab_doc_data_rg_emissao'))
            	{
            		$add_colab_doc_data_rg_emissao_error_up = $validation->getError('add_colab_doc_data_rg_emissao');
            	}
				if($validation->getError('add_colab_doc_uf_rg'))
            	{
            		$add_colab_doc_uf_rg_error_up = $validation->getError('add_colab_doc_uf_rg');
            	}
				if($validation->getError('add_colab_titulo_numero'))
            	{
            		$add_colab_titulo_numero_error_up = $validation->getError('add_colab_titulo_numero');
            	}
				if($validation->getError('add_colab_titulo_zona'))
            	{
            		$add_colab_titulo_zona_error_up = $validation->getError('add_colab_titulo_zona');
            	}
				if($validation->getError('add_colab_titulo_sessao'))
            	{
            		$add_colab_titulo_sessao_error_up = $validation->getError('add_colab_titulo_sessao');
            	}
				if($validation->getError('add_colab_titulo_data_emissao'))
            	{
            		$add_colab_titulo_data_emissao_error_up = $validation->getError('add_colab_titulo_data_emissao');
            	}
				if($validation->getError('add_colab_titulo_uf_emissao'))
            	{
            		$add_colab_titulo_uf_emissao_error_up = $validation->getError('add_colab_titulo_uf_emissao');
            	}
				if($validation->getError('add_colab_cpf_numero'))
            	{
            		$add_colab_cpf_numero_error_up = $validation->getError('add_colab_cpf_numero');
            	}
				if($validation->getError('add_colab_numero_pis'))
            	{
            		$add_colab_numero_pis_error_up = $validation->getError('add_colab_numero_pis');
            	}
				if($validation->getError('add_colab_reservista_numero'))
            	{
            		$add_colab_reservista_numero_error_up = $validation->getError('add_colab_reservista_numero');
            	}
				if($validation->getError('add_colab_sus_numero'))
            	{
            		$add_colab_sus_numero_error_up = $validation->getError('add_colab_sus_numero');
            	}

				//CTPS--FGTS
				if($validation->getError('add_colab_ctps_numero'))
            	{
            		$add_colab_ctps_numero_error_up = $validation->getError('add_colab_ctps_numero');
            	}
				if($validation->getError('add_colab_ctps_serie'))
            	{
            		$add_colab_ctps_serie_error_up = $validation->getError('add_colab_ctps_serie');
            	}
				if($validation->getError('add_colab_data_emissao'))
            	{
            		$add_colab_data_emissao_error_up = $validation->getError('add_colab_data_emissao');
            	}
				if($validation->getError('add_colab_uf_emissor'))
            	{
            		$add_colab_uf_emissor_error_up = $validation->getError('add_colab_uf_emissor');
            	}
				if($validation->getError('add_colab_fgts_categoria'))
            	{
            		$add_colab_fgts_categoria_error_up = $validation->getError('add_colab_fgts_categoria');
            	}
				if($validation->getError('add_colab_fgts_codigo'))
            	{
            		$add_colab_fgts_codigo_error_up = $validation->getError('add_colab_fgts_codigo');
            	}

				//UNIFORME -- TIPO SANGUE
				if($validation->getError('add_colab_uniforme_tamanho'))
            	{
            		$add_colab_uniforme_tamanho_error_up = $validation->getError('add_colab_uniforme_tamanho');
            	}
				if($validation->getError('add_colab_uniforme_calca'))
            	{
            		$add_colab_uniforme_calca_error_up = $validation->getError('add_colab_uniforme_calca');
            	}
				if($validation->getError('add_colab_tipo_sangue'))
            	{
            		$add_colab_tipo_sangue_error_up = $validation->getError('add_colab_tipo_sangue');
            	}

				//FUNCIONAIS
				if($validation->getError('add_colab_funcao_cargo'))
            	{
            		$add_colab_funcao_cargo_error_up = $validation->getError('add_colab_funcao_cargo');
            	}
				if($validation->getError('add_colab_funcao_situacao'))
            	{
            		$add_colab_funcao_situacao_error_up = $validation->getError('add_colab_funcao_situacao');
            	}
				if($validation->getError('add_colab_funcao_admissao_data'))
            	{
            		$add_colab_funcao_admissao_data_error_up = $validation->getError('add_colab_funcao_admissao_data');
            	}

				if($validation->getError('add_colab_funcao_desligamento_data'))
            	{
            		$add_colab_funcao_desligamento_data_data_error_up = $validation->getError('add_colab_funcao_desligamento_data');
            	}
				if($validation->getError('add_colab_funcao_hora_extra_fixa'))
            	{
            		$add_colab_funcao_hora_extra_fixa_error_up = $validation->getError('add_colab_funcao_hora_extra_fixa');
            	}
				if($validation->getError('add_colab_funcao_salario'))
            	{
            		$add_colab_funcao_salario_error_up = $validation->getError('add_colab_funcao_salario');
            	}

				if($validation->getError('add_colab_funcao_tipo_pagamento'))
            	{
            		$add_colab_funcao_tipo_pagamento_error_up = $validation->getError('add_colab_funcao_tipo_pagamento');
            	}
				if($validation->getError('add_colab_funcao_tipo_salario'))
            	{
            		$add_colab_funcao_tipo_salario_error_up = $validation->getError('add_colab_funcao_tipo_salario');
            	}
				if($validation->getError('add_colab_funcao_departamento'))
            	{
            		$add_colab_funcao_departamento_error_up = $validation->getError('add_colab_funcao_departamento');
            	}

				if($validation->getError('add_colab_cento_de_custo'))
            	{
            		$add_colab_cento_de_custo_error_up = $validation->getError('add_colab_cento_de_custo');
            	}
				if($validation->getError('add_colab_funcao_hora_extras'))
            	{
            		$add_colab_funcao_hora_extras_error_up = $validation->getError('add_colab_funcao_hora_extras');
            	}
				// if($validation->getError('add_colab_funcao_encarregado'))
            	// {
            	// 	$add_colab_funcao_encarregado_error_up = $validation->getError('add_colab_funcao_encarregado');
            	// }

				if($validation->getError('add_colab_funcao_periculosidade'))
            	{
            		$add_colab_funcao_periculosidade_error_up = $validation->getError('add_colab_funcao_periculosidade');
            	}
				if($validation->getError('add_colab_funcao_insalubridade'))
            	{
            		$add_colab_funcao_insalubridade_error_up = $validation->getError('add_colab_funcao_insalubridade');
            	}
				if($validation->getError('add_colab_funcao_desconto_sindical'))
            	{
            		$add_colab_funcao_desconto_sindical_error_up = $validation->getError('add_colab_funcao_desconto_sindical');
            	}

				if($validation->getError('add_colab_funcao_ps'))
            	{
            		$add_colab_funcao_ps_error_up = $validation->getError('add_colab_funcao_ps');
            	}

				//Aeroporto
				if($validation->getError('add_colab_cep_aeroporto'))
            	{
            		$add_colab_cep_aeroporto_error_up = $validation->getError('add_colab_cep_aeroporto');
            	}
				if($validation->getError('add_colab_uf_eroporto'))
            	{
            		$add_colab_uf_eroporto_error_up = $validation->getError('add_colab_uf_eroporto');
            	}

				if($validation->getError('add_colab_cidade_aeroporto'))
            	{
            		$add_colab_cidade_aeroporto_error_up = $validation->getError('add_colab_cidade_aeroporto');
            	}

				//Outros
				if($validation->getError('add_colab_outros_local_trabalho'))
            	{
            		$add_colab_outros_local_trabalho_error_up = $validation->getError('add_colab_outros_local_trabalho');
            	}
				if($validation->getError('add_colab_outros_tipo_moradia'))
            	{
            		$add_colab_outros_tipo_moradia_error_up = $validation->getError('add_colab_outros_tipo_moradia');
            	}

				if($validation->getError('add_colab_outros_observacao'))
            	{
            		$add_colab_outros_observacao_error_up = $validation->getError('add_colab_outros_observacao');
            	}

            }
            else
            {
            	$success = 'yes';
            	$model = new FuncionarioModel();
            		$model->save([
						'f_id'					=>	$this->request->getVar('id_funcionario_hidden'),
            			'f_nome'				=>	$this->request->getVar('x_add_colab_nome'),
            			'f_conjugue'			=>	$this->request->getVar('x_add_colab_conjuge'),
            			'f_codigo'				=>	$this->request->getVar('x_add_colab_codigo'),
            			'f_matricula'			=>	$this->request->getVar('x_add_colab_matricula'),
            			'f_sexo'				=>	$this->request->getVar('add_colab_sexo'),
            			'f_estado_civil'		=>	$this->request->getVar('add_colab_estado_civil'),
            			'f_grau_instrucao'		=>	$this->request->getVar('add_colab_escolaridade'),
            			'f_nacionalidade'		=>	$this->request->getVar('add_colab_nacionalidade'),
            			'f_nacionalidade_uf'	=>	$this->request->getVar('add_colab_uf_naturalidade'),
            			'f_naturalidade_cidade'	=>	$this->request->getVar('add_colab_naturalidade'),
            			'f_data_nascimento'		=>	$this->request->getVar('add_colab_data_nacimento'),
            			'f_mae'					=>	$this->request->getVar('add_colab_nome_mae'),
            			'f_pai'					=>	$this->request->getVar('add_colab_do_pai'),


            			'f_telefone_pessoal'	=>	$this->request->getVar('add_colab_contato_pricipal'),
            			'f_contato_alternativo'	=>	$this->request->getVar('add_colab_contato_alternativo'),
            			'f_telefone_contato'	=>	$this->request->getVar('add_colab_contato_familiar'),
            			'f_email_pessoal'		=>	$this->request->getVar('add_colab_email_pessoal'),


            			'f_cep'					=>	$this->request->getVar('add_colab_cep_moradia'),
            			'f_estado'				=>	$this->request->getVar('add_colab_uf_moradia'),
            			'f_cidade'				=>	$this->request->getVar('add_colab_cidade_moradia'),
            			'f_bairro'				=>	$this->request->getVar('add_colab_bairro_moraddia'),
            			'f_numero_casa'			=>	$this->request->getVar('add_colab_numero_moradia'),
            			'f_endereco'			=>	$this->request->getVar('add_colab_rua_moradia'),
            			'f_endereco_complemento'=>	$this->request->getVar('add_colab_complemento_morada'),


            			'f_rg_numero'			=>	$this->request->getVar('add_colab_doc_numero_rg'),
            			'f_rg_uf'				=>	$this->request->getVar('add_colab_doc_uf_rg'),
            			'f_rg_data_emissao'		=>	$this->request->getVar('add_colab_doc_data_rg_emissao'),
            			'f_rg_emissor'			=>	$this->request->getVar('add_colab_doc_orgao_emissor_rg'),

            			'f_titulo_eleitor_numero'=>	$this->request->getVar('add_colab_titulo_numero'),
            			'f_titulo_eleitor_nona'	=>	$this->request->getVar('add_colab_titulo_zona'),
            			'f_titulo_eleitor_sessao'=>	$this->request->getVar('add_colab_titulo_sessao'),
            			'f_titulo_eleitor_uf'	=>	$this->request->getVar('add_colab_titulo_uf_emissao'),
            			'f_titulo_eleitor_data_emissao'	=>	$this->request->getVar('add_colab_titulo_data_emissao'),

            			'f_cpf'					=>	$this->request->getVar('add_colab_cpf_numero'),
            			'f_pis'					=>	$this->request->getVar('add_colab_numero_pis'),
            			'f_numero_reservista'	=>	$this->request->getVar('add_colab_reservista_numero'),
            			'f_numero_cartao_sus'	=>	$this->request->getVar('add_colab_sus_numero'),

            			'f_ctps_numero'			=>	$this->request->getVar('add_colab_ctps_numero'),
            			'f_ctps_numero_serie'	=>	$this->request->getVar('add_colab_ctps_serie'),
            			'f_ctps_data_emissao'	=>	$this->request->getVar('add_colab_data_emissao'),
            			'f_ctps_uf'				=>	$this->request->getVar('add_colab_uf_emissor'),
            			'f_fgts_categoria'		=>	$this->request->getVar('add_colab_fgts_categoria'),
            			'f_fgts_codigo'			=>	$this->request->getVar('add_colab_fgts_codigo'),

						
            			'f_uniforme_camisa'		=>	$this->request->getVar('add_colab_uniforme_tamanho'),
            			'f_uniforme_calca'		=>	$this->request->getVar('add_colab_uniforme_calca'),
            			'f_tipo_sangue'			=>	$this->request->getVar('add_colab_tipo_sangue'),


            			'f_cargo'				=>	$this->request->getVar('add_colab_funcao_cargo'),
            			'f_fk_obra'				=>	$this->request->getVar('obra_quem_cadastra'),
            			'f_Fk_frente'			=>	$this->request->getVar('frente_quem_cadastra'),
            			'f_fk_cento_custo'		=>	$this->request->getVar('add_colab_cento_de_custo'),
            			'f_horas_trabalho'		=>	$this->request->getVar('add_colab_funcao_hora_extras'),
            			'f_fk_id_departamento'	=>	$this->request->getVar('add_colab_funcao_departamento'),

            			//'f_fk_encarregado'		=>	$this->request->getVar('add_colab_funcao_encarregado'),
            			'f_situacao'			=>	$this->request->getVar('add_colab_funcao_situacao'),
            			'f_admissao'			=>	$this->request->getVar('add_colab_funcao_admissao_data'),
            			'f_desligamento'		=>	$this->request->getVar('add_colab_funcao_desligamento_data'),
            			'f_salario'				=>	$this->request->getVar('add_colab_funcao_salario'),
            			'f_tipo_pagamento'		=>	$this->request->getVar('add_colab_funcao_tipo_pagamento'),
            			'f_tipo_salario'		=>	$this->request->getVar('add_colab_funcao_tipo_salario'),
            			'f_insalubridade'		=>	$this->request->getVar('add_colab_funcao_insalubridade'),
            			'f_periculosidade'		=>	$this->request->getVar('add_colab_funcao_periculosidade'),
            			'f_desconto_sindical'	=>	$this->request->getVar('add_colab_funcao_desconto_sindical'),
            			'f_ps'					=>	$this->request->getVar('add_colab_funcao_ps'),

            			// 'f_cnh_numero'			=>	$this->request->getVar('gender'),
            			// 'f_cnh_categoria'		=>	$this->request->getVar('gender'),
            			// 'f_cnh_emissor'			=>	$this->request->getVar('gender'),
            			// 'f_cnh_uf'				=>	$this->request->getVar('gender'),
            			// 'f_cnh_data_emissao'	=>	$this->request->getVar('gender'),
            			// 'f_cnh_data_vencimento'	=>	$this->request->getVar('gender'),
            			// 'f_cnh_data_primeira'	=>	$this->request->getVar('gender'),


            			'f_fk_local_trabalho'	=>	$this->request->getVar('add_colab_outros_local_trabalho'),
            			'f_tipo_moradia'		=>	$this->request->getVar('add_colab_outros_tipo_moradia'),
            			'f_description'			=>	$this->request->getVar('add_colab_outros_observacao'),

            			'f_aeroporto_cep'		=>	$this->request->getVar('add_colab_cep_aeroporto'),
            			'f_aeroporto_uf'		=>	$this->request->getVar('add_colab_uf_eroporto'),
            			'f_aeroporto_cidade'	=>	$this->request->getVar('add_colab_cidade_aeroporto'),
            		]);

            		$message = '<div class="alert alert-success">Colaborador alterado com sucesso!</div>';

            }

            $output = array(
            	'x_add_colab_nome_error_up'				=>	$x_add_colab_nome_error_up,
            	'x_add_colab_conjuge_nome_error_up'		=>	$x_add_colab_conjuge_nome_error_up,
            	'x_add_colab_codigo_error_up'			=>	$x_add_colab_codigo_error_up,
				'x_add_colab_matricula_error_up'		=>	$x_add_colab_matricula_error_up,
            	'add_colab_sexo_error_up'				=>	$add_colab_sexo_error_up,
            	'add_colab_estado_civil_error_up'		=>	$add_colab_estado_civil_error_up,
				'add_colab_escolaridade_error_up'		=>	$add_colab_escolaridade_error_up,
            	'add_colab_nacionalidade_error_up'		=>	$add_colab_nacionalidade_error_up,
            	'add_colab_naturalidade_error_up'		=>	$add_colab_naturalidade_error_up,

				'add_colab_uf_naturalidade_error_up'	=>	$add_colab_uf_naturalidade_error_up,
            	'add_colab_data_nacimento_error_up'		=>	$add_colab_data_nacimento_error_up,
            	'add_colab_nome_mae_error_up'			=>	$add_colab_nome_mae_error_up,
				'add_colab_do_pai_error_up'				=>	$add_colab_do_pai_error_up,

				//dados do contato
				'add_colab_contato_pricipal_error_up'		=>	$add_colab_contato_pricipal_error_up,
            	'add_colab_contato_alternativo_error_up'	=>	$add_colab_contato_alternativo_error_up,
            	'add_colab_contato_familiar_error_up'		=>	$add_colab_contato_familiar_error_up,
				'add_colab_email_pessoal_error_up'			=>	$add_colab_email_pessoal_error_up,

				//endereço
				'add_colab_cep_moradia_error_up'		=>	$add_colab_cep_moradia_error_up,
            	'add_colab_uf_moradia_error_up'			=>	$add_colab_uf_moradia_error_up,
            	'add_colab_cidade_moradia_error_up'		=>	$add_colab_cidade_moradia_error_up,
				'add_colab_bairro_moraddia_error_up'	=>	$add_colab_bairro_moraddia_error_up,
				'add_colab_rua_moradia_error_up'		=>	$add_colab_rua_moradia_error_up,
            	'add_colab_numero_moradia_error_up'		=>	$add_colab_numero_moradia_error_up,
            	'add_colab_complemento_morada_error_up'	=>	$add_colab_complemento_morada_error_up,

				//documentos
				'add_colab_doc_numero_rg_error_up'			=>	$add_colab_doc_numero_rg_error_up,
            	'add_colab_doc_orgao_emissor_rg_error_up'	=>	$add_colab_doc_orgao_emissor_rg_error_up,
            	'add_colab_doc_data_rg_emissao_error_up'	=>	$add_colab_doc_data_rg_emissao_error_up,
				'add_colab_doc_uf_rg_error_up'				=>	$add_colab_doc_uf_rg_error_up,
				'add_colab_titulo_numero_error_up'			=>	$add_colab_titulo_numero_error_up,
            	'add_colab_titulo_zona_error_up'			=>	$add_colab_titulo_zona_error_up,
            	'add_colab_titulo_sessao_error_up'			=>	$add_colab_titulo_sessao_error_up,
				'add_colab_titulo_data_emissao_error_up'	=>	$add_colab_titulo_data_emissao_error_up,
            	'add_colab_titulo_uf_emissao_error_up'		=>	$add_colab_titulo_uf_emissao_error_up,
            	'add_colab_cpf_numero_error_up'				=>	$add_colab_cpf_numero_error_up,
				'add_colab_numero_pis_error_up'				=>	$add_colab_numero_pis_error_up,
				'add_colab_reservista_numero_error_up'		=>	$add_colab_reservista_numero_error_up,
            	'add_colab_sus_numero_error_up'				=>	$add_colab_sus_numero_error_up,

				//CTPS--FGTS
				'add_colab_ctps_numero_error_up'			=>	$add_colab_ctps_numero_error_up,
            	'add_colab_ctps_serie_error_up'				=>	$add_colab_ctps_serie_error_up,
            	'add_colab_data_emissao_error_up'			=>	$add_colab_data_emissao_error_up,
				'add_colab_uf_emissor_error_up'				=>	$add_colab_uf_emissor_error_up,
				'add_colab_fgts_categoria_error_up'			=>	$add_colab_fgts_categoria_error_up,
            	'add_colab_fgts_codigo_error_up'			=>	$add_colab_fgts_codigo_error_up,

				//UNIFORME -- TIPO SANGUE
				'add_colab_uniforme_tamanho_error_up'		=>	$add_colab_uniforme_tamanho_error_up,
				'add_colab_uniforme_calca_error_up'			=>	$add_colab_uniforme_calca_error_up,
            	'add_colab_tipo_sangue_error_up'			=>	$add_colab_tipo_sangue_error_up,

				//FUNCIONAIS
				'add_colab_funcao_cargo_error_up'					=>	$add_colab_funcao_cargo_error_up,
				'add_colab_funcao_situacao_error_up'				=>	$add_colab_funcao_situacao_error_up,
            	'add_colab_funcao_admissao_data_error_up'			=>	$add_colab_funcao_admissao_data_error_up,

				'add_colab_funcao_desligamento_data_data_error_up'	=>	$add_colab_funcao_desligamento_data_data_error_up,
				'add_colab_funcao_hora_extra_fixa_error_up'			=>	$add_colab_funcao_hora_extra_fixa_error_up,
            	'add_colab_funcao_salario_error_up'					=>	$add_colab_funcao_salario_error_up,

				'add_colab_funcao_tipo_pagamento_error_up'		=>	$add_colab_funcao_tipo_pagamento_error_up,
				'add_colab_funcao_tipo_salario_error_up'		=>	$add_colab_funcao_tipo_salario_error_up,
            	'add_colab_funcao_departamento_error_up'		=>	$add_colab_funcao_departamento_error_up,

				'add_colab_cento_de_custo_error_up'				=>	$add_colab_cento_de_custo_error_up,
				'add_colab_funcao_hora_extras_error_up'			=>	$add_colab_funcao_hora_extras_error_up,
            	//'add_colab_funcao_encarregado_error_up'			=>	$add_colab_funcao_encarregado_error_up,

				'add_colab_funcao_periculosidade_error_up'		=>	$add_colab_funcao_periculosidade_error_up,
				'add_colab_funcao_insalubridade_error_up'		=>	$add_colab_funcao_insalubridade_error_up,
            	'add_colab_funcao_desconto_sindical_error_up'	=>	$add_colab_funcao_desconto_sindical_error_up,
				'add_colab_funcao_ps_error_up'					=>	$add_colab_funcao_ps_error_up,

				//Aeroporto
				'add_colab_cep_aeroporto_error_up'		=>	$add_colab_cep_aeroporto_error_up,
				'add_colab_uf_eroporto_error_up'		=>	$add_colab_uf_eroporto_error_up,
				'add_colab_cidade_aeroporto_error_up'	=>	$add_colab_cidade_aeroporto_error_up,

				//Outros
				'add_colab_outros_local_trabalho_error_up'		=>	$add_colab_outros_local_trabalho_error_up,
				'add_colab_outros_tipo_moradia_error_up'		=>	$add_colab_outros_tipo_moradia_error_up,
				'add_colab_outros_observacao_error_up'			=>	$add_colab_outros_observacao_error_up,


            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );

            echo json_encode($output);
		}
	}
}
