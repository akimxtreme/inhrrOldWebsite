<?php
require_once('vfns.php');
?>
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
<form id="form1" name="form1" method="post" action="cambio.php">
  <table width="560" border="0" class="TextoChiquito">
    <tr>
      <td colspan="2"><img src="imagenes/banner1.png" width="560" height="33"/></td>
    </tr>
    <tr>
      <td width="260" align="right">C&eacute;dula de Identidad</td>
      <td width="300"><label for="cedula"></label>
      <input name="cedula" type="text" id="cedula" size="25" /></td>
    </tr>
    <tr>
      <td align="right">Primer Nombre</td>
      <td><label for="nombre"></label>
      <input type="text" name="nombre1" id="nombre1" size="50" /></td>
    </tr>
    <tr>
      <td align="right">Primer Apellido</td>
      <td><label for="apellido"></label>
      <input type="text" name="apellido1" id="apellido1" size="50" /></td>
    </tr>
   	<tr>
      <td align="right">¿Cu&aacute;l es tu color favorito?</td>
      <td><input type="text" name="repuesta1" id="pregunta1" size="50" /></td>
    </tr>
	<tr>
      <td align="right">¿Cu&aacute;l es el apellido de soltera de su mamá?</td>
      <td><input type="text" name="repuesta2" id="pregunta2" size="50" /></td>
    </tr>
	<tr>
      <td align="right">¿En qu&eacute; ciudad Ud. naci&oacute;?</td>
      <td><input type="text" name="repuesta3" id="pregunta3" size="50" /></td>
    </tr>
	<tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="enviar" id="enviar" value="Enviar"/>
      <input type="reset" name="Limpiar" id="Limpiar" value="Limpiar" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><pre>* Todos los campos son Obligatorios</pre></td>
    </tr>
  </table>
</form>
</body>
</html>