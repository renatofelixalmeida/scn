<?php
/**
 * Formatar
 * @category Funcões para formatação de texto, funcões estáticas apenas
 * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
 * @copyright 2020 Casa Nova Locadora
 */

class Formatar{
    /**
     * itensImovel
     * @category retorna um item formatado para o campo e valor informados
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param array $dados um array associativo com os nomes e valores
     * @param int $quantidade a quantidade máxima de itens
     * @param string $destinacao a destinação do imóvel
     * @return string Os itens formatados
     */
    public static function itensImovel($imovel, $quantidade ){
        $prioritario = $quantidade <= 6;
        $passadas = $prioritario ? 2 : 1;
        
        if (!isset($imovel['TIPO_IMOV'])) return;
        //echo $imovel['TIPO_IMOV'];
        //exit;
        // configuração dos itens, a ordem é relevante
        if ($imovel['TIPO_IMOV'] == 'ANDAR' || $imovel['TIPO_IMOV'] == 'Sala') {
            $itens = [
                'AREA' => ['ICONE' => 'fas fa-ruler-combined', 'TITULO_SINGULAR' => 'm²', 'TITULO_PLURAL' => 'm²', 'TIPO' => 0, 'PRIORITARIO' => false],
                'NUM_SALAS' => ['ICONE' => 'fas fa-tv', 'TITULO_SINGULAR' => 'Sala', 'TITULO_PLURAL' => 'Salas', 'TIPO' => 0, 'PRIORITARIO' => false],
                'NUM_BANHOS' => ['ICONE' => 'fas fa-toilet', 'TITULO_SINGULAR' => 'Banho', 'TITULO_PLURAL' => 'Banhos', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_ELEVADOR' => ['ICONE' => 'fas fa-sort-amount-up-alt', 'TITULO_SINGULAR' => 'Com elevador',  'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_HORAS_PORTEIRO' => ['ICONE' => 'fas fa-user-tie', 'TITULO_SINGULAR' => 'Tem porteiro',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_INTERFONE' => ['ICONE' => 'fas fa-user-secret', 'TITULO_SINGULAR' => 'Vigilância',  'TIPO' => 1, 'PRIORITARIO' => false]
            ];
        } else if ($imovel['TIPO_IMOV'] == 'COBERTURA' || $imovel['TIPO_IMOV'] == 'APTO.' || 
                   $imovel['TIPO_IMOV'] == 'FLAT' || $imovel['TIPO_IMOV'] == 'KITCHENT' || 
                   $imovel['TIPO_IMOV'] == 'BARRACAO' || $imovel['TIPO_IMOV'] == 'SITIO') {
            $itens = [
                'AREA' => ['ICONE' => 'fas fa-ruler-combined', 'TITULO_SINGULAR' => 'm²', 'TITULO_PLURAL' => 'm²', 'TIPO' => 0, 'PRIORITARIO' => false],
                'NUM_QUARTOS' => ['ICONE' => 'fas fa-bed topo5px', 'TITULO_SINGULAR' => 'Quarto', 'TITULO_PLURAL' => 'Quartos', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_SUITES' => ['ICONE' => 'fas fa-shower', 'TITULO_SINGULAR' => 'Suite', 'TITULO_PLURAL' => 'Suites', 'TIPO' => 0, 'PRIORITARIO' => true],                
                'NUM_ARM_QUARTO' => ['ICONE' => 'fas fa-archive', 'TITULO_SINGULAR' => 'Armário no quarto', 'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_VAR_QUARTO' => ['ICONE' => 'fas fa-diagnoses', 'TITULO_SINGULAR' => 'Varanda no quarto', 'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_SALAS' => ['ICONE' => 'fas fa-tv', 'TITULO_SINGULAR' => 'Sala', 'TITULO_PLURAL' => 'Salas', 'TIPO' => 0, 'PRIORITARIO' => false],
                'NUM_VAR_SALA' => ['ICONE' => 'fas fa-diagnoses', 'TITULO_SINGULAR' => 'Varanda na sala', 'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_BANHOS' => ['ICONE' => 'fas fa-toilet', 'TITULO_SINGULAR' => 'Banho', 'TITULO_PLURAL' => 'Banhos', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_BOXES' => ['ICONE' => 'far fa-square', 'TITULO_SINGULAR' => 'Box no banho',  'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_ARM_BANHO' => ['ICONE' => 'fas fa-archive', 'TITULO_SINGULAR' => 'Armário no banho', 'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_ARM_COZINHA' => ['ICONE' => 'fas fa-archive', 'TITULO_SINGULAR' => 'Armário na cozinha', 'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_DCE' => ['ICONE' => 'fas fa-quidditch', 'TITULO_SINGULAR' => 'DCE',  'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_VAGAS' => ['ICONE' => 'fas fa-car', 'TITULO_SINGULAR' => 'Vaga', 'TITULO_PLURAL' => 'Vagas', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_ELEVADOR' => ['ICONE' => 'fas fa-sort-amount-up-alt', 'TITULO_SINGULAR' => 'Com elevador',  'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_HORAS_PORTEIRO' => ['ICONE' => 'fas fa-user-tie', 'TITULO_SINGULAR' => 'Tem porteiro',  'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_APTO_ANDAR' => ['ICONE' => 'fas fa-toilet', 'TITULO_SINGULAR' => 'Apto/Andar', 'TITULO_PLURAL' => 'Apto/Andar', 'TIPO' => 0, 'PRIORITARIO' => false],
                'NUM_PAVIMENTOS' => ['ICONE' => 'far fa-building', 'TITULO_SINGULAR' => 'Pavimento', 'TITULO_PLURAL' => 'Pavimentos', 'TIPO' => 0, 'PRIORITARIO' => false],
                'TEM_GAS' => ['ICONE' => 'fas fa-burn', 'TITULO_SINGULAR' => 'Gás canalizado',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_PORTAO_ELETRICO' => ['ICONE' => 'fas fa-warehouse', 'TITULO_SINGULAR' => 'Portão Eletrônico',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_PLAYGROUND' => ['ICONE' => 'fas fa-child', 'TITULO_SINGULAR' => 'Playground',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_PISCINA' => ['ICONE' => 'fas fa-swimmer', 'TITULO_SINGULAR' => 'Piscina',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_SAUNA' => ['ICONE' => 'fas fa-hot-tub', 'TITULO_SINGULAR' => 'Sauna',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_SALAO_FESTA' => ['ICONE' => 'fas fa-glass-cheers', 'TITULO_SINGULAR' => 'Salão de festa',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_SALAO_JOGOS' => ['ICONE' => 'fas fa-gamepad', 'TITULO_SINGULAR' => 'Salão de jogos',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_CHURRASCO' => ['ICONE' => 'fas fa-drumstick-bite', 'TITULO_SINGULAR' => 'Churrasqueira',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_QUADRA' => ['ICONE' => 'fas fa-futbol', 'TITULO_SINGULAR' => 'Quadra',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_INTERFONE' => ['ICONE' => 'fas fa-phone-volume', 'TITULO_SINGULAR' => 'Interfone',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_AREA_SERVICO' => ['ICONE' => 'fas fa-soap', 'TITULO_SINGULAR' => 'DCE',  'TIPO' => 1, 'PRIORITARIO' => false],
            ];   
        } else if ($imovel['TIPO_IMOV'] == 'Área' || $imovel['TIPO_IMOV'] == 'Lote') {
            $itens = [
                'AREA' => ['ICONE' => 'fas fa-ruler-combined', 'TITULO_SINGULAR' => 'm²', 'TITULO_PLURAL' => 'm²', 'TIPO' => 0, 'PRIORITARIO' => true],
                'TEM_DCE' => ['ICONE' => 'fas fa-bars', 'TITULO_SINGULAR' => 'm²', 'TITULO_PLURAL' => 'Com muro/cerca', 'TIPO' => 1, 'PRIORITARIO' => true]
            ]; 
        } else if ($imovel['TIPO_IMOV'] == 'Galpão') {
            $itens = [
                'AREA' => ['ICONE' => 'fas fa-ruler-combined', 'TITULO_SINGULAR' => 'm²', 'TITULO_PLURAL' => 'm²', 'TIPO' => 0, 'PRIORITARIO' => true],
                'AREA2' => ['ICONE' => 'fas fa-chart-area', 'TITULO_SINGULAR' => 'm² terreno', 'TITULO_PLURAL' => 'm² terreno', 'TIPO' => 0, 'PRIORITARIO' => true],
                'PE_DIREITO' => ['ICONE' => 'fas fa-long-arrow-alt-up', 'TITULO_SINGULAR' => 'm² pé direito', 'TITULO_PLURAL' => 'm² pé direito', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_QUARTOS' => ['ICONE' => 'fas fa-arrows-alt-h', 'TITULO_SINGULAR' => 'm² frente', 'TITULO_PLURAL' => 'm² frente', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_SUITES' => ['ICONE' => 'fas fa-arrows-alt-v', 'TITULO_SINGULAR' => 'm² fundo', 'TITULO_PLURAL' => 'm² fundo', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_SALAS' => ['ICONE' => 'fas fa-maker', 'TITULO_SINGULAR' => 'Escritório', 'TITULO_PLURAL' => 'Escritórios', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_COZINHAS' => ['ICONE' => 'fas fa-sink', 'TITULO_SINGULAR' => 'Cozinha', 'TITULO_PLURAL' => 'Cozinhas', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_BANHOS' => ['ICONE' => 'fas fa-toilet', 'TITULO_SINGULAR' => 'Banho', 'TITULO_PLURAL' => 'Banhos', 'TIPO' => 0, 'PRIORITARIO' => true],
                'TEM_CHURRASCO' => ['ICONE' => 'fas fa-truck', 'TITULO_SINGULAR' => 'Ent. Caminhão',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_MOBILIA' => ['ICONE' => 'fas fa-archway', 'TITULO_SINGULAR' => 'Estrutura',  'TIPO' => 1, 'PRIORITARIO' => false],
            ];
        } else if ($imovel['TIPO_IMOV'] == 'Loja') {
            $itens = [
                'AREA' => ['ICONE' => 'fas fa-ruler-combined', 'TITULO_SINGULAR' => 'm²', 'TITULO_PLURAL' => 'm²', 'TIPO' => 0, 'PRIORITARIO' => true],
                'AREA2' => ['ICONE' => 'fas fa-chart-area', 'TITULO_SINGULAR' => 'm² sobreloja', 'TITULO_PLURAL' => 'm² sobreloja', 'TIPO' => 0, 'PRIORITARIO' => true],
                'PE_DIREITO' => ['ICONE' => 'fas fa-long-arrow-alt-up', 'TITULO_SINGULAR' => 'm² pé direito', 'TITULO_PLURAL' => 'm² pé direito', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_QUARTOS' => ['ICONE' => 'fas fa-arrows-alt-h', 'TITULO_SINGULAR' => 'm² frente', 'TITULO_PLURAL' => 'm² frente', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_SUITES' => ['ICONE' => 'fas fa-arrows-alt-v', 'TITULO_SINGULAR' => 'm² fundo', 'TITULO_PLURAL' => 'm² fundo', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_SALAS' => ['ICONE' => 'fas fa-maker', 'TITULO_SINGULAR' => 'Escritório', 'TITULO_PLURAL' => 'Escritórios', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_COZINHAS' => ['ICONE' => 'fas fa-sink', 'TITULO_SINGULAR' => 'Cozinha', 'TITULO_PLURAL' => 'Cozinhas', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_BANHOS' => ['ICONE' => 'fas fa-toilet', 'TITULO_SINGULAR' => 'Banho', 'TITULO_PLURAL' => 'Banhos', 'TIPO' => 0, 'PRIORITARIO' => true],
                'TEM_CHURRASCO' => ['ICONE' => 'fas fa-truck', 'TITULO_SINGULAR' => 'Ent. Caminhão',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_MOBILIA' => ['ICONE' => 'fas fa-archway', 'TITULO_SINGULAR' => 'Estrutura',  'TIPO' => 1, 'PRIORITARIO' => false],
                'EM_CONDOMINIO' => ['ICONE' => 'fas fa-warehouse', 'TITULO_SINGULAR' => 'Galeria',  'TIPO' => 1, 'PRIORITARIO' => false]
            ];            
        } else  {
            $itens = [
                'AREA' => ['ICONE' => 'fas fa-ruler-combined', 'TITULO_SINGULAR' => 'm²', 'TITULO_PLURAL' => 'm²', 'TIPO' => 0, 'PRIORITARIO' => false],
                'PE_DIREITO' => ['ICONE' => 'fas fa-arrows-alt-v', 'TITULO_SINGULAR' => 'm² pé direito', 'TITULO_PLURAL' => 'm² pé direito', 'TIPO' => 0, 'PRIORITARIO' => false],
                'NUM_QUARTOS' => ['ICONE' => 'fas fa-bed topo5px', 'TITULO_SINGULAR' => 'Quarto', 'TITULO_PLURAL' => 'Quartos', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_ARM_QUARTO' => ['ICONE' => 'fas fa-archive', 'TITULO_SINGULAR' => 'Armário no quarto', 'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_VAR_QUARTO' => ['ICONE' => 'fas fa-diagnoses', 'TITULO_SINGULAR' => 'Varanda no quarto', 'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_SALAS' => ['ICONE' => 'fas fa-tv', 'TITULO_SINGULAR' => 'Sala', 'TITULO_PLURAL' => 'Salas', 'TIPO' => 0, 'PRIORITARIO' => false],
                'NUM_VAR_SALA' => ['ICONE' => 'fas fa-diagnoses', 'TITULO_SINGULAR' => 'Varanda na sala', 'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_SUITES' => ['ICONE' => 'fas fa-shower', 'TITULO_SINGULAR' => 'Suite', 'TITULO_PLURAL' => 'Suites', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_BANHOS' => ['ICONE' => 'fas fa-toilet', 'TITULO_SINGULAR' => 'Banho', 'TITULO_PLURAL' => 'Banhos', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_BOXES' => ['ICONE' => 'far fa-square', 'TITULO_SINGULAR' => 'Box no banho',  'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_ARM_BANHO' => ['ICONE' => 'fas fa-archive', 'TITULO_SINGULAR' => 'Armário no banho', 'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_ARM_COZINHA' => ['ICONE' => 'fas fa-archive', 'TITULO_SINGULAR' => 'Armário na cozinha', 'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_VAGAS' => ['ICONE' => 'fas fa-car', 'TITULO_SINGULAR' => 'Vaga', 'TITULO_PLURAL' => 'Vagas', 'TIPO' => 0, 'PRIORITARIO' => true],
                'NUM_ELEVADOR' => ['ICONE' => 'fas fa-sort-amount-up-alt', 'TITULO_SINGULAR' => 'Com elevador',  'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_HORAS_PORTEIRO' => ['ICONE' => 'fas fa-user-tie', 'TITULO_SINGULAR' => 'Tem porteiro',  'TIPO' => 1, 'PRIORITARIO' => false],
                'NUM_APTO_ANDAR' => ['ICONE' => 'fas fa-toilet', 'TITULO_SINGULAR' => 'Apto/Andar', 'TITULO_PLURAL' => 'Apto/Andar', 'TIPO' => 0, 'PRIORITARIO' => false],
                'NUM_PAVIMENTOS' => ['ICONE' => 'far fa-building', 'TITULO_SINGULAR' => 'Pavimento', 'TITULO_PLURAL' => 'Pavimentos', 'TIPO' => 0, 'PRIORITARIO' => false],
                'TEM_GAS' => ['ICONE' => 'fas fa-burn', 'TITULO_SINGULAR' => 'Gás canalizado',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_PORTAO_ELETRICO' => ['ICONE' => 'fas fa-warehouse', 'TITULO_SINGULAR' => 'Portão Eletrônico',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_PLAYGROUND' => ['ICONE' => 'fas fa-child', 'TITULO_SINGULAR' => 'Playground',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_PISCINA' => ['ICONE' => 'fas fa-swimmer', 'TITULO_SINGULAR' => 'Piscina',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_SAUNA' => ['ICONE' => 'fas fa-hot-tub', 'TITULO_SINGULAR' => 'Sauna',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_SALAO_FESTA' => ['ICONE' => 'fas fa-glass-cheers', 'TITULO_SINGULAR' => 'Salão de festa',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_SALAO_JOGOS' => ['ICONE' => 'fas fa-gamepad', 'TITULO_SINGULAR' => 'Salão de jogos',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_CHURRASCO' => ['ICONE' => 'fas fa-drumstick-bite', 'TITULO_SINGULAR' => 'Churrasqueira',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_QUADRA' => ['ICONE' => 'fas fa-futbol', 'TITULO_SINGULAR' => 'Quadra',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_INTERFONE' => ['ICONE' => 'fas fa-phone-volume', 'TITULO_SINGULAR' => 'Interfone',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_DCE' => ['ICONE' => 'fas fa-quidditch', 'TITULO_SINGULAR' => 'DCE',  'TIPO' => 1, 'PRIORITARIO' => false],
                'TEM_AREA_SERVICO' => ['ICONE' => 'fas fa-soap', 'TITULO_SINGULAR' => 'DCE',  'TIPO' => 1, 'PRIORITARIO' => false],
            ];   
        } 
        // preparar os itens
        foreach ($itens as $c => $v) {
            if (isset($imovel[$c])) {
                $itens[$c]['VALOR'] = $imovel[$c];
            }
        }

        // montar os itens
        $total = 0;
        $saida = '<ul class="imovelItens">';
        for ($i = 0; $i < $passadas; $i++) {
            if ($total >= $quantidade) {
                break;
            }
            foreach ($itens as $v) {
                if ($total >= $quantidade) {
                    break;
                }
                if ($prioritario && $i == 0 && !$v['PRIORITARIO']) continue;
                if ($prioritario && $i == 1 && $v['PRIORITARIO']) continue;
                if (isset($v['VALOR']) && ($v['VALOR'] > 0 || $v['VALOR'] == 'S')) {
                    if ($v['TIPO'] == 0) {
                        $titulo = $v['VALOR'] == 1 || $v['VALOR'] == 'S'  ? $v['TITULO_SINGULAR'] : $v['TITULO_PLURAL'] ;
                        $titulo = $v['VALOR'] . ' '. $titulo;
                    } else {
                        $titulo = $v['TITULO_SINGULAR'];
                    }
                    
                    $icone = $v['ICONE'];
                    $saida .= "<li class='espacamento'><i class=\"{$icone} corPadrao\"></i><span>{$titulo}</span></li>";
                    $total++;
                }
            }
        }
        if ($prioritario && $total < $quantidade) {
            for ($i = $quantidade; $i <= $total; $i++ ) {
                $saida .= "<li class='espacamento'><span>&nbsp;</span></li>";
            }
        }
        $saida .= "</ul>";
        return $saida;
    }

    /**
     * telefone
     * @category Retorna um número de telefone formatado no padrão (XX) XXXX-XXXXY
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $telefone o número de telefone
     * @return string O número de telefone formatado
     */
    public static function telefone($telefone){
        $telefone = Texto::numeros($telefone);
        switch (strlen($telefone)){
            case 11:
                return '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 1).' '.substr($telefone, 3, 4).'-'.substr($telefone, 7, 4);
            case 10:
                if (substr($telefone, 2, 1)=='9'||substr($telefone, 2, 1)=='8'||substr($telefone, 2, 1)=='7') {
                    return '('.substr($telefone, 0, 2).') 9 '.substr($telefone, 2, 3).'-'.substr($telefone, 5, 5);
                } else {
                    return '('.substr($telefone, 0, 2).') '.substr($telefone, 2, 4).'-'.substr($telefone, 6, 4);
                }
            case 9:
                return '(37) '.substr($telefone, 0, 1).' '.substr($telefone, 1, 4).'-'.substr($telefone, 5, 4);
            case 8:
                if (substr($telefone, 0, 1)=='9'||substr($telefone, 0, 1)=='8'||substr($telefone, 0, 1)=='7') {
                    return '(37) 9 '.substr($telefone, 0, 3).'-'.substr($telefone, 3, 5);
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
    public static function cep($cep){
        $cep = Texto::numeros($cep);
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
    public static function cpf($cpf){
        // limpar o cpf
        $cpf = Texto::numeros($cpf);
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
    public static function cnpj($cnpj){
        // limpar o cnpj
        $cnpj = Texto::numeros($cnpj);
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
    public static function cpfCnpj($cpfCnpj){
        // limpar o cpfCnpj
        $cpfCnpj = Texto::numeros($cpfCnpj);
        if ($cpfCnpj == '') return '';
        if (strlen($cpfCnpj)==11) return Formatar::cpf($cpfCnpj);
        if (strlen($cpfCnpj)==14) return Formatar::cnpj($cpfCnpj);
        return "";
    }
    /**
     * moeda
     * @category Formata um número no padrão de moeda para o Brasil
     * @copyright 2020 Casa Nova Locadora
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @param float $valor o valor a ser formatado
     * @return string o valor formatado
     */
    public static function moeda($valor) {
        return number_format($valor, 2, ',', '.');
    }
    /**
     * valorReduzido
     * @category Formata um número no padrão de moeda para o Brasil
     * @copyright 2020 Casa Nova Locadora
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @param float $valor o valor a ser formatado
     * @return string o valor formatado
     */
    public static function valorReduzido($valor) {
        if ($valor > 1000000) {
            if ($valor == 1) {
                return "1 Milhão";
            } else {
                return rtrim(number_format($valor / 1000000, 3, ',', '.'), '0')." milhões";
            }
        } else if ($valor == 1000000){
            return "1 Milhão";
		} else if ($valor >= 30000) {
            if ($valor % 1000 == 0) {
                return ($valor / 1000)." mil";
            } else {
                return rtrim(number_format($valor / 1000, 3, ',', '.'), '0')." mil";
            }
			$valor = intval($valor / 1000);
			return "$valor mil";
		} else {
			return number_format($valor, 2, ',', '.');
		}
    }	
    /**
     * rg
     * @category formata um numero de rg
     * @copyright 2020 Casa Nova Locadora
     * @param string $rg o número de rg
     * @return string O número de rg formatado
     */
    public static function rg($rg){
        // limpar o rg
        $rg = Texto::numeros($rg);
        // formatar como número inteiro
        return number_format($rg, 0, '', '.');
    }
    /**
     * bancoDataHora
     * @category formata uma data e hora que vem do banco de dados
     * @copyright 2020 Casa Nova Locadora
     * @param string $dataHora a data e hora que vem do do banco de dados
     * @return string a data e hora formatadas
     */
    public static function bancoDataHora($dataHora){
        return date('d/m/Y H:i', strtotime($dataHora));
    }
    /**
     * bancoData
     * @category formata uma hora que vem do banco de dados
     * @copyright 2020 Casa Nova Locadora
     * @param string $dataHora a data e hora que vem do do banco de dados
     * @return string a data formatada
     */
    public static function bancoData($dataHora){
        if ($dataHora==null||$dataHora=='') return '';
        return date('d/m/Y', strtotime($dataHora));
    }
    /**
     * dataReduzida
     * @category formata uma data que vem do banco de dados
     * @copyright 2020 Casa Nova Locadora
     * @param string $dataHora a data com ano de dois digitos
     * @return string a data formatada
     */
    public static function dataReduzida($dataHora){
        $campos = explode('/', $dataHora);
        if (count($campos)!=3) return '';
        return $campos[0].'/'.$campos[1].'/'.substr($campos[2], 2, 2);
    }
    /**
     * bancoHora
     * @category formata uma  hora que vem do banco de dados
     * @copyright 2020 Casa Nova Locadora
     * @param string $dataHora a data e hora que vem do do banco de dados
     * @return string a hora formatada
     */
    public static function bancoHora($dataHora){
        return date('H:i', strtotime($dataHora));
    }
    /**
     * dataBanco
     * @category formata uma hora que vai para o banco de dados
     * @copyright 2020 Casa Nova Locadora
     * @param string $dataHora a data e hora que vai para o banco de dados
     * @return string a data formatada
     */
    public static function dataBanco($dataHora){
        $data = explode(' ', $dataHora)[0];
        $data = explode('/', $data);
        if (count($data)>2) {
            return $data[2].'-'.$data[1].'-'.$data[0];
        } else {
            $dataHora;
        }
    }
    /**
     * dataHoraPHP
     * @category formata uma data e hora que para o formato php
     * @copyright 2020 Casa Nova Locadora
     * @param string $dataHora a data e hora que vai para o formato php
     * @return string a data e horaformatada
     */
    public static function dataHoraPHP($dataHora){
        $data = Formatar::dataBanco($dataHora);
        $hora = explode(' ', $dataHora);
        if (count($hora)>1) {
            return "$data $hora";
        } else {
            return "$data";
        }
    }
    /**
     * destinacao
     * @category converte um código de destinação para um texto amigável
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova 
     * @param string $destinacao código do destinação de imóvel
     * @return string destinação de imóvel com um texto amigável
     */
    public static function genero($texto, $genero, $padrao = array('pronto(a)', 'Consultor(a)', 'consultor(a)', 'O(a)','o(a)'), $masculino = array('pronto','Consultor', 'consultor', 'O', 'o'), $feminino = array('pronta','Consultora', 'consultora', 'A', 'a')){
        if ($genero=='M') {
            return str_replace($padrao, $masculino, $texto);
        } else if ($genero=='F'){
            return str_replace($padrao, $feminino, $texto);
        } else {
            return $texto;
        }
    }
    /**
     * genero
     * @category converte um texto para masculino ou feminino
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova 
     * @param string $texto textod e entrada
     * @param string $genero M=masculino, F=feminino, null não altera o texto
     * @param array $padrao array com as palavras padrão para converter
     * @param array $masculino array com as palavras em masculino
     * @param array $feminino array com as palavras em feminino
     * @return string texto convertido para o formado desejado
     */
    public static function destinacao($destinacao){
        return Texto::iniciaisMaiusculas($destinacao);
    }
    /**
     * tipoImovel
     * @category converte um código de imóvel para um texto amigável
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova 
     * @param string $tipo código do tipo de imóvel
     * @return string tipo de imóvel com um texto amigável
     */
    public static function tipoImovel($tipo){
		if ($tipo=="CASA COND.") return "Casa em condomínio";
		if ($tipo=="APTO.") return "Apartamento";
		if ($tipo=="AREA") return "Área";
		if ($tipo=="BARRACÃO") return "Barracão";
		if ($tipo=="CHALÉ") return "Chale";
		if ($tipo=="GALPÃO") return "Galpão";
		if ($tipo=="GALPAO") return "Galpão";
		if ($tipo=="KITCHENETE") return "Kitnet";
        return Texto::iniciaisMaiusculas($tipo);
    }
    /**
     * cidade
     * @category Pega o código da cidade no banco de dados e converte para um nome amigavel
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova 
     * @param string $cidade o código da cidade conforme consta no banco de dados
     * @return string O texto amigável da cidade
     */
    public static function cidade($cidade){
		if ($cidade=="DIVINOPOLIS") return "Divinópolis";
		if ($cidade=="MARILANDIA") return "Marilândia";
		if ($cidade=="PARA DE MINAS") return "Pará de Minas";
		if ($cidade=="SANTO ANTONIO DO MON") return "Santo Antônio do Monte";
		if ($cidade=="SAO GONCALO DO PARA") return "São Gonçalo do Pará";
		if ($cidade=="SAO JOSE SALGADOS") return "São José dos Salgados";
		if ($cidade=="SAO SEBASTIAO OESTE") return "São Sebastião do Oeste";
		if ($cidade=="STO. ANT. DOS CAMPOS") return "Santo Antônio dos Campos";
        if ($cidade=="CLAUDIO") return "Cláudio";
        return Texto::iniciaisMaiusculas($cidade);
    }
    /**
     * bairro
     * @category Pega o código do bairro no banco de dados e converte para um nome amigavel
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova 
     * @param string $bairro o código do bairro conforme consta no banco de dados
     * @return string O texto amigável do bairro
     */
    public static function bairro($bairro){
		if ($bairro=="ANTONIO FONSECA") return "Antônio Fonseca";
		if ($bairro=="CACOCO") return "Cacôco";
		if ($bairro=="CACOCO DO MEIO") return "Cacôco do Meio";
		if ($bairro=="CANDELARIA") return "Candelária";
		if ($bairro=="CANDIDES") return "Candidés";
		if ($bairro=="CATALAO") return "Catalão";
		if ($bairro=="CHACARAS CAMPO GRAND") return "Cácaras Campo Grande";
		if ($bairro=="CORREGO DO PAIOL") return "Córrego do Paiol";
		if ($bairro=="DOM PEDRO II") return "Dom Pedro II";
		if ($bairro=="ENT.P/CACHOERINHA") return "Ent. p/ Cachoeirinha";
		if ($bairro=="ESPIRITO SANTO") return "Espírito Santo";
		if ($bairro=="FUNCIONARIOS") return "Funcionários";
		if ($bairro=="GRAJAU") return "Grajaú";
		if ($bairro=="ICARAI") return "Icaraí";
		if ($bairro=="ITAI") return "Itaí";
		if ($bairro=="J. A. GONÇALVES") return "J. A. Gonaçalves";
		if ($bairro=="J. A. GONCALVES") return "J. A. Gonaçalves";
		if ($bairro=="JARDIM DAS ACACIAS") return "Jardim das Acácias";
		if ($bairro=="JARDIM DAS MANSOES") return "Jardim das Mansões";
		if ($bairro=="JARDINOPOLIS") return "Jardinópolis";
		if ($bairro=="JOAO PAULO SEGUNDO") return "João Paulo II";
		if ($bairro=="MARAJO") return "Marajó";
		if ($bairro=="MARIA PECANHA") return "Maria Peçanha";
		if ($bairro=="MARILANDIA") return "Marilândia";
		if ($bairro=="NACOES") return "Nações";
		if ($bairro=="NITEROI") return "Niterói";
		if ($bairro=="NOSSA S DA CONCEICAO") return "Nossa Sra. da Conceição";
		if ($bairro=="NOSSA SRA APARECIDA") return "Nossa Sra. da Aparecida";
		if ($bairro=="NOSSA SRA DAS GRACAS") return "Nossa Sra. das Graças";
		if ($bairro=="NOSSA SRA DE LOURDES") return "Nossa Sra. de Lourdes";
		if ($bairro=="NOVO PARAISO") return "Novo Paraíso";
		if ($bairro=="PADRE EUSTAQUIO") return "Padre Eustáquio";
		if ($bairro=="PADRE LIBERIO") return "Padre Libério";
		if ($bairro=="PARAISO") return "Paraíso";
		if ($bairro=="PROLONGAMENTO NACOES") return "Prol. Nações";
		if ($bairro=="RES. FONTE BOA") return "Resid. Fonte Boa";
		if ($bairro=="SAGRADA FAMILIA") return "Sagrada Família";
		if ($bairro=="SANTA EUGENIA ") return "Santa Eugênia";
		if ($bairro=="SANTA LUCIA") return "Santa Lúcia";
		if ($bairro=="SANTO ANDRE") return "Santo André";
		if ($bairro=="SANTO ANT DOS CAMPO") return "Santo Antônio dos Campos";
		if ($bairro=="SANTO ANTONIO") return "Santo Antônio";
		if ($bairro=="SAO BENTO") return "São Bento";
		if ($bairro=="SAO CAETANO") return "São Caetano";
		if ($bairro=="SAO FRANCISCO") return "São Francisco";
		if ($bairro=="SAO GERALDO") return "São Geraldo";
		if ($bairro=="SAO JOAO DE DEUS") return "São João de Deus";
		if ($bairro=="SAO JOSE") return "São José";
		if ($bairro=="SAO JOSE SALGADOS") return "São José dos Salgados";
		if ($bairro=="SAO JUDAS") return "São Judas";
		if ($bairro=="SAO JUDAS TADEU") return "São Judas Tadeu";
		if ($bairro=="SAO LUCAS") return "São Lucas";
		if ($bairro=="SAO LUIZ") return "São Luiz";
		if ($bairro=="SAO MIGUEL") return "São Miguel";
		if ($bairro=="SAO ROQUE") return "São Roque";
		if ($bairro=="SAO SEBASTIAO") return "São Sebastião";
		if ($bairro=="SAO SIMAO") return "São Simão";
		if ($bairro=="TIETE") return "Tietê";
		if ($bairro=="TRES BARRAS") return "Três Barras";
		if ($bairro=="UNIVERSITARIO") return "Universitário";
		if ($bairro=="VILAGE III") return "Village III";
		if ($bairro=="VITORIA") return "Vitória";
		if ($bairro=="VIVENDAS DA EXPOSICA") return "Vivendas da Exposição";	
		if ($bairro=="BELVEDERE II") return "Belvedere II";
		if ($bairro=="DANILO PASSOS II") return "Danilo Passos II";
        return Texto::iniciaisMaiusculas($bairro);
    }

}