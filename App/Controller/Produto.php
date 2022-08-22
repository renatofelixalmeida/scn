<?php
namespace Controller;
use Model\Produtos as Produtos;
class Produto {
	public function get(){
		$pro = new Produtos();
		$produtos = $pro->get(PARAM0);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($produtos, true);
	}
}