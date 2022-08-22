<?php 
	// liberar acesso de outro dominio
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

	// exibir todos os erros e avisos
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// definir um timeout por solicitação da fusion
	set_time_limit(60);
	
	use Helpers\Mensagens as Mensagens;
	use Controller;
	// criar um autoload aqui para testar
	require_once( __DIR__ . "/autoload.php");	

	// iniciar a sessao
	session_start();
	
	// definir o autoload da casanova
	//require_once( __DIR__ . "/autoload.php");	
	require_once('Constantes.php');

	// pegar usuário logado e senha
	define("USERNAME", isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER']: null);
	define("PASSWORD", isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW']: null);
	
	// constantes do projeto
    define("FOLDER_CONTROLLER", __DIR__ . "/App/Controller/");
    define("FOLDER_VIEW", __DIR__ . "/App/View/");
    define("FOLDER_MODEL", __DIR__ . "/App/Model/");
	define("FOLDER_INCLUDE", FOLDER_VIEW."Include/");
    define("FOLDER_PUBLIC", __DIR__ . "/public/");
	define("FOLDER_MODELOS", FOLDER_VIEW."Modelos/");
	define('FOLDER_VIDEO', FOLDER_PUBLIC."video/");	
	define('FOLDER_ROOT', __DIR__);
    define("PHP", ".php");
    define("DEFAULT_CONTROLLER", 'index');
    define("DEFAULT_ACTION", 'get');
	define("CONTROLLER_UNKNOW_BASE", false); // se o controlador não existir enviar para a raiz do site
	

	/**
	 * definido
	 *
	 * @param var $campoDefinido 
	 * @return boolean se o campo foi definido e é diferente de vazio
	 */
	function campoDefinido($array, $campo){
		if (!isset($array[$campo])) return false;
		if ($array[$campo] === '' || $array[$campo] === false) return false;
		return true;
	}
	/**
	 * loadController
	 * Carrega um controlador
	 *
	 */
	function loadController($controller){
		//require (FOLDER_CONTROLLER.$controller.PHP);
		$controller = "Controller\\$controller";
		return new $controller();
	}

	/**
	 * loadModel
	 * Carrega um model já passando um banco de dados
	 *
	 */
	function loadModel($banco, $model){
		require (FOLDER_MODEL.$model.PHP);
		return new $model($banco);
	}
	
	/**
	 * loadView
	 * Carregar as views do sistema
	 */
	function loadView($view){
		$view = explode('\\', $view);
		if (count($view) == 2) {
			$view = $view[1];
		} else {
			$view = $view[0];
		}
		if (!file_exists(FOLDER_VIEW.$view.PHP)) {
			return false;
		} else {
            foreach ($GLOBALS as $c => $v) {
                $$c = $v;
            }
            require(FOLDER_VIEW.$view.PHP);
			return true;
        }
	}

	/**
	* getParam
	* Retorna um parâmetro baseado no índice
	*
	*/
	function getParam($index){
		$params = explode(',',PARAMS);
		if ($index < count($params)) {
			return $params[$index];
		} else {
			return null;
		}
	}
	
	/**
	 * headerJson
	 * @category Retorna o cabeçalho json para o cliente
	 * @return void o cabeçalho json será anexado na resposta
	 */

	 function headerJson(){
		// permitir o acesso a de qualquer servidor
		header('Access-Control-Allow-Origin: *');
		// enviar o cabeçalho json
		header("Content-type: application/json; charset=utf-8");
	 }

	/**
	* getJson
	* Retorna o json enviado no corpo da solicitação
	*/
	function getJson(){
		$m = new Mensagens();
		// verificar se foram enviados no corpo
		if (trim(DATA) == '') {
			return null;
		}
		
		// decodificar
		$dados = json_decode(DATA, true);

		// verificar erros
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				return $dados;
			break;
			case JSON_ERROR_DEPTH:
				$m->httpBadRequet('Json - Maximum stack depth exceeded');
			break;
			case JSON_ERROR_STATE_MISMATCH:
				$m->httpBadRequet('Json - Underflow or the modes mismatch');
			break;
			case JSON_ERROR_CTRL_CHAR:
				$m->httpBadRequet('Json - Unexpected control character found');
			break;
			case JSON_ERROR_SYNTAX:
				$m->httpBadRequet('Json - Syntax error, malformed JSON');
			break;
			case JSON_ERROR_UTF8:
				$m->httpBadRequet('Json - Malformed UTF-8 characters, possibly incorrectly encoded');
			break;
			default:
				$m->httpBadRequet('Json - Unknown error');
			break;
		}		
	}
	
	// pegar o controlador enviado
	$uri = explode('/', $_SERVER['REQUEST_URI']);
	$controlador = isset($uri[1]) ? $uri[1] : DEFAULT_CONTROLLER;
    $acao = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : DEFAULT_ACTION;
	
	// passar os parametros para as constantes
	$params = "";
	$virgula = "";
	$paramcont = 0;
	for ($i = 2; $i < 10; $i++) {
		define("PARAM".($i-2), isset($uri[$i]) ? $uri[$i] : null);
		if (isset($uri[$i])) { 
			$paramcont++;
			$params .= $virgula.$uri[$i];
			$virgula = ",";
		}
	}
	// definir a contagem de parametros e a lista de parametros
	define("PARAMS", $params);
	define("PARAMCONT", $paramcont);
	
	// pegar os dados passaos no corpo da solicitação
	define("DATA", file_get_contents('php://input'));
	
	// verificar se o controlador existe
    if (!file_exists(FOLDER_CONTROLLER.$controlador.PHP)) {
		$controlador = ucfirst($controlador);
		if (!file_exists(FOLDER_CONTROLLER.$controlador.PHP)) {
			// verificar se existe uma view
			//$controlador = strtolower($controlador);
			if (file_exists(FOLDER_VIEW.$controlador.PHP)) {
				include(FOLDER_VIEW.$controlador.PHP);
				exit;
			} else {
				$controlador = strtolower($controlador);
				if (file_exists(FOLDER_VIEW.$controlador.PHP)) {
					include(FOLDER_VIEW.$controlador.PHP);
					exit;
				} else {
					if (CONTROLLER_UNKNOW_BASE) {
						header("Location: /");
						exit;
					}
					die("<html><head><title>Erro</title></head><body><h1>Controlador <i>$controlador</i> não existe!</h1></body></html>");
					exit;
				}
			}
		}
    } 
	
	// criar o objeto
	$objController = "Controller\\$controlador";
	$obj = new $objController();
	
	// verificar se a acao é um número e passar como um parâmetro do méthod show
	if (!method_exists($obj, $acao)) {
		$_GET[1] = $acao;
		$acao = DEFAULT_ACTION;
	}

	// verificar se a função existe dentro do objeto
	if (!method_exists($obj, $acao)) {
		// verificar se é a ação padrão e se existe uma view
		die("<html><head><title>Erro</title></head><body><h1>Método <i>$acao</i> não existe no controlador <i>$controlador</i></h1></body></html>");
    }

	// fazer a autenticação caso não seja uma solicitação de ajuda

	
	// pegar o objeto
	$reflectionClass = new ReflectionClass($obj);
	$method = $reflectionClass->getMethod($acao);
	$parameters = $method->getParameters();
	
	// verificar se foi solicitado o banco
	$obj->$acao();
		
?>