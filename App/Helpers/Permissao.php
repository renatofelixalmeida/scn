<?php
namespace Helpers;

class Permissao {
    private $_banco;
    function __construct($banco)
    {
        $this->_banco = $banco;
    }

    public function temPermissao($id_usuario, $objeto, $acao) {
        $objeto = explode('\\', $objeto);
        if (count($objeto) > 1) {
            $objeto = $objeto[1];
        } else {
            $objeto = $objeto[0];
        }
        $sql = "SELECT PERMITIDO FROM CHK_PERMISSAO({$id_usuario}, '{$objeto}', '{$acao}')";
        return $this->_banco->consultaCampo($sql) == 1;
    }
}