<?php
namespace Model;

class Precos {
	protected $data = [
		['cpfCnpj' => '53923866000130', 'produto' => 'CCF', 'valor' => 2.5],
		['cpfCnpj' => '53923866000130', 'produto' => 'NEG', 'valor' => 3],
		['cpfCnpj' => '53923866000130', 'produto' => 'EST', 'valor' => 3],
		['cpfCnpj' => '53923866000130', 'produto' => 'REP', 'valor' => 1],
		['cpfCnpj' => '53923866000130', 'produto' => 'COMP', 'valor' => 15],
		['cpfCnpj' => '99544190554', 'produto' => 'CCF', 'valor' => 1.9],
		['cpfCnpj' => '99544190554', 'produto' => 'NEG', 'valor' => 3],
		['cpfCnpj' => '99544190554', 'produto' => 'EST', 'valor' => 3.5],
		['cpfCnpj' => '99544190554', 'produto' => 'REP', 'valor' => 1.5],
		['cpfCnpj' => '99544190554', 'produto' => 'COMP', 'valor' => 11],
	];
	public $cpfCnpj = null;
	public $produto = null;
	public $valor = null;
	public function get($cpfCnpj){
		$precos = [];
		foreach($this->data as $data){
			if ($data['cpfCnpj'] == $cpfCnpj){
				unset($data['cpfCnpj']);
				$produtos = new Produtos();
				$prod = $produtos->get($data['produto']);
				$data['descricao'] = $prod['produto'];
				$data['custo'] = $prod['custo'];
				$data['margenMinima'] = $prod['margenMinima'];
				$precos[] = $data;
			}
		}
		return $precos;
	}
}