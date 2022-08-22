<?php

namespace Helpers;
class Mensagens {
	private function sendStatus($code, $text){
		header("HTTP/1.1 {$code} {$text}", true, $code);
		header('Content-Type: application/json; charset=utf-8');
	}
	public function httpOk($description = 'Solicitação processada com sucesso!', $data = []){
		$this->sendStatus(200, 'OK');
		echo json_encode(['status' => 'ok', 'description' => $description] + $data, true);
		exit;
	}
	public function httpCreated($description = 'Recurso criado com sucesso!', $data = []){
		$this->sendStatus(201, 'Created');
		echo json_encode(['status' => 'ok', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpAccepted($description = 'Solicitação aceita com sucesso!', $data = []){
		$this->sendStatus(202, 'Accepted');
		echo json_encode(['status' => 'ok', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpNoContent($description  = 'Solicitação processada com sucesso, mas não retornou conteúdo', $data = []){
		$this->sendStatus(204, 'No Content');
		echo json_encode(['status' => 'ok', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpPartialContent($description = 'Solicitação processada com sucesso e parte do conteúdo foi retornado!', $data = []){
		$this->sendStatus(206, 'Partial Content');
		echo json_encode(['status' => 'ok', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpBadRequet($description = 'Erros na solicitação!', $data = []){
		$this->sendStatus(400, 'Bad Request');
		echo json_encode(['status' => 'err', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpUnauthorized($description = 'Você deve se autenticar para acessar o recurso.', $data = []){
		$this->sendStatus(401, 'Unauthorized');
		echo json_encode(['status' => 'err', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpForbiden($description = 'Você não tem permissão para acessar este recurso.', $data = []){
		$this->sendStatus(403, 'Forbiden');
		echo json_encode(['status' => 'err', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpNotFound($description = 'Recurso não foi encontrado.', $data = []){
		$this->sendStatus(404, 'Not Found');
		echo json_encode(['status' => 'err', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpConflict($description = 'Esta solicitação provocou um conflito entre solicitações ou recursos!', $data = []){
		$this->sendStatus(409, 'Conflict');
		echo json_encode(['status' => 'err', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpInternalServerError($description = 'Ocorreu um erro no servidor.', $data = []){
		$this->sendStatus(500, 'Internal Server Error');
		echo json_encode(['status' => 'err', 'description' => $description] + $data, true);
		exit;		
	}
	public function httpNotImplemented($description = 'Este recurso ainda não foi implementado.', $data = []){
		$this->sendStatus(501, 'Not Implemted');
		echo json_encode(['status' => 'err', 'description' => $description] + $data, true);
		exit;		
	}



}