<?php
namespace Model;

class Produtos {
	protected $data = [
	['produto' => 'Cheques Sem Fundo', 'fornecedor' => 'CCF', 'custo' => 1, 'margenMinima' => 1],
	['produto' => 'Anotações Negativas', 'fornecedor' => 'NEG', 'custo' => 2, 'margenMinima' => 0.5],
	['produto' => 'Veicular Estadual', 'fornecedor' => 'EST', 'custo' => 1.5, 'margenMinima' => 0.75],
	['produto' => 'Rodas e Pneus', 'fornecedor' => 'REP', 'custo' => 0.5, 'margenMinima' => 1.5],
	['produto' => 'Completa', 'fornecedor' => 'COMP', 'custo' => 10, 'margenMinima' => 1.2]
	];
	public $produto = null;
	public $fornecedor = null;
	public $custo = null;
	public $margenMinima = null;
	public function get($fornecedor){
		$produto = [];
		foreach($this->data as $data){
			if ($data['fornecedor'] == $fornecedor){
				$this->produto = $data['produto'];
				$this->fornecedor = $data['fornecedor'];
				$this->custo = $data['custo'];
				$this->margenMinima = $data['margenMinima'];
				$produto = $data;
			}
		}
		return $produto;
	}
}