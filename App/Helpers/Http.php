<?php
namespace Helpers;

class Http{
    /**
     * statusOk
     *
     * @param string description
     * @return void
     */
    public static function statusOk($description){
        return ['status' => 'ok', 'description' => $description];
    }
    /**
     * statusErr
     *
     * @param string description
     * @return void
     */
    public static function statusErr($description){
        return ['status' => 'err', 'description' => $description];
    }

    /**
	 * httpOk
	 *
	 * @param string com detalhes da rsposta
	 * @return string cabecalho http ok e corpo em json com detalhes do erro
	 */
	public static function httpOk($json){
		if (is_array($json)) $json = json_encode($json, true);
		header('HTTP/1.1 200 ok', true, 200);
		headerJson();
		echo $json;
		exit;
	}
	
	 /**
	 * created
	 *
	 * @param string com detalhes da rsposta
	 * @return string cabecalho http ok e corpo em json com detalhes do erro
	 */
	public static function created($json){
		if (is_array($json)) $json = json_encode($json, true);
		header('HTTP/1.1 201 created', true, 201);
		headerJson();
		echo $json;
		exit;
	}	

	 /**
	 * internalServerError
	 *
	 * @param string com detalhes da rsposta
	 * @return string cabecalho http ok e corpo em json com detalhes do erro
	 */
	public static function internalServerError($json){
		if (is_array($json)) $json = json_encode($json, true);
		header('500 Internal Server Error', true, 500);
		headerJson();
		echo $json;
		exit;
	}	

	/**
	 * conflict
	 *
	 * @param string com detalhes da rsposta
	 * @return string cabecalho http not found e corpo em json com detalhes do erro
	 */
	public static function conflict($json){
		if (is_array($json)) $json = json_encode($json, true);
		header('HTTP/1.1 409 Conflict', true, 409);
		headerJson();
		echo $json;
		exit;
	}

	/**
	 * notFound
	 *
	 * @param string com detalhes da rsposta
	 * @return string cabecalho http not found e corpo em json com detalhes do erro
	 */
	public static function notFound($json){
		if (is_array($json)) $json = json_encode($json, true);
		header('HTTP/1.1 404 Not Found', true, 404);
		headerJson();
		echo $json;
		exit;
	}

	/**
	 * badRequest
	 *
	 * @param string com detalhes da resposta
	 * @return string cabecalho http bad request e corpo em json com detalhes do erro
	 */
	public static function badRequest($json){
		if (is_array($json)) $json = json_encode($json, true);
		header('HTTP/1.1 400 Bad Request', true, 400);
		headerJson();
		echo $json;
		exit;
	}

		/**
	 * notImplemented
	 *
	 * @param string com detalhes da resposta
	 * @return string cabecalho http bad request e corpo em json com detalhes do erro
	 */
	public static function notImplemented($json){
		if (is_array($json)) $json = json_encode($json, true);
		header('HTTP/1.1 501 Not Implemented', true, 501);
		headerJson();
		echo $json;
		exit;
	}
	/**
	 * erros de retorno
	 *
	 */
    public static function unautorized(){
		header("HTTP/1.1 401 Unauthorized", true, 401);
		headerJson();
		echo 
			json_encode(
				[
					"status" => "err", 
					"description" => "Erro de autenticação, usuário ou senha inválidos. Usuário: ".USERNAME.". Senha:".PASSWORD,
				]
			);
		exit;
	 }
}