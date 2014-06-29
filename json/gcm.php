<?php
session_start();
require_once '../conexion.php';
$quetemp="select * from jugadores where movil_id!=''";
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());


?>
<html>
<head>
<title>AndroidBegin - Android GCM Tutorial</title>
<link rel="icon" type="image/png" href="http://www.androidbegin.com/wp-content/uploads/2013/04/favicon1.png"/>
<script type="text/javascript">
    function myFunction(){
        
        if (document.getElementById('idtipo').value=="1"){
            alert(document.getElementById('idtipo').value);
            window.location = "http://batallines.es/cron_noti.php";
        }else{
            document.forms['form'].submit();
        }
    }
</script>
</head>
<body>
<?php

if($_SESSION["rango"]>1){
?>
    <form action="gcm_engine.php" method="post" enctype="multipart/form-data" name="formulario" id="form">
Google API Key (with IP locking) : <INPUT size=70% TYPE="Text" VALUE="AIzaSyDbpsUSs-WPDzAlSJ268yBUzdJtNvyc35E" NAME="apiKey"></br>
Get your Google API Key : <a href="https://code.google.com/apis/console/" target="_blank">Google API</a></br></br>
<img src="http://www.androidbegin.com/wp-content/uploads/2013/05/Google-API-Key.png" alt="Google API Key" ></br></br>
Tipo:<select NAME = "tipo" id="idtipo">
  <option value="0">Mensaje</option>
  <option value="1">Pr&oacute;ximo Partido</option>
  <option value="2">Actualizaci&oacute;n</option>
</select>
</br></br>
Device Registration ID : <select NAME = "registrationIDs">
  <option value="todos">Todos</option>
<?php
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($restemp)){
?>
  <option value="<?php echo($row['movil_id']); ?>"><?php echo($row['apodo']); ?></option>
<?php
			
		}
	}
?>
</select>
</br></br>
Tap on the Register button in your GCM Tutorial App and locate Device Registration ID in LogCat</br><img src="http://www.androidbegin.com/wp-content/uploads/2013/05/Device-Registration-ID.png" alt="Device Registration ID" ></br></br>
Notification Message : <INPUT size=70% TYPE = "Text" VALUE="" NAME = "message"></br></br>


</form>
    <input type="submit" value="Send Notification" onclick="myFunction()"/>
<?php
}else{
	print ("No tienes permiso");
}
?>
</body>
</html>