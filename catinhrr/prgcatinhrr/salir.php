<?php
session_start();
require_once('varias_fns.php');
do_html_encabezado('');
$usuario_anterior = $_SESSION['usuario_valido'];  
unset($_SESSION['usuario_valido']);
session_destroy();
if (!empty($usuario_anterior)){
    $tabla="<br><table width='760' border='0' align='center' cellpadding='0' cellspacing='0'>";
	$tabla.="<tr><th width='760' height='40' valign='bottom' class='Estilo10' scope='col'>";
	$tabla.="<h2 align='center' class='Estilo10'>USTED HA SALIDO DEL SISTEMA</h2></th></tr></table>";
	echo $tabla;
}else{
  	$tabla1="<br><table width='760' border='0' align='center' cellpadding='0' cellspacing='0'>";
	$tabla1.="<tr><th width='760' height='40' valign='bottom' class='Estilo10' scope='col'>";
	$tabla1.="<h2 align='center' class='Estilo10'>NO HA ACCESADO EL SISTEMA</h2></th></tr></table>";
	echo $tabla1;
}
$tabla2="<br><table width='760' border='0' align='center' cellpadding='0' cellspacing='0'>";
$tabla2.="<tr><th width='760' height='40' valign='bottom' class='Estilo12' scope='col'>";
$tabla2.="<h2 align='center' class='Estilo14'><a href='../index.php'>ACCESO AL SISTEMA</a></h2></th></tr></table>";
echo $tabla2;

do_html_pie();
?>
