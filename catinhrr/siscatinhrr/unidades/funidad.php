<?php
session_start();
require_once('varias_fns.php');
do_html_encabezado('');
if (isset($_SESSION['usuario_valido'])){
	$nom=$_SESSION['nombre'];
	
?>
<p>&nbsp;</p>
<form name="form1" method="post" action="agunidad.php">
<table width="760" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCFF99" align="center">
<tr  bgcolor="#006600" height="30"><td align="right" class="Estilo11" colspan="3">DATOS DEL TIPO DE PERSONAL &nbsp;</td></tr>
<tr><td colspan="3" align="left">&nbsp;</td></tr>
<tr><td width="30" align="left">&nbsp;</td>
<td width="200" align="left" class="Estilo16" valign="top">
<!--CAMPO CODIGO-->
<div>&nbsp;C&oacute;digo</div><div>&nbsp;<input name="txtCodigo" id="txtCodigo" type="text" size="20" maxlength="20" onChange="LlenarCampos();"></div>
</td>
<td width="530" align="left" class="Estilo16" valign="top">
<!--CAMPOS DINAMICOS-->
<div id="Objeto2">
	<div>&nbsp;Unidad Administrativa</div><div>&nbsp;<input type="text" name="txtUnidad" id="txtUnidad" size="50" maxlength="50"/></div>
</div>
</td></tr>
<tr><td colspan="3" align="left">&nbsp;</td></tr>

<tr height="30"  bgcolor="#006600">
<td colspan="3" class="Estilo9" align="right">
<input type="image" name="boton_submit" src="imagenes/graba.png" alt="Guardar">&nbsp;GUARDAR&nbsp;&nbsp;
<a href="../sistema.php"><img src="imagenes/cancela.png" width="16" height="16" border="0" alt="Cancelar"></a>&nbsp;CANCELAR&nbsp;
</td></tr>
</table>
</form>

<?php
} else {
	do_error1();
}
do_html_pie();
?>