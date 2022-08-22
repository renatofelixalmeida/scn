<?php

namespace Helpers;

class Filtro {
    /**
     * numeros
     * @category retorna apenas os números em uma string
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto o texto de entrada contendo números e outros caracteres
     * @return string apenas os numeros constantes no texto de entrada
     */
    public function numeros($texto){
        return preg_replace("/[^0-9]/", "", $texto);
    }
    /**
     * telefone
     * @category Retorna um número de telefone formatado no padrão (XX) XXXX-XXXXY
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $telefone o número de telefone
     * @return string O número de telefone formatado
     */
    public function telefone($telefone){
        $tipo = 0;
        $telefone = $this->numeros($telefone);
        switch (strlen($telefone)){
            case 11:
                if ($tipo == 0) {
                    return '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 1).' '.substr($telefone, 3, 4).'-'.substr($telefone, 7, 4);
                } else {
                    return '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 1).substr($telefone, 3, 4).'-'.substr($telefone, 7, 4);
                }
            case 10:
                if (substr($telefone, 2, 1)=='9'||substr($telefone, 2, 1)=='8'||substr($telefone, 2, 1)=='7') {
                    if ($tipo == 0) {
                        return '('.substr($telefone, 0, 2).') 9 '.substr($telefone, 2, 3).'-'.substr($telefone, 5, 5);
                    } else {
                        return '('.substr($telefone, 0, 2).') 9'.substr($telefone, 2, 3).'-'.substr($telefone, 5, 5);
                    }
                } else {
                    return '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 4).'-'.substr($telefone, 6, 4);
                }
            case 9:
                if ($tipo == 0) {
                    return '(37) '.substr($telefone, 0, 1).' '.substr($telefone, 1, 4).'-'.substr($telefone, 5, 4);
                } else {
                    return '(37) '.substr($telefone, 0, 1).substr($telefone, 1, 4).'-'.substr($telefone, 5, 4);
                }
            case 8:
                if (substr($telefone, 0, 1)=='9'||substr($telefone, 0, 1)=='8'||substr($telefone, 0, 1)=='7') {
                    if ($tipo == 0) {
                        return '(37) 9 '.substr($telefone, 0, 3).'-'.substr($telefone, 3, 5);
                    } else {
                        return '(37) 9'.substr($telefone, 0, 3).'-'.substr($telefone, 3, 5);
                    }
                } else {
                    return '(37) '.substr($telefone, 0, 4).'-'.substr($telefone, 4, 5);
                }
        }
        return $telefone;
    }

