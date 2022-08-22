<?php
namespace Controller;
use Model\Clientes as Cli;
class TabelaCliente{
	public function get(){
		$cli = new Cli();
		$clientes = $cli->get(null);
		$GLOBALS['data'] = $clientes;
		loadView('TabelaClientes');

	}
}