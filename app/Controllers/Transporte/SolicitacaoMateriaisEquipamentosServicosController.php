<?php

namespace App\Controllers\Transporte;

use App\Controllers\BaseController;
use App\Models\ConsultasGeralModel;
use App\Models\SolicitacaoMaterialEquipamentosServicosModel;
use App\Models\QualidadeCategoriaModel;
use App\Models\QualidadeDocumentosModel;
use App\Models\CentocustoModel;
use App\Models\SolicitaitenscompraModel;
use App\Models\SolicitacaoarquivoModel;

class SolicitacaoMateriaisEquipamentosServicosController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "TRANSPORTE") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'solicitacao-materiais-equipamentos-servicos')
	{
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$id = session()->get('id');
		$id_obra = session()->get('log_obra');
		//dd($id_obra);
		$model_user = new ConsultasGeralModel();
		$model_servicos = new SolicitacaoMaterialEquipamentosServicosModel();
		$data = [
			'user_dd' => $model_user->listaDadosUsuario($id),
			'user_obra' => $model_user->getFuncionarioObra($id_obra),
			'lista_doc_servicos' => $model_servicos->getSolicitacoesMES(),
		];
		
		echo view('frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page, $data);
	}

	public function verSolicitacao(int $id_solicitacao)
	{
		$page = 'solicitacao-materiais-equipamentos-servicos_alterar';
		$id = session()->get('id');
		$id_obra = session()->get('log_obra');
		$model_user = new ConsultasGeralModel();
		$model_servicos = new SolicitacaoMaterialEquipamentosServicosModel();
		

		$data['news'] = $model_servicos->getSolicitacoesMES($id_solicitacao);

		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('O registro não foi encontrado: ' . $id_solicitacao);
		}

		$data = [
			'user_dd' => $model_user->listaDadosUsuario($id),
			'user_obra' => $model_user->getFuncionarioObra($id_obra),
			'lista_doc_servicos' => $model_servicos->where('smes_id', $id_solicitacao)->first(),
			
		];

		echo view('frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page, $data);
	}

	public function addItens(int $id_solicitacao)
	{
		$page = 'solicitacao-add-itens';
		$id = session()->get('id');
		$id_obra = session()->get('log_obra');
		$id_departamento = session()->get('log_departamento');

		$model_user = new ConsultasGeralModel();
		$model_servicos = new SolicitacaoMaterialEquipamentosServicosModel();
		$model_qualidade = new QualidadeCategoriaModel();
		$model_cc = new CentocustoModel();
		$model_itens_solicitacao = new SolicitaitenscompraModel();
		$data['news'] = $model_servicos->getSolicitacoesMES($id_solicitacao);

		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('O registro não foi encontrado: ' . $id_solicitacao);
		}

		$data = [
			'user_dd' => $model_user->listaDadosUsuario($id),
			'user_obra' => $model_user->getFuncionarioObra($id_obra),
			'list_join' => $model_servicos->getDadosSolictanteMES($id_solicitacao),
			'lista_doc_servicos' => $model_servicos->where('smes_id', $id_solicitacao)->first(),
			'lista_categoria_qualidade' => $model_qualidade->findAll(),
			'lista_cc' => $model_cc->where('fk_departamento', $id_departamento)->findAll(),
			'list_itens_solicitacao' => $model_itens_solicitacao->where('isc_id_fk_solicitacao_compra', $id_solicitacao)->findAll()
		];

		echo view('frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page, $data);
	}

	//get consulta json todos as caterias da qualidade para inserir no documento
	public function getListaQualidadeCategoriaItens()
	{
		$model_qualidade_itens = new QualidadeDocumentosModel();
		$id_postatdo_data = $this->request->getVar('quali_id');
		$data = $model_qualidade_itens->where('qld_fk_categoria', $id_postatdo_data)->findAll();
		echo json_encode($data);
	}

	public function paginaArquivos(int $id_solicitacao = null)
	{
		$page = 'solicitacao-arquivos';
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_servicos = new SolicitacaoMaterialEquipamentosServicosModel();
		$model_doc = new SolicitacaoarquivoModel();
		$data['news'] = $model_servicos->getSolicitacoesMES($id_solicitacao);

		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('O registro não foi encontrado: ' . $id);
		}

		$data = [
			'solicitacao' => $model_servicos->where('smes_id', $id_solicitacao)->first(),
			'list_docs' => $model_doc->where('doc_solic_id_fk_solicitacao', $id_solicitacao)->findAll()
		];
		
		return view('frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page, $data);
	}

	public function paginaArquivosPdf(int $id_solicitacao)
	{
		$page = 'solicitacao-pdf';
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$id = session()->get('id');
		$model_servicos = new SolicitacaoMaterialEquipamentosServicosModel();
		$model_qualidade_itens = new SolicitaitenscompraModel();
		$model_user = new ConsultasGeralModel();
		$data['news'] = $model_servicos->getSolicitacoesMES($id_solicitacao);

		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('O registro não foi encontrado: ' . $id_solicitacao);
		}

		$data = [
			'solicitacao' => $model_servicos
			->join('funcionarios', 'funcionarios.f_id = solicitacao_material_equipamentos_servicos.smes_usuarios_solicitante_fk')
			->join('obras', 'obras.id = solicitacao_material_equipamentos_servicos.smes_obra_solicitante_fk')
			->join('departamentos', 'departamentos.id = solicitacao_material_equipamentos_servicos.smes_departamento_fk')
			->where('smes_id', $id_solicitacao)
			->first(),
			'list_itens' => $model_qualidade_itens->where('isc_id_fk_solicitacao_compra', $id_solicitacao)->findAll(),
			'user_dd' => $model_user->listaDadosUsuario($id),
		];
		
		return view('frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page, $data);
	}
}
