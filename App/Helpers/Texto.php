<?php
namespace Helpers;
/**
 * Texto
 * @category Funcões para tratamento de texto, funcões estáticas apenas
 * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
 * @copyright 2020 Casa Nova Locadora
 */

class Texto{
    /**
     * parteNome
     * @category Retorna apenas parte de um nome completo
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $nome O nome a ser utilizado
     * @param int $partes Quanta partes do nome serão utilizadas
     * @return string O nome alterado
     */
    public static function parteNome($nome, $partes = 2){
        $ignorar = array('das', 'dos');
        if ($nome=='') return '';
        if ($partes<1) return '';
        // explodir o nome para pegar as partes
        $pnome = explode(' ', $nome);
        // iteragir pelo nome para retornar as partes
        $cont = 0;
        $saida = '';
        $espaco = '';
        for ($i=0;$i<count($pnome);$i++){
            // evitar pegar as preposições de do da etc...
            if (strlen($pnome[$i])<3) continue;
            if (in_array($pnome, $ignorar)) continue;
            // montar a saída
            $saida.=$espaco.$pnome[$i];
            $cont++;
            if ($cont>=$partes) {
                break;
            }
            // definir o espaço
            $espaco=' ';
        }
        return $saida;
    }
    /**
     * optionsSelectMultiplo
     * @category Retorna uma lista de options para select
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string O texto no formato type|nome|classe|titulo1|valor1|selecionado1
     * @return string a lista de opções
     */
    public static function optionsSelectMultiplo($texto) {
        $id = 'id_'.rand(1,99999);
        $opcoes = explode(';', $texto);
        $saida = '';
        $i = 0;
        foreach($opcoes as $opcao) {
            $i++;
            $ide = $id.$i;
            $item = explode('|', $opcao);
            if (count($item) != 6) continue;
            $saida .= "
            <a href=\"#\">
                <div class=\"form-check\">
                    <input class=\"form-check-input gravarCookie {$item[2]}\" type=\"{$item[0]}\" name=\"{$item[1]}\" value=\"{$item[4]}\" {$item[5]} id=\"{$ide}\">
                    <label class=\"form-check-label preenchimentoTotal\" for=\"{$ide}\">{$item[3]}</label>
                </div>
            </a>
            ";
        }
        return $saida;
    }
    /**
     * iniciaisMaiusculas
     * @category Retorna o texto com as iniciais em maíuscula e o restante minúscula
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto O texto a ser convertido para maiusculas
     * @return string o texto convertido
     */
	public static function iniciaisMaiusculas($string) {
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

		foreach($romanos as $v) {
			$string = str_replace(" ".$v." ", " ".strtoupper($v)." ", $string);
			$string = str_replace(" ".$v.",", " ".strtoupper($v).",", $string);
		}
        $preposicoes = array("De", "Do", "Da", "E", "O", "A", "Dos", "Das","Os", "As");
		foreach($preposicoes as $v) {
			$string = str_replace(" ".$v." ", " ".strtolower($v)." ", $string);
			$string = str_replace(" ".$v.",", " ".strtolower($v).",", $string);
		}

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
    public static function iniciaisMaiusculasFrases($string, $frases = false) {
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
    public static function removeAcentos($texto){
        if ($texto=='') return '';
        $acentos = array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/",
                        "/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/");
        $letras = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u','U', 'n', 'N', 'c', 'C');
        return preg_replace($acentos, $letras, $texto);
    }
    /**
     * alteraAcentos
     * @category Altera os acentos por um caracter informado
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto Texto com acentos e caracteres especiais
     * @return string Texto sem acentos ou caracteres especiais
     */
    public static function alteraAcentos($texto, $caracter = '%'){
        if ($texto=='') return '';
        $acentos = array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/",
                        "/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/");
        $letras = array($caracter, $caracter,$caracter,$caracter,$caracter,$caracter,$caracter,$caracter,$caracter,$caracter,$caracter,$caracter,$caracter);
        return preg_replace($acentos, $letras, $texto);
    }

