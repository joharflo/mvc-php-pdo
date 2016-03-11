<?php

require "config.php";

$url=isset($_GET["url"]) ? $_GET["url"] : "Index/index";
$urlFiltrada=explode("/",$url);


$controlador="";
$metodo="";

if (isset($urlFiltrada[0])) {
  $controlador=$urlFiltrada[0];
}

if (isset($urlFiltrada[1])){
  if ($urlFiltrada[1]!="") {
    $metodo=$urlFiltrada[1];
  }
}

spl_autoload_register(function($clase){
  if (file_exists(LBS.$clase.".php")) {
    require LBS.$clase.".php";
  }
});

//new Controlador();
$pathControlador="Controladores/".$controlador.".php";
if (file_exists($pathControlador)) {
  require $pathControlador;
  $objetoControlador=new $controlador();
  if (isset($metodo)) {
    if (method_exists($objetoControlador,$metodo)) {
      $objetoControlador->{$metodo}();
    }else{
      echo "no existe metodo";

    }
  }
}else{
  echo "no existe controlador";
}


?>
