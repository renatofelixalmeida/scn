<?php
	namespace Helpers;
    /**
	 * Banco
     * @category Classe para conexão com banco de dados e ações de busca e atualização
     * Todos os dados serão retornados por padrão em um array associativo
	 * @author Renato Felix de Almeida <renatofelixalmeida@gmail.com>
	 * @copyright 2020 Casa Nova Locadora
     */
    class Banco{
        private $arquivo = '100.100.0.50/3060:/dados/dados.fdb ';
        private $user = 'sysdba';
        private $pass = 'masterkey';
        private $db = null;
        function __construct() {
            if (!$this->db = ibase_pconnect($this->arquivo, $this->user, $this->pass)){
				trigger_error("Erro ao conectar ao banco de dados: ".ibase_errmsg());
				die();
			}
        }
		/**
		* consulta
		* @category executa uma consulta em um banco de dados e retorna um array
		* @author Renato Félix de Almeida <renatofelixalmeida@gemail.com>
		* @param string $sql Consulta sql
		* @param boolean $assoc se retorna um array associativo ou array simples
		* @param boolean $convert se vai converter para utf-8
		* @return array um array bidimensional com o resultado da consulta
		*/
		public function consulta($sql, $assoc = true, $convert = false, $blob = null){
			if ($blob == null) $blob = array();
			if (!is_array($blob)) $blob = array($blob);
			if (!$query = ibase_query($sql)){
				trigger_error("Erro ao executar consulta: ".ibase_errmsg()."\n$sql");
				die();
			}
			$saida = array();
			if ($assoc) {
                while ($row = ibase_fetch_assoc($query)) {
					foreach ($row as $c => $v) {
						if (in_array($c, $blob)) {
							$v = $this->pegarCampoBlob($row[$c]);
							$row[$c] = $v;
						}
                        if ($convert) {
                            $row[$c] = mb_convert_encoding($v, 'UTF-8', 'CP1252');
                        }
					}
                    $saida[] = $row;
                }
			} else {
				while ($row = ibase_fetch_row($query)) {
					if ($convert) {
						for ($i=0; $i<count($row);$i++)
							$row[$i] = mb_convert_encoding($row[$i], 'UTF-8', 'CP1252');
					}
					$saida[] = $row;
				}
			}
			return $saida;
		}

		public function pegarCampoBlob($campo){
			$blob_data = ibase_blob_info($campo);
			$blob_hndl = ibase_blob_open($campo);
			$obs = ibase_blob_get( $blob_hndl, $blob_data[0]);
			ibase_blob_close($blob_hndl);
			return $obs;
		}

		/**
		 * consultaLinha
		 * @category retorna a primeira linha de uma consulta sql
		 * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
		 * @copyright 2020 Casa Nova Locadora
		 * @param string $sql Uma consulta sql
		 * @param boolean $assoc se vai retornar um array associativo ou array simples
		 * @param boolean $convert se vai converter para utf8
		 * @return array Um array de uma dimensão com o resultado da consulta
		 */
		public function consultaLinha($sql, $assoc=true, $convert=false) {
			$dados = $this->consulta($sql, $assoc, $convert);
			if (count($dados)>0) {
				return $dados[0];
			} else {
				return array();
			}
		}
		/**
		 * consultaCampoBlo
		 * @category retorna o primeiro campo da primeira linha de uma consulta como um blob
		 * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
		 * @copyright 2020 Casa Nova Locadora
		 * @param string $sql Uma consulta sql
		 * @return mixed O blob
		 */
		public function consultaCampoBlob($sql){
			if (!$query = ibase_query($sql)){
				trigger_error("Erro ao executar consulta: ".ibase_errmsg()."\n$sql");
				die();
			}
            if ($row = ibase_fetch_row($query)) {
                return $this->pegarCampoBlob($row[0]);
            } else {
				return false;
			}
		}

		/**
		 * consultaCampo
		 * @category retorna o primeiro campo da primeira linha de uma consulta
		 * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
		 * @copyright 2020 Casa Nova Locadora
		 * @param string $sql Uma consulta sql
		 * @param boolean $convert Se é para fazer a conversão para utf8
		 * @return mixed O valor do campo
		 */
		public function consultaCampo($sql, $convert = false){
			$dados = $this->consultaLinha($sql, false, $convert);
			if (count($dados)>0) {
				return $dados[0];
			} else {
				return null;
			}
		}
		/**
		 * atualizar
		 * @category Executa uma consulta de inclusão, alteração ou exclusão no banco de dados
		 * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
		 * @copyright 2020 Casa Nova Locadora
		 * @param string $sql A consulta sql que será executada contra o banco de dados
		 * @param string $sqlId Uma consulta sql que retornará o id da consulta caso seja uma inserção
		 * @return mixed O id da consulta caso seja uma inserção se o parâmetro $sqlId for informado
		 */
		public function atualizar($sql, $sqlId = ''){
			if (!$query = ibase_query($sql)){
				trigger_error("Erro ao executar consulta: ".ibase_errmsg()."\n".$sql."\n".$sqlId);
				die();
			}
			if ($sqlId !='') {
				return $this->consultaCampo($sqlId);
			} else {
				return true;
			}
		}
		public function atualizarBlob($sql, $data){
			$blh = ibase_blob_create($this->db);
			ibase_blob_add($blh, $data);
			$blobid = ibase_blob_close($blh);
		  	ibase_query($this->db, $sql, $blobid);
		}
    }