    /**
     * diaSemana
     * @category retorna o dia da semana por exetenso
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param int $dia o número do dia sendo 0 para domingo e 6 para sábado
     * @return string o dia da semana por extenso
     */
    public static function diaSemana($dia){
        $dias = array('Domingo', 'Segunda Feira', 'Terça Feira', 'Quarta Feira', 'Quinta Feira', 'Sexta Feira', 'Sábado');
        return $dias[$dia];
    }
    /**
     * paraUtf8
     * @category Converte uma string para UTF8. Deve ser aplicado nas string retornadas do banco de dados. As consultas
     * na classe banco tem a opção de aplicar esta conversão por default. Melhor se ela for feita lá
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto Texto no formato CP1252
     * @return string Texto no formato UTF8
     */
    public static function paraUTF8($texto){
        return mb_convert_encoding($texto, 'UTF-8', 'CP1252');
    }
    /**
     * deUtf8
     * @category Converte uma string de UTF8. Deve ser aplicado nas string aplicadas ao banco de dados. 
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto Texto no formato UTF8
     * @return string Texto no formato CP1252
     */
    public static function deUTF8($texto){
        if (is_array($texto)) return $texto;
        return mb_convert_encoding($texto, 'CP1252', 'UTF-8');
    }
    /**
     * numeros
     * @category retorna apenas os números em uma string
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto o texto de entrada contendo números e outros caracteres
     * @return string apenas os numeros constantes no texto de entrada
     */
    public static function numeros($texto){
        return preg_replace("/[^0-9]/", "", $texto);
    }
    /**
     * contem
     * @category retorna apenas os números em uma string
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto o texto de entrada
     * @param string $busca o texto a ser procurado dentro do texto de entrada
     * @return bollean se encontrou o texto
     */
    public static function contem($texto, $busca){
        return !(strpos($texto, $busca) === false);
    }
    /**
     * itemLista
     * @category retorna o item $item da lista $texto separada por $separador
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto o texto de entrada 
     * @param int $item o indice do item dentro da lista começando em 0, 
     * se for negativo pega no fim da lista começando em -1
     * @param string $separador o separador da lista
     * @return string retorna o indice da lista
     */
    public static function itemLista($texto, $item, $seprador){
        $lista = explode($seprador, $texto);
        if ($item>0){
            if ($item>=count($lista)) return "";
            return $lista[$item];
        } else {
            if ($item*-1>=count($lista)) return "";
            return $lista[count($lista) + $item];
        }
    }
    /**
     * entreTexto
     * @category retorna o texto da string $texto que está entre $inicio e $fim
     * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto o texto de entrada 
     * @param int $item o indice do item dentro da lista começando em 0, 
     * se for negativo pega no fim da lista começando em -1
     * @param string $separador o separador da lista
     * @return string retorna o indice da lista
     */
    public static function entreTexto($texto, $inicio, $fim){
        echo "to do";
    }
    /**
     * embaralhar
     * @category Cria uma representação numérica de uma string
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto o texto a ser embaralhado
     * @return string O texto embaralhado
     */
	public static function embaralhar($texto){
		$saida = '';
		for ($i=0;$i<strlen($texto); $i++){
			$saida .= str_pad(ord(substr($texto, $i, 1)), 3, "0", STR_PAD_LEFT);
		}
		return $saida;
	}	
    /**
     * desembaralhar
     * @category Cria uma string a partir da representação numérica criada pela função embaralhar
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto o texto a ser desembaralhado
     * @return string O texto desembaralhado
     */

	public static function desembaralhar($texto) {
		$saida = '';
		for ($i=0;$i<strlen($texto); $i = $i + 3) {
			$saida = $saida . chr(substr($texto, $i, 3));
		}
		return $saida;
    }
    /**
     * queryStringToArray
     * @category Pegar uma querystring e converte para um array associativo de uma dimensão
     * @param string $texto A querystring
     * @return array O array associativo referente a query string
     */
    public static function queryStringToArray($texto){
        // verificar se tem o separador de query string, se não vou colocar
        if (strpos($texto, '?')===false) {
            $texto = "?$texto";
        }

        // preparar a saida
        $saida = array();

        // agora vou separar em um array de 2 itens
        $dados = explode('?', $texto);

        // se não tem nada a querystring não tem campos
        if ($dados[1]=='') return $saida;

        // agora vou pegar a chave=valor
        $dados =  explode('&', $dados[1]);

        // agora vou rodando pela querystring e adicionando os dados na saida
        foreach($dados as $c){
            $v = explode('=', $c);
            $saida[$v[0]] = $v[1];
        }

        // retornar o que achou
        return $saida;
    }

