<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración Batallines</title>
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
session_start();
?>
<form name="frm_login" method="post" action="login.php">
<div class="centradaadmin" >
	<table align="center">
	<tr>
	<td class="cabeceraest" ><a class="acabecera">Usuario: <input type="text" size="10" name="usuario" /><br /></a></td>
	</tr>
	<tr>
	<td class="cabeceraest" ><a class="acabecera">Clave: &nbsp;&nbsp;&nbsp;&nbsp;<input type="password" size="10" name="pass" /><br /></a></td>
	</tr>
	<tr>
	<td class="cabeceraest" ><a><input type="submit" name="submit" value="Entrar" /><br /></a></td>
	</tr>

	</table>
</div>
</form>

<table align="center">
		<tr>
	<td>
		<?php
			if (isset($_GET['error'])) {
			    echo '<b>Usuario o clave incorrecta. El Medusa debe autorizarte ;)</b>';
			}
		?>
	</td>
	</tr>
</table>	

</body>
</html>