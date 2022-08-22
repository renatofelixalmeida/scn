<?php

namespace Helpers;

class Validar {
    private $filtro = null;
    function __construct()
    {
        $this->filtro = new Filtro();
    }
    /**
     * cnpjCpf
     *
     * @param string $cnpjCpf
     * @return bool
     */
    public function cnpjCpf($cnpjCpf){
        if ($this->cpf($cnpjCpf)) return true;
        if ($this->cnpj($cnpjCpf)) return true;
        return false;
    }
     /**
     * cpf
     * @category Valida um número de cpf
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $cpf número do cpf podendo ou não estar formatado
     * @return bool se o cpf é valido
     */
    public function cpf($cpf){
        // Extrai somente os números
        $cpf = $this->filtro->numeros($cpf);
            
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

     /**
     * cnpj
     * @category Valida um número de cnpj
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $cpf número do cpf podendo ou não estar formatado
     * @return bool se o cpf é valido
     */
    public function cnpj($cnpj){
        $cnpj = $this->filtro->numeros($cnpj);
	
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
    
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;	
    
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;
    
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);    }   

     /**
     * telefoneCelular
     * @category Valida um número de telefone celular
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $telefone número do telefone podendo ou não estar formatado
     * @return bool se o telefone celular é valido
     */
    public function telefoneCelular($telefone){
        $telefone = $this->filtro->telefone($telefone);
        $telefone = $this->filtro->numeros($telefone);
        if (strlen($telefone)!=11) return false;
        if (substr($telefone, 2, 1) != '9') return false;
        return true;
    }

    /**
     * uf
     * validar a sigla de um estado
     */
    public function uf($uf){
        $siglas = ['AC', 'AL', 'AP', 'AM', 'BA',
        'CE', 'ES', 'DF', 'GO', 'MA',
        'MT', 'MS', 'MG', 'PA', 'PB',
        'PR', 'PE', 'PI', 'RJ', 'RN',
        'RS', 'RO', 'RR', 'SC', 'SP',
        'SE', 'TO'];
        return in_array($uf, $siglas);
    }

    /**
     * tipoPessoa
     */
    public function tipoPessoa($tipo){
        $tipo = $this->filtro->removeAcentos($tipo);
        $tipo = trim(strtoupper($tipo));
        return ($tipo == 'FISICA' || $tipo == 'JURIDICA' || $tipo == 'ESPOLIO');
    }

}