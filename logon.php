<?PHP
include('superior.php');
?>
<div class="presupuesto">
<?PHP
if(isset($_POST['usuario'])){
    $queusuarios = "SELECT * FROM usuarios WHERE pseudonimo='" . $_POST['usuario'] . "' AND password='" . $_POST['contrasena'] . "'" ;
    $resusuarios = mysql_query($queusuarios, $conexion) or die(mysql_error());
    $totusuarios = mysql_num_rows($resusuarios);
    if ($totusuarios>0){
    	$_SESSION["usuario"]= $_GET["usuario"];
        $_SESSION["autentificado"]= "SI";
        print("Login correcto." . "\n");
    }else{
    	header("Location: login.php?error");
    }
?>
</div>
<?PHP
include('pie.php');
?>