<?php
namespace Controller;
use Model\Clientes as Cli;
class Cliente{
	public function get(){
		$cli = new Cli();
		$clientes = $cli->get(PARAM0);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($clientes, true);
	}
}