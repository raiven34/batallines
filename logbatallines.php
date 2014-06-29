<?php

if (isset($_SESSION["usuario"]) && isset($mensaje)){
$br=fopen("logbatallines.txt","a") or die("Problemas al escribir en el log");
fputs($br,$_SESSION["usuario"] . " - " . date("d-m-Y H:i:s") . ": " . $mensaje);
fputs($br,"\n");
fclose($br);
}

?>