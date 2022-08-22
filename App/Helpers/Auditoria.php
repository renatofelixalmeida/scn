<?php
namespace Helpers;
use Model\Banco as Banco;

class Auditoria {
    private $_banco = null;
    function __construct($banco) {
        $this->_banco = $banco;
    }
    public function gravarAuditoria($objeto, $acao, $dados, $id_objeto, $id_relacionado) {
        $sql = "INSERT INTO AUDITORIA (ID_AUDITORIA, ID_USUARIO, OBJETO, ACAO, DATA, ID_OBJETO, ID_RELACIONADO)
        VALUES (0, ".ID_USUARIO.", '{$objeto}', '{$acao}',  '{$dados}', {$id_objeto}, {$id_relacionado})";
        $this->_banco->atualizar($sql);
    }
}