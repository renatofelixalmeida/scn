<?php
namespace Model;
class Clientes {
	protected $data = [
		['nome' => 'Empresa 1', 'cpfCnpj' => '53923866000130', 'tipo' => 'PJ'],
		['nome' => 'Pessoa 1', 'cpfCnpj' => '99544190554', 'tipo' => 'PF']
	];
	public $nome = null;
	public $tipo = null;
	public $cpfCnpj = null;
	public $enderecos = null;
	public $tabelaPrecos = null;
	
	public function get($cpfCnpj = null){
		$clientes = [];
		if ($cpfCnpj != null) {
			foreach($this->data as $data){
				if ($data['cpfCnpj'] == $cpfCnpj) {
					$clientes[] = $data;
				}
			}
		} else {
			$clientes = $this->data;
		}
		for($i = 0; $i < count($clientes); $i++){
			$enderecos = new Enderecos();
			$precos = new Precos();
			$clientes[$i]['enderecos'] = $enderecos->get($clientes[$i]['cpfCnpj']);
			$clientes[$i]['precos'] = $precos->get($clientes[$i]['cpfCnpj']);
		}
		return $clientes;
	}
		
}