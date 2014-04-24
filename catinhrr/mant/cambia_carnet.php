<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
</head>
<body>
<?php
include "cxbdinhrr.php";
$sql1 = "select cedula, nombres, tipo from tmp_socios";
$tablatmp = mysql_query($sql1,$cxinhrr) or die($sql1);
if(mysql_num_rows($tablatmp)>0){
	$c=0;
	While($campo = mysql_fetch_object($tablatmp)){
		$ced=$campo->cedula;
		$nom=$campo->nombres;
		$tip=$campo->tipo;
		$sql2 = "select * from socios where socios.cedula = $ced";
		$consulta2=mysql_query($sql2,$cxinhrr) or die($sql2);
		if(mysql_num_rows($consulta2)>0){
			$sql3 = "update socios set socios.carnet = 'SI' where socios.cedula = $ced";
			$modificado = mysql_query($sql3,$cxinhrr);
		//}else{
			//$sql4 = "insert into socios (cedula, apellidos, nombres, tipo) VALUES ($ced, '$nom', '$nom', $tip)";
			//$ingresado = mysql_query($sql4,$cxinhrr);
		}
		$c++;
	}
	echo 'REGISTROS MODIFICADOS '.$c.'<br>';
}
?>
</body>
</html>