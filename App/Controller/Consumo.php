<?php
namespace Controller;
use Model\Produtos as Produtos;
use Model\Clientes as Clientes;
use Helpers\Texto as Texto;
class Consumo {
	public function get(){
		if (!file_exists("consumo.csv")) die("Arquivo csv não encontrado!");
		$clientes = new Clientes();
		$csv = explode("\n", file_get_contents("consumo.csv"));
		$dados = [];
		for ($i = 1; $i < count($csv); $i++){
			$consumo = [];
			$linha = explode(",", $csv[$i]);
			$linha[0] = Texto::numeros($linha[0]);
			$cli = $clientes->get($linha[0])[0];
			$consumo['cliente'] = $cli['nome'];
			$produto = $this->getProduto($cli['precos'], $linha[1]);
			$consumo['produto'] = $produto['produto'];
			$consumo['descricao'] = $produto['descricao'];
			$consumo['valor'] = $produto['valor'];
			$consumo['custo'] = $produto['custo'];
			$consumo['qtde'] = $linha[2];
			$consumo['valor_total'] = $consumo['valor'] * $consumo['qtde'];
			$consumo['custo_total'] = $consumo['custo'] * $consumo['qtde'];
			$consumo['lucro'] = $consumo['valor_total'] - $consumo['custo_total'];
			$dados[] = $consumo;
		}
		$GLOBALS['dados'] = $dados;
		loadView('consumo');
	}
	
	private function getProduto($precos, $produto){
		foreach($precos as $preco){
			if ($preco['produto'] == $produto) return $preco;
		}
	}
}