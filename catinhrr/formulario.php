<?php
require_once('vfns.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulario de registro</title>
<script language="javascript" type="text/javascript"></script>
	<script language="javascript">
	function LlenarCampos(){
	var obHttp = false;
		MiDiv = document.getElementById("Objeto2");
		
		try{
		
		obHttp = new ActiveXObject("Msxml2.XMLHTTP");
  				}catch(e){
   					try {
    					obHttp = new ActiveXObject("Microsoft.XMLHTTP");
	   				}catch(E){
    					obHttp = false;
   					}
  				}
  				if (!obHttp && typeof XMLHttpRequest!='undefined') {
   					obHttp = new XMLHttpRequest();
  				}				
		obHttp.open('get','llenarcampo.php?ParCod='+ document.getElementById("cedula").value,true);
		obHttp.onreadystatechange=function(){
			if(obHttp.readyState==4){
				MiDiv.innerHTML = obHttp.responseText;
			}
		}
		obHttp.send(null);
	}
	</script>
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
.TextoMensaje {
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	color: #990000;
	}
</style>
</head>
<body>
<form id="form1" name="form1" method="post" action="agregistro.php">
  <table width="560" border="0" class="TextoChiquito">
    <tr>
      <td colspan="2"><img src="imagenes/banner1.png" width="560" height="33" alt="Registrese" /></td>
    </tr>
    <tr>
      <td width="260" align="right">C&eacute;dula de Identidad</td>
      <td width="300"><label for="cedula"></label>
      <input name="cedula" id="cedula" type="text" size="25" onChange="LlenarCampos();"/><br>
	  <div id="Objeto2">
		<div class="TextoMensaje">&nbsp;</div>
	  </div>
	  </td>
    </tr>
    <tr>
      <td align="right">Nombres</td>
      <td><label for="nombre"></label>
      <input type="text" name="nombre1" id="nombre1" size="25" value="Primer Nombre"/>&nbsp;
	  <input type="text" name="nombre2" id="nombre2" size="25" value="Segundo Nombre" /></td>
    </tr>
    <tr>
      <td align="right">Apellidos</td>
      <td><label for="apellido"></label>
      <input type="text" name="apellido1" id="apellido1" size="25" value="Primer Apellido" />&nbsp;
	  <input type="text" name="apellido2" id="apellido2" size="25" value="Segundo Apellido" /></td>
    </tr>
    <tr>
      <td align="right">Direcci&oacute;n</td>
      <td><label for="direccion"></label>
      <input name="direccion" type="text" id="direccion" size="50" /></td>
    </tr>
    <tr>
      <td align="right">Tel&eacute;fono</td>
      <td><label for="telefono"></label>
      <input name="telefono" type="text" id="telefono" size="25" /></td>
    </tr>
    <tr>
      <td align="right">Extensi&oacute;n</td>
      <td><label for="extension"></label>
      <input name="extension" type="text" id="extension" size="25" /></td>
    </tr>
    <tr>
      <td align="right">Correo Electr&oacute;nico</td>
      <td><label for="correo"></label>
      <input name="correo" type="text" id="correo" size="50" /></td>
    </tr>
    <tr>
      <td align="right">Cargo</td>
      <td><label for="cargo"></label>
      <input name="cargo" type="text" id="cargo" size="50" /></td>
    </tr>
    <tr>
      <td align="right">Fecha de Nacimiento</td>
      <td><label for="fechanac"></label>
      <input name="fechanac" type="text" id="fechanac" size="25" value="00/00/0000" /></td>
    </tr>
    <tr>
      <td align="right">Ubicaci&oacute;n F&iacute;sica INHRR</td>
      <td><label for="ubica"></label>
	  <?php
	  $conector=ConectarBD();
	  $sql="SELECT codunidad, unidad FROM unidades ORDER BY unidad ASC";
	  $consulta=EjecuteExec($conector,$sql) or die($sql);
	  if(NumFila($consulta)>0){
	  ?>
      <SELECT name="ubica" id="ubica" style="font-size:9px">
	  <OPTION value="">Seleccione Unidad...</OPTION>
	  <?php
	  while($campo = mysql_fetch_object($consulta)){
			$select = "";
		?>
			<OPTION value="<?php echo $campo->codunidad;?>"><?php echo $campo->unidad;?></OPTION>
		<?php
		}
	   }
	?>
	</SELECT>
	  <!--<input name="ubica" type="text" id="ubica" size="50" />-->
	  </td>
    </tr>
    <tr>
      <td align="right">Clave</td>
      <td><label for="clave"></label>
      <input type="password" name="clave" id="clave" size="25" /></td>
    </tr>
	<tr>
      <td align="right">Confirmar Clave</td>
      <td><label for="clave"></label>
      <input type="password" name="confirmarClave" type="text" id="clave" size="25" /></td>
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
