<?php
session_start();
require_once('varias_fns.php');
?>
<html>
<head>
<style type="text/css">
<!--
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000066;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
<?php
if (isset($_POST['usuario']) && isset($_POST['clave'])){
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	$conector=ConectarBD();
	$sql="select apellidos, nombres, usuario, clave from usuarios where usuario='$usuario' and clave='$clave'";
	$consulta=EjecuteExec($conector,$sql) or die($sql);
	if(NumFila($consulta)>0){
		if($fila=ObtenerFila($consulta)){
			$_SESSION['clave'] = $fila[3];
			$_SESSION['usuario_valido'] = $fila[2];
			$_SESSION['usuario_activo'] = trim($fila[1]).' '.trim($fila[0]);
		}
		include "sistema.php";
	} else {
		$sistabla1 ="<table width='750' align='center'><tr><td align='center'><span class='Estilo10'>
		SU USUARIO O CLAVE NO COINCIDEN</span></td></tr>";
		$sistabla1.="<tr><td align='center'>
		<a href='index.php'><img src='imagenes/arrowleft.gif' width='16' height='16' border='0'>";
		$sistabla1.="</a></td></tr></table>";
		echo '</br>',$sistabla1;
	}
}
?>

</td>
  </tr>
</table>
</body>
</html>