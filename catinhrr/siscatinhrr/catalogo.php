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
	<table bgcolor="#CCFF99" border="0" cellspacing="0" cellpadding="0" width="220" id="navigation">
	<tr><td width="220" height="30" align="center" bgcolor="#009900" class="Estilo7">
	<bold>OPCIONES DE CATALOGO </bold>
	</td></tr>
	<tr><td width="220">
	<a href="unidades/funidad.php" target="_top">UNIDADES ADMINISTRATIVAS</a> 
	</td></tr>
	<tr><td width="220">
	<a href="tipopersonal/ftipo_personal.php" target="_top">TIPOS DE PERSONAL</a> 
	</td></tr>
	<tr><td width="220">
	<a href="fagedificio.php" target="_top">EDIFICIOS</a> 
	</td></tr>
	<?php
	if(($nom=='acruz')||($nom=='ACRUZ')){
	?>
	<tr><td width="220">
	<a href="usuarios/fusuario.php" target="_top">USUARIOS DEL SISTEMA</a> 
	</td></tr>
	<?php
	}
	?>
	<tr><td width="220">
	<a href="sistema.php" target="_top">MENU PRINCIPAL</a> 
	</td></tr>
	</table>
</td>
<td width="60" valign="top">&nbsp;<br /></td>
<td width="500" valign="top">
<table width="500" border="0" align="left" cellpadding="0" cellspacing="0">
	<tr>
    <td colspan="3" class="Estilo8" align="left" height="50">CONSULTAR UNIDADES ADMINISTRATIVAS</td>    
  	</tr>
   <form name="form2" method="post" action="consulta2.php" target="_top">
   <tr height="50">
    <td width="160" height="30" div align="left" class="Estilo1">Término de Búsqueda</td>
    <td width="400" height="30" colspan="2" class="Estilo1">
    <input name="criterio" type="text" size="40" maxlength="150" style="font-size:9px">
    <input type="image" name="boton_submit" src="imagenes/busca.gif" alt="Buscar">
    Buscar
	</td>
  </tr>
    </form>
	<tr>
    <td colspan="3" class="Estilo8" align="left" height="50">CONSULTAR TIPOS DE PERSONAL</td>    
  </tr>
   <form name="form2" method="post" action="consulta3.php" target="_top">
   <tr height="50">
    <td width="160" height="30" div align="left" class="Estilo1">Término de Búsqueda</td>
    <td width="400" height="30" colspan="2" class="Estilo1">
    <input name="criterio" type="text" size="40" maxlength="150" style="font-size:9px">
    <input type="image" name="boton_submit" src="imagenes/busca.gif" alt="Buscar">
    Buscar
	</td>
  </tr>
    </form>
	<tr>
    <td colspan="3" class="Estilo8" align="left" height="50">CONSULTAR EDIFICIOS</td>    
  </tr>
   <form name="form3" method="post" action="consulta4.php" target="_top">
   <tr height="50">
    <td width="160" height="30" div align="left" class="Estilo1">Término de Búsqueda</td>
    <td width="400" height="30" colspan="2" class="Estilo1">
    <input name="criterio" type="text" size="40" maxlength="150" style="font-size:9px">
    <input type="image" name="boton_submit" src="imagenes/busca.gif" alt="Buscar">
    Buscar
	</td>
  </tr>
     </form>
	 <?php
	 if(($nom=='acruz')||($nom=='ACRUZ')){
	 ?>
	<tr>
    <td colspan="3" class="Estilo8" align="left" height="50">CONSULTAR USUARIOS</td>    
  </tr>
   <form name="form3" method="post" action="consulta5.php" target="_top">
   <tr height="50">
    <td width="160" height="30" div align="left" class="Estilo1">Término de Búsqueda</td>
    <td width="400" height="30" colspan="2" class="Estilo1">
    <input name="criterio" type="text" size="40" maxlength="150" style="font-size:9px">
    <input type="image" name="boton_submit" src="imagenes/busca.gif" alt="Buscar">
    Buscar
	</td>
  </tr>
    </form>
	<?php
	}
	?>
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