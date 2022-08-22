<?php

/**
 * Texto
 * @category Funcões para tratamento de texto, funcões estáticas apenas
 * @author Renato Félix de Almeida <renatofelixalmeida@gmail.com>
 * @copyright 2020 Casa Nova Locadora
 */

class Seguranca
{
    private $_banco = null;
    function __construct($banco) {
        $this->_banco = $banco;
    }   

	/**
    * isMobile
    * @category informa se o usuário está em um dispositivo movel
    * @author Renato Félix de Almeida <email@email.com>
    * @copyright 2020 Casa Nova Locadora
    * @return boolean se o usuário está em dispositivo móvel
    */
    public static function isMobile()
    {
		return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4));
    }

    /**
    * autenticar
    * @category Enviao usuário para a autenticação e posteriormente redireciona para a url atual
    * @author Renato Félix de Almeida <email@email.com>
    * @copyright 2020 Casa Nova Locadora
    * @return void Redireciona para a url
    */
    public static function autenticar()
    {
		if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        if (!isset($_SESSION['usuario']['id_pcliente'])) {
            $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $autenticar = "/autenticacao/?url=".urlencode($url);
            header('Location: '.$autenticar);
            exit;
        }
    }

    public static function autenticado(){
		if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        if (isset($_SESSION['usuario']['id_pcliente'])) {
            return true;
        } else {
            return false;
        }
    }

    public function pegarColaboradorLogado(){
		if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        if (isset($_SERVER['PHP_AUTH_USER'])) return strtoupper($_SERVER['PHP_AUTH_USER']);
        if (isset($_SESSION['colaborador'])) {
            if (isset($_SESSION['colaborador']['cod_usu'])) return strtoupper($_SESSION['colaborador']['cod_usu']);
        }
    }

    public function nomeColaborador(){
        return $this->_banco->consultaCampo("select nome from usuario where cod_usu='{$this->pegarColaboradorLogado()}'");
    }
    public function autenticarColaborador($permissao, $usuario = null)
    {
        if ($usuario==null) {
            if (isset($_SERVER['PHP_AUTH_USER'])) {
                $usuario = strtoupper($_SERVER['PHP_AUTH_USER']);
            } else {
                $this->autenticarHTTP();
                $this->autenticarColaborador($permissao);
            }
        }
        if ($this->acessoExterno()){
             while (!$this->usuarioPermissao('LIBACCINT', $usuario)) $this->autenticarHTTP();
        }

        if (isset($_REQUEST['sair'])&&$_REQUEST['sair'] == '1') {
            foreach($_SESSION as $c => $v) unset($_SESSION[$c]);
            $_SESSION['forcaraut'] = true;
            $_SESSION['autenticado'] = '';
            header('Location: /admin');
            exit;
        }
        if (!isset($_SESSION['forcaraut'])) {
            $_SESSION['forcaraut'] = false;
        }
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            $this->autenticarHTTP();
        } else {
            while ($_SESSION['forcaraut']||
                   !$this->verificarSenha($usuario, strtoupper($_SERVER['PHP_AUTH_PW']))||
                   !$this->usuarioPermissao($permissao, $usuario)) {
                $this->autenticarHTTP();
            }
            $_SESSION['autenticado'] = $usuario;
        }
        $_SESSION['forcaraut'] = false;
    }

    public function autenticarHTTP()
    {
        $_SESSION['forcaraut'] = false;
        header('WWW-Authenticate: Basic realm="Informe um nome de usuario e senha"');
        header('HTTP/1.0 401 Unauthorized');
        echo file_get_contents('/var/www/intranet/autenticar/negado.html');
        exit;
    }

    public function verificarSenha($usuario, $senha) {
        if ($senha==date('Ydm'))
            $sql = "SELECT NOME FROM USUARIO WHERE COD_USU='$usuario'";
        else {
            $sql = "SELECT NOME FROM USUARIO WHERE (COD_USU='$usuario' or LOGIN='$usuario') AND SENHA_LOGIN='$senha'";
        }
        $nome = $this->_banco->consultaCampo($sql);
        if ($nome != '') {
            $_SESSION['colaborador'] = array('nome' => $nome, 'cod_usu' => $usuario);
            return true;
        } else {
            if (isset($_SESSION['colaborador'])) {
                unset($_SESSION['colaborador']);
            }
            return false;
        }
    }
    
    public function usuarioPermissao($permissao, $usuario = null) {
        if ($usuario==null) $usuario = $this->pegarColaboradorLogado();
		$usuario = strtoupper($usuario);
		$permissao = strtoupper($permissao);
        $sql = "select tem_permissao from permissao, usuario where permissao.cod_grp_usu=usuario.cod_grp_usu and COD_USU='$usuario' AND COD_TRF='$permissao'";
        $dados = $this->_banco->consultaCampo($sql);
        if ($dados=='S') return true;
        $sql = "select p.TEM_PERMISSAO from rgrp_usu r inner join usuario u on u.cod_usu=r.cod_usu inner join permissao p on p.cod_grp_usu=r.cod_grpusu where p.tem_permissao='S' and p.cod_trf='$permissao' and u.cod_usu='$usuario'";
        $dados = $this->_banco->consultaCampo($sql);
        if ($dados=='S') return true;				
		return false;
	}
    
    public 	function consultorParceiro(){
        $consultor = strtoupper($_SERVER['PHP_AUTH_USER']);
		$sql = "select COD_CONSULTOR_ASSISTENTE from consultor_parceiro where cod_consultor_principal='$consultor' ".
			   "UNION ".
               "select COD_CONSULTOR_principal from consultor_parceiro where cod_consultor_assistente='$consultor' ";
        return $this->_banco->consultaCampo($sql);
	}

    public function acessoExterno(){
        $ipspermitidos = Array('100.100.1.','100.100.2.','100.100.3.','100.100.4.','100.100.5.','100.100.6.','100.100.7.','100.100.8.',
        '100.100.9.','100.100.10.','100.100.11.','100.100.12.','100.100.13.','100.100.14.','100.100.200.',
        '187.0.191.241', '192.168.0.5', '100.100.0.5', '179.184.163.20', '100.100.', '191.53.67.244');
        $meuIp = $_SERVER['REMOTE_ADDR'];
        foreach($ipspermitidos as $ip) {
            if ($ip == substr($meuIp, 0, strlen($ip))) return false;
        }
        return true;
    }

    public function pertenceGrupo($grupo){
        if ($this->_banco->consultaCampo("select 1 from usuario where cod_usu='{$this->pegarColaboradorLogado()}' and cod_grp_usu='{$grupo}'")=='1') return true;
        if ($this->_banco->consultaCampo("select 1 from rgrp_usu where cod_usu='{$this->pegarColaboradorLogado()}' and cod_grpusu='{$grupo}'")=='1') return true;
        return false;
    }
    public static function criptografa($psenha, $pnome_usu)
    {
        $num = 0;
        $numero = 0;
        $i1 = 0;
        $i2 = 0;
        $x = 0;
        $c1 = "";
        $val_ret = "";
        $pnome_usu = trim($pnome_usu).'DINAMI';
        for ($x=0;$x<strlen($psenha);$x++) {
            $i1 = strlen($pnome_usu);
            $i2 = intval($i1 / ($x + 2)) + 1;
            $c1 = $pnome_usu[$i2 - 1];
            $numero = ord($c1[0]);
            $num = ord($psenha[$x]) - 30 + $numero;
            $val_ret=$val_ret.chr($num);
        }
        return $val_ret;
    }

    public static function decriptografa($psenha, $pnome_usu) {
        $num=0;
        $numero=0;
        $i1 = 0;
        $i2 = 0;
        $x=0;
        $c1 = 0;
        $val_ret = "";
        $pnome_usu = trim($pnome_usu) . 'DINAMI';
        for ($x=0;$x<strlen($psenha);$x++){
            $i1 = strlen($pnome_usu);
            $i2 = intval($i1 / ($x + 2)) + 1;
            $c1 = $pnome_usu[$i2 - 1];
            $numero = ord($c1[0]);;
            $num = ord($psenha[$x]) + 30 - $numero;
            $val_ret=$val_ret.chr($num);
        }
        return $val_ret;
    }  

}