    /**
     * criarLinkSecreto
     * @category Cria um link com informações embutidas de forma secreta, o link pode expirar também
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param array $dados Uma array associativo de uma dimensão com o nome dos campos e os valores
     * @param date $vencimento Uma quantidade de dias para o link vencer
     * @return string O valor para colocar na querystring do link
     */
    public static function criarLinkSecreto($dados, $vencimento = null){
        // verificar se algum parametro foi passado
        if (count($dados)==0) return '';

        // verificar se o vencimento foi passado, se não vai colocar um ano de prazo
        if ($vencimento==null) {
            $vencimento = 365;
        }

        // dar uma reforçada para o vencimento não ser menor que hoje
        if (intval($vencimento<1)) $vencimento = 1;

        // definir o vencimento absoluto
        $vencimento = date('Y-m-d', strtotime("+$vencimento days")); 

        // agora vou criar uma string juntamente com o array passado
        $saida = "vencimento_link=$vencimento";
        foreach($dados as $c=>$v){
            $saida.="&$c=$v";
        }

        // agora eu embaralho a saida
        return Texto::embaralhar($saida);
    }
    /**
     * pegarLinkSecreto
     * @category Pegar um link com informações embutidas de forma secreta e retorna o array de dados se ele não estiver vencido
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $texto Um texto criado na função criar link secreto
     * @return array Um array com os valores dos campos ou vazio se a string não estiver correta ou se o link estiver vencido.
     */
    public static function pegarLinkSecreto($texto){
        // verificar se algum parametro foi passado
        if ($texto=='') return false;

        // Desembaralhar o texto
        $texto = Texto::desembaralhar($texto);

        // criar um array com os dados do link
        $dados = Texto::queryStringToArray($texto);

        // verificar o vencimento do link
        if (!isset($dados['vencimento_link'])) {
            return array();
        }
        if (strtotime($dados['vencimento_link'])<time()){
            return array();
        }
        // retornar saida
        return $dados;
    }
    /**
     * iconeTipoImovel
     * @category Retorna um ícone para o tipo de imóvel informado
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $tipoImovel o tipo de imóvel conforme código cadastrado no sistema
     * @return o nome da classe font awesome
     */
    public static function iconeTipoImovel($tipoImovel){
        if ($tipoImovel=='ANDAR') return 'fas fa-hotel';
        if ($tipoImovel=='APTO.') return 'far fa-building';
        if ($tipoImovel=='AREA') return 'fas fa-tree';
        if ($tipoImovel=='BARRACAO') return 'fab fa-houzz';
        if ($tipoImovel=='CASA') return 'fas fa-home';
        if ($tipoImovel=='CASA COND.') return 'fas fa-home';
        if ($tipoImovel=='CHACARA') return 'fab fa-sticker-mule';
        if ($tipoImovel=='CHALE') return 'fas fa-vihara';
        if ($tipoImovel=='COBERTURA') return 'fas fa-archway';
        if ($tipoImovel=='FLAT') return 'fas fa-door-closed';
        if ($tipoImovel=='GALPAO') return 'fas fa-warehouse';
        if ($tipoImovel=='GARAGEM') return 'fas fa-car-side';
        if ($tipoImovel=='KITCHENETE') return 'fas fa-couch';
        if ($tipoImovel=='LOJA') return 'fas fa-store-alt';
        if ($tipoImovel=='LOTE') return 'fas fa-tree';
        if ($tipoImovel=='SALA') return 'fas fa-laptop';
        if ($tipoImovel=='SITIO') return 'fab fa-sticker-mule';
        if ($tipoImovel=='TERRENO') return 'fas fa-tree';
        return 'fas fa-home';
    }
    /**
     * iconeDestinacao
     * @category Retorna um ícone para a destinação do imóvel (comercial|residencial)
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $destinacao a destinação do imóvel conforme código cadastrado no sistema
     * @return o nome da classe font awesome
     */
    public static function iconeDestinacao($destinacao){
        if ($destinacao=='RESIDENCIAL') return 'fas fa-home';
        if ($destinacao=='COMERCIAL') return 'fas fa-store';
        return 'fas fa-home';
    }

