<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="imagenes/inh.ico" type="image/x-icon" />
<title>Caja de Ahorro de los Trabajadores del INHRR</title>
<link rel="stylesheet" href="imagenes/estilo1.css" type="text/css" />
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">
<tr><td valign="top">
<!--ENCABEZADO-->
<?php
include_once('encabezado.php');
?>
</td></tr>
<tr><td valign="top">
<!--CUERPO-->
	<table width="955" height="95%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#91FF91">
	<tr><td width="165" height="600" valign="top" bgcolor="#CCFF99">
	<!--MENU IZQUIERDO-->
	<?php
	include_once('menu_izquierdo.php');
	?>
	</td>
  	<td width="10" bgcolor="#91FF91">&nbsp;<br /></td>
	<td width="570" bgcolor="#91FF91" valign="top">
	<!--CONTENIDO-->
	<IFRAME id=con name=contenido1 marginWidth=0 marginHeight=0 src="contenido.php" frameBorder=0 width=570 height=570 scrolling="index">
    </IFRAME>
	</td>
  	<td width="10">&nbsp;<br /> </td>
	<td width="190" valign="top" align="center bgcolor="#91FF91">
	<!--MENU DERECHO-->
	<?php
	include_once('menu_derecho.php');
	?>	
	</td>
	<td width="10">&nbsp;<br /> </td>
	</tr>
	</table>
		
</td></tr>
<tr><td valign="top">
<!--PIE-->
<?php
include_once('pie_pagina.php');
?>	
</td></tr>
</table>
</body>
</html>