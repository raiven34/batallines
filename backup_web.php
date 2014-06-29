<?PHP 

$raiz="./";
$c_origen="./";
$c_destino="./backup";

chdir($raiz);
$id_d=opendir($c_origen);

while($fichero=readdir($id_d))
    {
    if(($fichero!=".")&&($fichero!="..")&&(!is_dir($fichero))&&(!strcasecmp(strrchr($fichero,"."),".jpg")||(!strcasecmp(strrchr($fichero,"."),".jpeg"))))
        {$listado_ficheros[]=$fichero;}
    }

closedir($id_d);
$id_d=opendir($raiz);

foreach($listado_ficheros as $nombre){
    $origen=$c_origen."/".$nombre;
    $destino=$c_destino."/".$nombre;
    copy($origen,$destino);
    } 

?> 