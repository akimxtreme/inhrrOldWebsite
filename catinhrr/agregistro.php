<html>
<?php
require_once('vfns.php');

$Cedula = $_POST['cedula'];
$Apellido1 = $_POST['apellido1'];
$Apellido2 = $_POST['apellido2'];
$Nombre1 = $_POST['nombre1'];
$Nombre2 = $_POST['nombre2'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$extension = $_POST['extension'];
$correo = $_POST['correo'];
$cargo = $_POST['cargo'];
$fechanac = $_POST['fechanac'];
$ubica = $_POST['ubica'];
$clave1 = $_POST['clave'];
$clave2 = $_POST['confirmarClave'];
$repuesta1 = $_POST['repuesta1'];
$repuesta2 = $_POST['repuesta2'];
$repuesta3 = $_POST['repuesta3'];

$Cedula = trim($Cedula);
$Apellido1 = trim($Apellido1);
$Apellido2 = trim($Apellido2);
$Nombre1 = trim($Nombre1);
$Nombre2 = trim($Nombre2);
$direccion  = trim($direccion);
$telefono = trim($telefono);
$extension = trim($extension);
$correo = trim($correo);
$cargo = trim($cargo);
$fechanac = trim($fechanac);
$ubica = trim($ubica);
$clave1 = trim($clave1);
$clave2 = trim($clave2);
$repuesta1 = trim($repuesta1);
$repuesta2 = trim($repuesta2);
$repuesta3 = trim($repuesta3);

$fecha = date('Y-m-d');

$Cedula = (int)$Cedula;

$fechanac=InvertirFecha($fechanac);

if (!$Cedula || !$Apellido1 || !$Nombre2 || !$direccion || !$telefono || !$fechanac || !$clave1 || !$clave2 || !$repuesta1 || !$repuesta2  || !$repuesta3){
	do_error2();
	exit;
}
if (!get_magic_quotes_gpc()){
   	$Apellido1 = addslashes($Apellido1);
	$Apellido2 = addslashes($Apellido2);
	$Nombre1 = addslashes($Nombre1);
	$Nombre2 = addslashes($Nombre2);
	$direccion = addslashes($direccion);
	$extension = trim($extension);
	$correo = addslashes($correo);
	$cargo = addslashes($cargo);
	$ubica = addslashes($ubica);
	$repuesta1 = addslashes($repuesta1);
	$repuesta2 = addslashes($repuesta2);
	$repuesta3 = addslashes($repuesta3);
}
$Apellido1 = strtoupper($Apellido1);
$Apellido2 = strtoupper($Apellido2);
$Nombre1 = strtoupper($Nombre1);
$Nombre2 = strtoupper($Nombre2);
$repuesta1 = strtoupper($repuesta1);
$repuesta2 = strtoupper($repuesta2);
$repuesta3 = strtoupper($repuesta3);

$conector=ConectarBD();
$sql3="SELECT cedula, apellido1, nombre1 FROM registrados WHERE cedula = $Cedula";
$consulta3=EjecuteExec($conector,$sql3) or die($sql3);
if(NumFila($consulta3)>0){
	$campo1 = mysql_fetch_object($consulta3);
	$ced = $campo1->cedula;
	$ape = $campo1->apellido1;
	$nom = $campo1->nombre1;
	//$fila = ObtenerFila($consulta3);
	echo "<p>&nbsp;</p>";
	echo "<div bgcolor='#FFFF00' align='center' class='Estilo10'>";
    echo "USTED YA SE ENCUENTRA REGISTRADO<br>";
	//echo "$fila[0], $fila[1], $fila[2]";
	echo "$ced, $ape, $nom";
  	echo "</div>";
	}elseif(NumFila($consulta3)==0){
		$sql4="SELECT cedula, apellidos, nombres FROM socios WHERE cedula = $Cedula";
		$consulta4=EjecuteExec($conector,$sql4) or die($sql4);
		if(NumFila($consulta4)>0){
			$sql5="INSERT INTO registrados (cedula, apellido1, apellido2, nombre1, nombre2, direccion, telefono, extension, correo, cargo, nacimiento, codunifisica, clave, repuesta1, repuesta2, repuesta3, f_registro) VALUES ($Cedula, '$Apellido1', '$Apellido2', '$Nombre1', '$Nombre2', '$direccion', '$telefono', '$extension', '$correo', '$cargo', '$nacimiento', '$codunifisica', '$clave1', '$repuesta1', '$repuesta2', '$repuesta3', '$fecha')";
    		$Ingreso=EjecuteExec($conector,$sql5) or die($sql5);
			$tabla1 ="<table width='570' align='center'><tr><td align='center'>";
			$tabla1.="<span class='Estilo10'>DATOS INGRESADOS SATISFACTORIAMENTE</span>";
			$tabla1.="</td></tr></table>";
			echo '</br>',$tabla1;
		}else{
			echo "<p>&nbsp;</p>";
			echo "<div bgcolor='#FFFF00' align='center' class='Estilo10'>";
    		echo "DISCULPE USTED NO ES SOCIO DE CATINHRR<br>";
			echo "</div>";
		}
	}
$pag='index.php';
do_continuar1($pag);
?>
</html>