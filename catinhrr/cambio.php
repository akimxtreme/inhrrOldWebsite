<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#form1 table tr td {
	font-family: Arial, Helvetica, sans-serif;
}
#form1 table tr td pre {
	font-family: Tahoma, Geneva, sans-serif;
}
.TextoChiquito {
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	color: #005D07;
	}
</style>
</head>
<body>
<?php
require_once('vfns.php');

$Cedula = $_POST['cedula'];
$Apellido1 = $_POST['apellido1'];
$Nombre1 = $_POST['nombre1'];
$repuesta1 = $_POST['repuesta1'];
$repuesta2 = $_POST['repuesta2'];
$repuesta3 = $_POST['repuesta3'];

$Cedula = trim($Cedula);
$Apellido1 = trim($Apellido1);
$Nombre1 = trim($Nombre1);
$repuesta1 = trim($repuesta1);
$repuesta2 = trim($repuesta2);
$repuesta3 = trim($repuesta3);

$fecha = date('Y-m-d');

$Cedula = (int)$Cedula;

if (!$Cedula || !$Apellido1 || !$Nombre1 || !$repuesta1 || !$repuesta2  || !$repuesta3){
	do_error2();
	exit;
}
if (!get_magic_quotes_gpc()){
   	$Apellido1 = addslashes($Apellido1);
	$Nombre1 = addslashes($Nombre1);
	$repuesta1 = addslashes($repuesta1);
	$repuesta2 = addslashes($repuesta2);
	$repuesta3 = addslashes($repuesta3);
}
$Apellido1 = strtoupper($Apellido1);
$Nombre1 = strtoupper($Nombre1);
$repuesta1 = strtoupper($repuesta1);
$repuesta2 = strtoupper($repuesta2);
$repuesta3 = strtoupper($repuesta3);

$conector=ConectarBD();
$sql1="SELECT cedula, apellido1, nombre1, clave FROM registrados WHERE cedula = $Cedula AND apellido1='$Apellido1' AND nombre1='$Nombre1' AND repuesta1='$repuesta1' AND repuesta2='$repuesta2' AND repuesta3='$repuesta3'";
$consulta1=EjecuteExec($conector,$sql1) or die($sql1);
if(NumFila($consulta1)>0){
	$campo1 = mysql_fetch_object($consulta1);
	$ced = $campo1->cedula;
	$ape = $campo1->apellido1;
	$nom = $campo1->nombre1;
?>	
	
<form id="form1" name="form1" method="post" action="gcambio.php">
  <table width="560" border="0" class="TextoChiquito">
    <tr>
      <td colspan="2"><img src="imagenes/banner1.png" width="560" height="33"/></td>
    </tr>
    <tr>
      <td width="260" align="right">C&eacute;dula de Identidad</td>
      <td width="300"><label for="cedula"></label>
      <input name="cedula" type="text" id="cedula" size="25" value="<?php echo $ced;?>" readonly/></td>
    </tr>
    <tr>
      <td align="right">Primer Nombre</td>
      <td><label for="nombre"></label>
      <input type="text" name="nombre1" id="nombre1" size="50" value="<?php echo $ape;?>" readonly/></td>
    </tr>
    <tr>
      <td align="right">Primer Apellido</td>
      <td><label for="apellido"></label>
      <input type="text" name="apellido1" id="apellido1" size="50" value="<?php echo $nom;?>" readonly/></td>
    </tr>
	<tr>
      <td align="right">Clave</td>
      <td><label for="clave"></label>
      <input type="password" name="clave" id="clave" size="25" /></td>
    </tr>
	<tr>
      <td align="right">Confirmar Clave</td>
      <td><label for="clave"></label>
      <input type="password" name="confirmarClave" id="confirmarClave" size="25" /></td>
    </tr>
	<tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="enviar" id="enviar" value="Enviar"/>
      <input type="reset" name="Limpiar" id="Limpiar" value="Limpiar" /></td>
    </tr>
  </table>
</form>
	
<?php	
}
?>
</body>
</html>