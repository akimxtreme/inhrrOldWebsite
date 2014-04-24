<?php
session_start();
require_once('varias_fns.php');
do_html_encabezado('');
if (isset($_SESSION['usuario_valido'])){
	$nom=$_SESSION['usuario_valido'];
	$sistabla1 ="<table width='760' align='center'><tr><td align='center'><span class='Estilo10'>USUARIO ACTIVO $nom</span>";
	$sistabla1.="</td></tr></table>";
	echo '</br>',$sistabla1;
?>
<p>
<table width="760"><tr>
<td width="200" valign="top">
	<table bgcolor="#E6F3FF" border="0" cellspacing="0" cellpadding="0" width="220" id="navigation">
	<tr><td width="220" height="30" align="center" bgcolor="#C0DFFD">
	<bold>OPCIONES DE REPORTES </bold>
	</td></tr>
	<tr><td width="220">
	<a href="reportes/lista_protocolos.php?a=2008" target="_blank">PROTOCOLOS CLINICOS 2008</a> 
	</td></tr>
	<tr><td width="220">
	<a href="reportes/lista_protocolos.php?a=2009" target="_blank">PROTOCOLOS CLINICOS 2009</a> 
	</td></tr>
	<tr><td width="220">
	<a href="reportes/lista_protocolos.php?a=2010" target="_blank">PROTOCOLOS CLINICOS 2010</a> 
	</td></tr>
	<tr><td width="220">
	<a href="reportes/lista_protocolos.php?a=2011" target="_blank">PROTOCOLOS CLINICOS 2011</a> 
	</td></tr>
	<tr><td width="220">
	<a href="sistema.php" target="_top">MENU PRINCIPAL</a> 
	</td></tr>
	</table>
</td>
<td width="60" valign="top">&nbsp;<br /></td>
<td width="500" valign="top">
<table width="500" border="0" align="left" cellpadding="0" cellspacing="0">
	<tr>
    <td colspan="3" class="Estilo8" align="left" height="50">REPORTE POR PROTOCOLO CLINICO </td>    
  </tr>
   <form name="form2" method="post" action="reportes/protocolo_clinico.php" target="_blank">
   <tr height="50">
    <td width="160" height="30" div align="left" class="Estilo1">N&uacute;mero de Solicitud </td>
    <td width="400" height="30" colspan="2">
    <input name="num" id="num" type="text" size="40" maxlength="150" style="font-size:9px">
    <input type="image" name="boton_submit" src="imagenes/busca.gif" alt="Buscar">
    Buscar	</td>
  </tr>
    </form>
	</table>
</td>
</td></tr>
</table>
  <?php
} else {
	do_error1();
}
do_html_pie();
?>