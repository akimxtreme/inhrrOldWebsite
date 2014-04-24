<?php
	require_once('conexion_fns.php');
	$conector=ConectarBD();
	$sql1="SELECT * FROM unidades WHERE codunidad = '$ParCod' LIMIT 1";
	$consulta1=EjecuteExec1($conector,$sql1) or die($sql1);
	if(mysql_num_rows($consulta1)>0){
		$campo1 = mysql_fetch_object($consulta1);
		$unidad = $campo1->unidad;
		echo "<div>&nbsp;Unidad Administrativa</div><div>&nbsp;<input type='text' name='txtUnidad' id='txtUnidad' size='50' maxlength='50' value='$unidad'/></div>";
	}else{
		echo "<div>&nbsp;Unidad Administrativa</div><div>&nbsp;<input type='text' name='txtUnidad' id='txtUnidad' size='50' maxlength='50'/></div>";
	}
?>