    /**
     * boolToInt
     * @category converte um valor booleando para inteiro
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param bool $valor o valor booleando true ou false
     * @return int O valor inteiro sendo 1 para true e 0 para false
     */
    public static function boolToInt($valor){
        if ($valor) {
            return 1;
        } else {
            return 0;
        }
    }
    /**
     * urlAtual
     * @category Retorna a url atual completa podendo incluir, alterar ou remover campos
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param array $campos um array associativo bidimensional com a relação chave/valor
     * @return string A url completa
     */
    public static function urlAtual($campos = null){
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $url;
    }
    /**
     * listaValor
     * @category Retorna o título de um valor baseado em uma lista
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $campos uma lista com os itens
     * @param string $valor o valor a ser buscado
     * @return string O valor descritivo
     */
    public static function buscarValorLista($campos, $valor){
        $itens = explode(';', $campos);
        foreach($itens as $item) {
            $item = explode('|', $item);
            if ($item[0]==$valor) return $item[1];
        }
        return '';
    }
    /**
     * criarValorCifrado
     * @category Criar um valor cifrado baseado em um número enviado
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $valor um valor númerico que será cifrado
     * @return string O valor descritivo
     */
    public static function criarValorCifrado($valor){
        $intervalo = rand(1,9);
        $saida = $intervalo;
        for ($i = 0; $i<strlen($valor); $i++){
            $campo = (intval(substr($valor, $i, 1)) + $intervalo) % 10;
            $saida .= $campo.rand(1,9);
        }
        return $saida;
    }
    /**
     * pegarValorCifrado
     * @category decifra um valor cifrado baseado em um número enviado
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $valor um valor cifrado
     * @return string O valor decifrado
     */
	public static function pegarValorCifrado($valor){
		$intervalo = intval(substr($valor, 0, 1));
		$valor = substr($valor, 1, strlen($valor) - 1);
		$saida = '';
		for ($i = 0; $i<strlen($valor); $i++){
			if ($i%2==1) continue;
			$campo = (intval(substr($valor, $i, 1)) - $intervalo);
			if ($campo < 0 ) $campo = $campo + 10;
			$campo = $campo % 10;
			$saida .= $campo;
		}
		return $saida;
	}    
    /**
     * dataExtenso
     * @category retorna uma data por extenso
     * @author Renato Félix de Almeida <email@email.com>
     * @copyright 2020 Casa Nova Locadora
     * @param string $data a data em formato php xxxx-xx-xx, brasileiro xx/xx/xxx ou interbase xx.xx.xxxx
     * @param int $tamanho 0 - longa, 1 - curta
     * @return string a data por extenso
     */
    public static function dataExtenso($data, $tamanho = 0) {
        $meses = [
            ['Janeiro', 'Jan'], ['Fevereiro', 'Fev'], ['Março', 'Mar'], ['Abril', 'Abr'], ['Maio', 'Mai'], ['Junho', 'Jun'],
            ['Julho', 'Jul'], ['Agosto', 'Ago'], ['Setembro', 'Set'], ['Outubro', 'Out'], ['Novembro', 'Nov'], ['Dezembro', 'Dez']
        ];
        $dia = date('d', strtotime($data));
        $mes = date('m', strtotime($data));
        $ano = date('Y', strtotime($data));

        $mes = intval($mes) - 1;
        return $dia.' de '.$meses[$mes][$tamanho].' de '.$ano;
    }
	public static function escreverTextoMultiline($imagem, $texto, $esquerda, $topo, $direita, $fonteSize, $cor, $espacamento, $fonte = '/var/www/intranet/fontes/arial.ttf') {
		$palavras = explode(' ', $texto);
		$saida = '';
		$linha = 0;
		$w = $direita - $esquerda;
		$branco = imagecolorallocate($imagem, 255, 255, 255);
		foreach($palavras as $palavra) {
			$tamanho = imagettfbbox($fonteSize, 0, $fonte, trim($saida.' '.$palavra))[2];
			if ($tamanho > $w) {
				imagettftext($imagem, $fonteSize, 0, $esquerda + 1, $topo + $linha * $espacamento + 1, $branco, $fonte, trim($saida));
				imagettftext($imagem, $fonteSize, 0, $esquerda, $topo + $linha * $espacamento, $cor, $fonte, trim($saida));
				$linha++;
				$saida = '';
			}
			$saida .= ' '.$palavra;
		}
		if (trim($saida) <> '') {
			imagettftext($imagem, $fonteSize, 0, $esquerda + 1, $topo + $linha * $espacamento + 1, $branco, $fonte, trim($saida));
			imagettftext($imagem, $fonteSize, 0, $esquerda, $topo + $linha * $espacamento, $cor, $fonte, trim($saida));
		}
		return $imagem;
	}	
	public static function escreverTexto($imagem, $texto, $cor, $altura, $fonteSize, $alinhamento, $margem, 
		$esquerda = 0, $fonte = "/var/www/intranet/fontes/arial.ttf", $largura = 512){
		if ($alinhamento < 3) {
			$esquerda += $margem;
			$dimensions = imagettfbbox($fonteSize, 0, $fonte, $texto);
			$tamanho = abs($dimensions[4] - $dimensions[0]);
			if ($alinhamento == 1) {
				$esquerda = $largura / 2 - $tamanho / 2;
			}
			if ($alinhamento == 2) {
				$esquerda = $largura - $margem - $tamanho;
			}
		} else {
			$esquerda = $alinhamento;
		}
		imagettftext($imagem, $fonteSize, 0, $esquerda, $altura, $cor, $fonte, $texto);	
	}

}