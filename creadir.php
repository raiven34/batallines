    <?php
    //A la función le pasamos como parametro el directorio y el archivo zip  
    function comprimirDirectorio($dir, $zip) {  
       //Primero comprabamos que sea un directorio  
       if (is_dir($dir)){   
          //Por cada elemento dentro del directorio  
          foreach (scandir($dir) as $item) {   
             //Evitamos la carpeta actual y la anterior  
             if ($item == '.' || $item == '..') continue;  
             //Si encuentra una que no sea las anteriores,  
             //vuelve a llamar a la función, con un nuevo directorio  
             comprimirDirectorio($dir . "/" . $item, $zip);  
          }  
       }else{  
          //En el caso de que sea un archivo, lo añade al zip  
          $zip->addFile($dir);  
       }  
    }  

    //Creamos el archivo  
    $zip = new ZipArchive();  
    if ($zip->open("nombre.zip", ZIPARCHIVE::CREATE)==TRUE) {  
       //Si lo abre, es porque no existe ningun zip con ese nombre  
       //Llamámos a la función para comprimir  
       $directorio="/home/a4020657/public_html/";
       comprimirDirectorio($directorio, $zip);  
       //Cerramos el archivo  
       $zip -> close;  
    }  
    ?>
