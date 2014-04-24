<?php
session_start();
require_once('varias_fns.php');
do_html_encabezado('');
if (isset($_SESSION['usuario_valido'])){
	$nom=$_SESSION['usuario_activo'];
	$sistabla1 ="<table width='760' align='center'><tr><td align='center'><span class='Estilo10'>BIENVENIDO $nom</span>";
	$sistabla1.="</td></tr></table>";
	echo '</br>',$sistabla1;
?>
<p>
<table width="760"><tr>
<td width="200" valign="top">
	<table bgcolor="#CCFF99" border="0" cellspacing="0" cellpadding="0" width="220" id="navigation">
	<tr><td width="220" height="30" align="center" bgcolor="#009900" class="Estilo7">
	<bold>OPCIONES DE MENU </bold>
	</td>
	</tr>
	<tr><td width="220">
	<a href="salir.php" target="_top">SALIR DEL SISTEMA</a> 
	</td></tr>
	<tr><td width="220">
	<a href="manual.php" target="_top">MANUAL DEL SISTEMA</a> 
	</td></tr>
	<tr><td width="220">
	<a href="catalogo.php" target="_top">CATALOGOS</a> 
	</td></tr>
	<!--
	<tr><td width="220">
	<a href="fagprotocolo.php" target="_top">REGISTRAR PROTOCOLO CLINICO</a> 
	</td></tr>
	-->
	<tr><td width="220">
	<a href="reportes.php" target="_top">REPORTES</a> 
	</td></tr>
	
	</table>
</td>
<td width="60" valign="top">&nbsp;<br /></td>
<td width="500" valign="top">
<table width="500" border="0" align="left" cellpadding="0" cellspacing="0">
	<tr>
    <td colspan="3" class="Estilo8" align="left" height="50">CONSULTAR DE ESTADOS DE CUENTAS SOCIOS</td>    
  </tr>
  <!--
  <form name="form1" method="post" action="consulta.php" target="_top">
  <tr height="50">
    <td width="160" height="30" div align="left" class="Estilo1">Fecha Protocolo Clínico</td>
    <td width="400" height="30" colspan="2">
	<input name="criterio" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" readonly>
	<img src="imagenes/calendario.png" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
    <script type="text/javascript">
		Calendar.setup(
			{
				inputField : "fecha",
				ifFormat   : "%d/%m/%Y",
				button     : "Image1"
			}
		);
	</script>
	<input type="image" name="boton_submit" src="imagenes/busca.gif" alt="Buscar">Buscar
	</td>
  </tr>
   </form>
   -->
    <form name="form2" method="post" action="consulta1.php" target="_top">
   <tr height="50">
    <td width="160" height="30" div align="left" class="Estilo1">Término de Búsqueda</td>
    <td width="400" height="30" colspan="2" class="Estilo1">
    <input name="criterio" type="text" size="40" maxlength="150" style="font-size:9px">
    <input type="image" name="boton_submit" src="imagenes/busca.gif" alt="Buscar">
    Buscar
	</td>
  </tr>
    </form>
	</table>
</td>
</td></tr>
<tr><td colspan="3" align="center">
<p>&nbsp;<br /></p>

	<IFRAME id=con name=contenido marginWidth=0 marginHeight=0 src="consulta6.php" frameBorder=0 width=955 scrolling=index height=550></IFRAME>

</td></tr></table>
  <?php
} else {
	do_error1();
}
do_html_pie();
?>