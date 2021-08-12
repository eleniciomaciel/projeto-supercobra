<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Validation\Userrules;
use App\Validation\Userlocal;
use App\Validation\TwoExamsAlreadyExistrulesValidation;
use App\Validation\QualidadeQuantidade;
use App\Validation\SolicitacaoUsuarioJaExiste;
use App\Validation\ValidaCpfValidation;
use App\Validation\ValidaEmpresaRepresentanteOneValidation;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
		Userrules::class, //aqui nós registramos
		Userlocal::class,
		TwoExamsAlreadyExistrulesValidation::class,
		QualidadeQuantidade::class,
		SolicitacaoUsuarioJaExiste::class,
		ValidaCpfValidation::class,
		ValidaEmpresaRepresentanteOneValidation::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
