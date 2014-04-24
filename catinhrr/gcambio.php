<html>
<?php
require_once('vfns.php');

$Cedula = $_POST['cedula'];
$clave1 = $_POST['clave'];
$clave2 = $_POST['confirmarClave'];

$Cedula = trim($Cedula);
$clave1 = trim($clave1);
$clave2 = trim($clave2);

$fecha = date('Y-m-d');

$Cedula = (int)$Cedula;

if (!$Cedula || !$clave1 || !$clave2){
	do_error2();
	exit;
}
if ($clave1==$clave2){
	$clave=$clave1;
}

$conector=ConectarBD();
$sql2="UPDATE registrados SET clave='$clave' WHERE cedula = '$Cedula'";
$actualizado=EjecuteExec($conector,$sql2) or die($sql2);
echo "<p>&nbsp;</p>";
echo "<div bgcolor='#FFFF00' align='center' class='Estilo10'>";
echo "DATOS ACTULIZADOS SATISFACTORIAMENTE <br>";
echo "</div>";
$pag='index.php';
do_continuar1($pag);
?>
</html>