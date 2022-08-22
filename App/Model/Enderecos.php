<?php
namespace Model;

class Enderecos {
	protected $data = [
		['cpfCnpj' => '53923866000130', 'tipo' => 'SEDE', 'cep' => '30710540', 'numero' => '100'],
		['cpfCnpj' => '53923866000130', 'tipo' => 'COBRANCA', 'cep' => '31230060', 'numero' => '102'],
		['cpfCnpj' => '99544190554', 'tipo' => 'SEDE', 'cep' => '30710530', 'numero' => '102']
	];
	public $cpfCnpj = null;
	public $tipo = null;
	public $cep = null;
	public $numero = null;
	public function get($cpfCnpj){
		$enderecos = [];
		foreach($this->data as $data){
			if ($data['cpfCnpj'] == $cpfCnpj){
				unset($data['cpfCnpj']);
				$endViaCep = json_decode($this->getEnderecoByCep($data['cep']), true);
				$data['logradouro'] = $endViaCep['logradouro'];
				$data['bairro'] = $endViaCep['bairro'];
				$data['localidade'] = $endViaCep['localidade'];
				$data['uf'] = $endViaCep['uf'];
				$enderecos[] = $data;
			}
		}
		return $enderecos;
	}
	private function getEnderecoByCep($cep){
		$url = "https://viacep.com.br/ws/{$cep}/json/";
		return file_get_contents($url);
	}
}
