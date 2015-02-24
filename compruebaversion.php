<?php
$version_actual="2.1";
if ($_REQUEST["version"]!=$version_actual){
	
	header('Location: http://batallines.es/batallines_app/Batallines.apk');
	echo('<h1>Descargando Actualizacion ' . $version_actual . '</h1>');

}else{
	echo('<h1>Ya dispones de la ultima version</h1>');
}

?>