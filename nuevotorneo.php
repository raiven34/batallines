<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administracion Not�cias</title>
<link href="css/estilosweb.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function cargacombo()
	{		
		<?PHP
		if (isset($_REQUEST['numjug'])){
			$totaljug=$_REQUEST['numjug'];
		}else{$totaljug=4;}
		print('document.form.numjug.value="' . $totaljug. '";'. "\n");
		?>
	}
</script>
</head>

<body onload="cargacombo();">

 
<form id="form" name="form" method="post" action="nuevotorneo.php" enctype="multipart/form-data">
<label>
  <select name="numjug" id="numjug">
    <option id="4" value="4">4</option>
    <option id="5" value="5">5</option>
    <option id="6" value="6">6</option>
    <option id="7" value="7">7</option>
    <option id="8" value="8">8</option>
    <option id="9" value="9">9</option>
    <option id="10" value="10">10</option>
    <option id="11" value="11">11</option>
    <option id="12" value="12">12</option>
  </select>
</label>

<label>
  <select name="modo" id="modo">
    <option selected="selected" value="i">Individual</option>
    <option value="p">Parejas</option>
  </select>
</label>
<input type=submit value="Actualizar"></input>
</form>
<BR/>
<BR/>
<TABLE border="1">

<form id="formpart" name="formpart" method="post" action="sorteo.php" enctype="multipart/form-data">
<?PHP

	
	for ($b=1; $b<=$totaljug; $b++) {
		print("<TR>\n");
		print("<TD>" . $b . "</TD>\n");
		print('<TD><input name="participante' . $b . '" type="text" id="participante' . $b . '" size="20" maxlength="20" />' . "</TD>\n");
		print("</TR>\n");
	}
	print('<input name="total" type="hidden" id="total" value="' . $totaljug . '" />' . "\n");
	
?>

</TABLE>
<input type=submit value="Sortear"></input>
</form>
</body>
</html>