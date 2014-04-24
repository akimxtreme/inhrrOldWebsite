<?php
	require_once('conexion_fns.php');
	$conector=ConectarBD();
	$sql1="SELECT cedula FROM registrados WHERE cedula = '$ParCod' LIMIT 1";
	$consulta1=EjecuteExec1($conector,$sql1) or die($sql1);
	if(mysql_num_rows($consulta1)>0){
		$campo1 = mysql_fetch_object($consulta1);
		$cedula = $campo1->cedula;
		echo "<div class='TextoMensaje'>&nbsp;NUMERO YA SE ENCUENTRA REGISTRADO.</div>";
	}else{
		echo "<div>&nbsp;</div>";
	}
?>