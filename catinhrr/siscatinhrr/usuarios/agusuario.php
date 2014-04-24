<?php
session_start();
require_once('varias_fns.php');
do_html_encabezado('');
if (isset($_SESSION['usuario_valido'])){
	$usu = $_SESSION['usuario_valido'];

$Cedula = $_POST['txtCedula'];
$Apellidos = $_POST['txtApellidos'];
$Nombres = $_POST['txtNombres'];
$Usuario = $_POST['txtUsuario'];
$Clave = $_POST['txtClave'];
$Nivel = $_POST['txtNivel'];

$Cedula = trim($Cedula);
$Apellidos = trim($Apellidos);
$Nombres = trim($Nombres);
$Usuario = trim($Usuario);
$Clave = trim($Clave);
$Nivel = trim($Nivel);
$fecha = date('Y-m-d');

$Cedula = (int)$Cedula;

if (!$Cedula || !$Apellidos || !$Nombres || !$Usuario || !$Clave || !$Nivel){
	do_error2();
	exit;
}
if (!get_magic_quotes_gpc()){
   	$Apellidos = addslashes($Apellidos);
	$Nombres = addslashes($Nombres);
	$Clave = addslashes($Clave);
}
$Nivel = strtoupper($Nivel);

$conector=ConectarBD();
$sql3="SELECT cedula, apellidos FROM usuarios WHERE cedula = '$Cedula'";
$consulta3=EjecuteExec($conector,$sql3) or die($sql3);
if(NumFila($consulta3)>0){
	$sql4="UPDATE usuarios SET clave='$Clave', nivel='$Nivel', actualizado_por='$usu', f_actualizacion='$fecha' WHERE cedula = '$Cedula'";
	$actualizado=EjecuteExec($conector,$sql4) or die($sql4);
	echo "<p>&nbsp;</p>";
	echo "<div bgcolor='#FFFF00' align='center' class='Estilo10'>";
    echo "DATOS ACTULIZADOS SATISFACTORIAMENTE <br>";
  	echo "</div>";
	}else{
	$sql5="INSERT INTO usuarios (cedula, nombres, apellidos, usuario, clave, nivel, registrado_por, f_registro) VALUES ($Cedula, '$Nombres', '$Apellidos', '$Usuario', '$Clave', '$Nivel', '$usu', '$fecha')";
    $Ingreso=EjecuteExec($conector,$sql5) or die($sql5);
	$tabla ="<table width='750' align='center'><tr><td align='center'>";
	$tabla.="<span class='Estilo10'>DATOS INGRESADOS SATISFACTORIAMENTE</span>";
	$tabla.="</td></tr></table>";
	echo '</br>',$tabla;	
}
$pag='../sistema.php';
do_continuar1($pag);

}else{
	do_error1();
}
do_html_pie();
?>