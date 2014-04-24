<?php
	require_once('conexion_fns.php');
	$conector=ConectarBD();
	$sql1="SELECT * FROM tipos WHERE codigo = '$ParCod' LIMIT 1";
	$consulta1=EjecuteExec1($conector,$sql1) or die($sql1);
	if(mysql_num_rows($consulta1)>0){
		$campo1 = mysql_fetch_object($consulta1);
		$tipo = $campo1->tipo;
		echo "<div>&nbsp;Tipo de Personal</div><div>&nbsp;<input type='text' name='txtTipo' id='txtTipo' size='50' maxlength='50' value='$tipo'/></div>";
	}else{
		echo "<div>&nbsp;Tipo de Personal</div><div>&nbsp;<input type='text' name='txtTipo' id='txtTipo' size='50' maxlength='50'/></div>";
	}
?>