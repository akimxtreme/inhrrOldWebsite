<?php
session_start();
require_once('varias_fns.php');
do_html_encabezado('');
if (isset($_SESSION['usuario_valido'])){
	$usu = $_SESSION['usuario_valido'];

$Codigo = $_POST['txtCodigo'];
$Unidad = $_POST['txtUnidad'];

$Codigo = trim($Codigo);
$Unidad = trim($Unidad);
$fecha = date('Y-m-d');

if (!$Codigo || !$Unidad){
	do_error2();
	exit;
}
if (!get_magic_quotes_gpc()){
   	$Unidad = addslashes($Unidad);
}
$Codigo = strtoupper($Codigo);
$Unidad = strtoupper($Unidad);

$conector=ConectarBD();
$sql3="SELECT codunidad, unidad FROM unidades WHERE codunidad = '$Codigo'";
$consulta3=EjecuteExec($conector,$sql3) or die($sql3);
if(NumFila($consulta3)>0){
	$sql4="UPDATE unidades SET Unidad='$Unidad', actualizado_por='$usu', f_actualizacion='$fecha' WHERE codunidad = '$Codigo'";
	$actualizado=EjecuteExec($conector,$sql4) or die($sql4);
	echo "<p>&nbsp;</p>";
	echo "<div bgcolor='#FFFF00' align='center' class='Estilo10'>";
    echo "DATOS ACTULIZADOS SATISFACTORIAMENTE <br>";
  	echo "</div>";
	}else{
	$sql5="INSERT INTO unidades (codunidad, unidad, registrado_por, f_registro) VALUES ('$Codigo', '$Unidad', '$usu', '$fecha')";
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