    /**
     * cep
     * @category formata um número de cep no padrão xx.xxx-xxx
     * @copyright 2020 Casa Nova Locadora
     * @param string $cep o número de cep
     * @return string O número de cep formatado
     */
    public function cep($cep){
        $cep = $this->numeros($cep);
        $cep = str_pad($cep, 8, '0', STR_PAD_LEFT);
        return substr($cep, 0, 2).'.'.substr($cep, 2, 3).'-'.substr($cep, 5, 3);
    }
    /**
     * cpf
     * @category formata um numero de cpf
     * @copyright 2020 Casa Nova Locadora
     * @param string $cpf o número de cpf
     * @return string O número de cpf formatado
     */
    public function cpf($cpf){
        // limpar o cpf
        $cpf = $this->numeros($cpf);
        if ($cpf == '') return '';
        $cpf = str_pad($cpf, 11, 0, STR_PAD_LEFT);
        return substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 6, 3).'-'.substr($cpf, 9, 2);
    }
    /**
     * cnpj
     * @category formata um numero de cnpj
     * @copyright 2020 Casa Nova Locadora
     * @param string $cnpj o número de cnpj
     * @return string O número de cnpj formatado
     */
    public function cnpj($cnpj){
        // limpar o cnpj
        $cnpj = $this->numeros($cnpj);
        if ($cnpj == '') return '';
        $cnpj = str_pad($cnpj, 14, 0, STR_PAD_LEFT);
        return substr($cnpj, 0, 2).'.'.substr($cnpj, 2, 3).'.'.substr($cnpj, 5, 3).'/'.substr($cnpj, 8, 4).'-'.substr($cnpj, 12, 2);
    }
    /**
     * cpfCnpj
     * @category formata um numero de cpf ou cnpj
     * @copyright 2020 Casa Nova Locadora
     * @param string $cpfCnpj o número de cpf ou cnpj
     * @return string O número de cpf cnpj formatado
     */
    public function cnpjCpf($cpfCnpj){
        // limpar o cpfCnpj
        $cpfCnpj = $this->numeros($cpfCnpj);
        if ($cpfCnpj == '') return '';
        if (strlen($cpfCnpj)==11) return $this->cpf($cpfCnpj);
        if (strlen($cpfCnpj)==14) return $this->cnpj($cpfCnpj);
        return "";
    }

    /**
     * iniciaisMaiusculas
     * @category Retorna o texto com as iniciais em maíuscula e o restante minúscula
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto O texto a ser convertido para maiusculas
     * @return string o texto convertido
     */
	public function iniciaisMaiusculas($string) {
        $string = trim($string);
		if($string=="")
            return $string;
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
		$string = str_replace("Cpf", "CPF", $string);
		$string = str_replace("cpf", "CPF", $string);
		$string = str_replace("Cnpj", "CNPJ", $string);
		$string = str_replace("cnpj", "CNPJ", $string);
		
		$romanos = array("Ii", "Iii", "Iv", "Vi", "Vii", "Viii", "Ix", "Xi", "Xii", "Xii", "Xiv", 
                        "Xv", "Xvi", "Xvii", "Xviii", "Xix", "Xx", "Xxi", "Xxii", "Xxiii", "Xxiv", 
                        "Xxv", "Xxvi", "Xxvii");
        $string = '##  '.$string.'  ##';
		foreach($romanos as $v) {
			$string = str_replace(" ".$v." ", " ".strtoupper($v)." ", $string);
			$string = str_replace(" ".$v.",", " ".strtoupper($v).",", $string);
		}
        $preposicoes = array("De", "Do", "Da", "E", "O", "A", "Dos", "Das","Os", "As");
		foreach($preposicoes as $v) {
			$string = str_replace(" ".$v." ", " ".strtolower($v)." ", $string);
			$string = str_replace(" ".$v.",", " ".strtolower($v).",", $string);
		}
        $string = str_replace('##  ', '', $string);
        $string = str_replace('  ##', '', $string);
		return trim($string);
    }

    /**
     * iniciaisMaiusculasFrases
     * @category Retorna frases com as iniciais em maíuscula e o restante minúscula
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto O texto a ser convertido para maiusculas
     * @return string o texto convertido
     */
    public function iniciaisMaiusculasFrases($string, $frases = true) {
		$string = str_replace(".", ". ", $string);
		$string = str_replace(" ,", ", ", $string);
        if ($string=="") {
            return $string;
		}
        for ($i = 0; $i<5; $i++) {
            $string = str_replace('  ', ' ', $string);
        }

		if (!$frases) {
			$lista = [' ', '>', '.', ',', '!', '?', ';', '-'];
		} else {
			$lista = ['!', '.', '?','-','|'];
		}
		$incremento = $frases ? 2 : 1;
		$atual=0;
		$string=$string.'  ';
		$string=mb_strtolower($string);
		$string[0]=mb_strtoupper($string[0]);
		for($atual=1;$atual<strlen($string) - 1;$atual++){
			if (in_array($string[$atual], $lista)) 
				if($string[$atual+$incremento]!="d")
					$string[$atual+$incremento]=mb_strtoupper($string[$atual+$incremento]);
			else
				if(!($string[$atual+3]==" " || $string[$atual+4]==" "))
					$string[$atual+1]=mb_strtoupper($string[$atual+1]);
		}           
		$string = str_replace("Cpf", "CPF", $string);
		$string = str_replace("cpf", "CPF", $string);
		$string = str_replace("Cnpj", "CNPJ", $string);
		$string = str_replace("cnpj", "CNPJ", $string);
		
		$romanos = array("Ii", "Iii", "Iv", "Vi", "Vii", "Viii", "Ix", "Xi", "Xii", "Xii", "Xiv", "Xv", "Xvi", "Xvii", "Xviii", "Xix", "Xx", "Xxi", "Xxii", "Xxiii", "Xxiv", "Xxv", "Xxvi", "Xxvii");
		foreach($romanos as $v) {
			$string = str_replace(" ".$v." ", " ".strtoupper($v)." ", $string);
			$string = str_replace(" ".$v.",", " ".strtoupper($v).",", $string);
		}
		return $string;
	}
    
    /**
     * removeAcentos
     * @category Remover os caracteres acentuados das palavras
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto Texto com acentos e caracteres especiais
     * @return string Texto sem acentos ou caracteres especiais
     */
    public function removeAcentos($texto){
        if ($texto=='') return '';
        $acentos = array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/",
                        "/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/");
        $letras = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u','U', 'n', 'N', 'c', 'C');
        return preg_replace($acentos, $letras, $texto);
    }    
    /**
     * maiusculas
     * @category Colocar todos os caracteres em maiúsculas
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto Texto 
     * @return string Texto em maíusculas
     */
    public function maiusculas($texto){
        return strtoupper($texto);
    }
    /**
     * minusculas
     * @category Colocar todos os caracteres em minusculas
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto Texto 
     * @return string Texto em minusculas
     */
    public function minusculas($texto){
        return strtolower($texto);
    }
    /**
     * DDMMYYYY
     * @category Formata a data para o formato brasileiro
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $data a data 
     * @return string Texto data formatada
     */
    public function DDMMYYYY($data){
        return date('d/m/Y', strtotime($data));
    }
    /**
     * HHMMSS
     * @category Formata a hora para o formato brasileiro
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $hora a hora
     * @return string Texto hora formatada
     */
    public function HHMMSS($hora){
        return date('H:i:s', strtotime($hora));
    }
    /**
     * HHMM
     * @category Formata a hora para o formato brasileiro
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $hora a hora
     * @return string Texto hora formatada
     */
    public function HHMM($hora){
        return date('H:i', strtotime($hora));
    }
    /**
     * DDMMYYYYHHMMSS
     * @category Formata a data para o formato brasileiro
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $dataHora a data e hora
     * @return string Texto dataHora formatada
     */
    public function DDMMYYYYHHMMSS($dataHora){
        return date('d/m/Y H:i:s', strtotime($dataHora));
    }
    /**
     * DDMMYYYYHHMM
     * @category Formata a data para o formato brasileiro
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $dataHora a data e hora
     * @return string Texto dataHora formatada
     */
    public function DDMMYYYYHHMM($dataHora){
        return date('d/m/Y H:i', strtotime($dataHora));
    }

    /**
     * tipoPessoa
     */
    public function tipoPessoaEntrada($tipo){
        $tipo = $this->removeAcentos($tipo);
        $tipo = trim(strtoupper($tipo));
        return $tipo;
    }

    /**
     * tipoPessoa
     */
    public function tipoPessoaSaida($tipo){
        $tipo = $this->removeAcentos($tipo);
        $tipo = trim(strtoupper($tipo));
        if ($tipo == 'FISICA') return 'Física';
        if ($tipo == 'JURIDICA') return 'Jurídica';
        if ($tipo == 'ESPOLIO') return 'Espólio';
        return $tipo;
    }   
}