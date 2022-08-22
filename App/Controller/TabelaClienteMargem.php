<?php
namespace Controller;
use Model\Clientes as Cli;
class TabelaClienteMargem{
	public function get(){
		$cli = new Cli();
		$clientes = $cli->get(null);
		$GLOBALS['data'] = $clientes;
		loadView('TabelaClientesMargem');

	}
}