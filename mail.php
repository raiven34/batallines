<?PHP
$cuerpo = '
<html>
<head>
   <title>' . $asunto . '</title>
</head>
<body>
'
. $texto .
'
</body>
</html>
';

//para el env�o en formato HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//direcci�n del remitente
$headers .= "From: Admin Batallines <admin@batallines.es>\r\n";

//direcci�n de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: admin@batallines.es\r\n";

//ruta del mensaje desde origen a destino
$headers .= "Return-path: admin@batallines.es\r\n";

//direcciones que recibi�n copia
$headers .= "Cc: \r\n";

//direcciones que recibir�n copia oculta
$headers .= "Bcc: \r\n";

mail($destinatario,$asunto,$cuerpo,$headers);
?> 