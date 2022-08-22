<?php 

function autoloadCasaNova($Class){
    $base = __DIR__.'/App/';
    $Class = str_replace("\\", "/", $Class);
    if (file_exists($base.$Class.'.php')) {
        require_once($base.$Class.'.php');
    }
}

spl_autoload_register("autoloadCasaNova");