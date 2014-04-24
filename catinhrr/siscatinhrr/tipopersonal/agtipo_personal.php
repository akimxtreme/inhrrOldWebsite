<?php
session_start();
require_once('varias_fns.php');
do_html_encabezado('');
if (isset($_SESSION['usuario_valido'])){
	$usu = $_SESSION['usuario_valido'];

$Codigo = $_POST['txtCodigo'];
$Tipo = $_POST['txtTipo'];

$Codigo = trim($Codigo);
$Tipo = trim($Tipo);
$fecha = date('Y-m-d');

if (!$Codigo || !$Tipo){
	do_error2();
	exit;
}
if (!get_magic_quotes_gpc()){
   	$Tipo = addslashes($Tipo);
}
$Codigo = strtoupper($Codigo);
$Tipo = strtoupper($Tipo);

$conector=ConectarBD();
$sql3="SELECT codigo, tipo FROM tipos WHERE codigo = '$Codigo'";
$consulta3=EjecuteExec($conector,$sql3) or die($sql3);
if(NumFila($consulta3)>0){
	$sql4="UPDATE tipos SET tipo='$Tipo', actualizado_por='$usu', f_actualizacion='$fecha' WHERE codigo = '$Codigo'";
	$actualizado=EjecuteExec($conector,$sql4) or die($sql4);
	echo "<p>&nbsp;</p>";
	echo "<div bgcolor='#FFFF00' align='center' class='Estilo10'>";
    echo "DATOS ACTULIZADOS SATISFACTORIAMENTE <br>";
  	echo "</div>";
	}else{
	$sql5="INSERT INTO tipos (codigo, tipo, registrado_por, f_registro) VALUES ('$Codigo', '$Tipo', '$usu', '$fecha')";
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