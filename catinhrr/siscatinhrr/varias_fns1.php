<!--ENCABEZADO DEL SISTEMA-->
<?php
function do_html_encabezado(){
?>
<html>
<head>
<title>SITEMA CATINHRR</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Pragma" content="no-cache" />
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
		obHttp.open('get','llenarcampos234.php?ParCed='+ document.getElementById("txtCedula").value,true);
		obHttp.onreadystatechange=function(){
			if(obHttp.readyState==4){
				MiDiv.innerHTML = obHttp.responseText;
			}
		}
		obHttp.send(null);
	}
	</script>
	<link href="calendario/calendar-blue.css" rel="stylesheet" type="text/css">
	<script type="text/JavaScript" language="javascript" src="calendario/calendar.js"></script>
	<script type="text/JavaScript" language="javascript" src="calendario/lang/calendar-sp.js"></script>
	<script type="text/JavaScript" language="javascript" src="calendario/calendar-setup.js"></script>

<style type="text/css">
<!--
.Estilo1 {
	font-size: 10px;
	color: #009900;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo2 {
	font-size: 16px;
	color: #000066;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo3 {
	font-size: 10px;
	color: #000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000066;
}
.Estilo5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo7 {color: #FFFFFF}
.Estilo8 {
	font-size: 12px;
	color: #009900;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo9 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FFFF00;}
.Estilo10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #006600;
	font-weight: bold;
}
.Estilo11 {font-family: Geneva, Arial, Helvetica, sans-serif;
			font-size: 18px;
			color: #FFFFFF;}
.Estilo12 {font-size: 18px; color: #000066; font-family: Arial, Helvetica, sans-serif;}
.Estilo13 {font-family: Arial, Helvetica, sans-serif;
		 font-size: 10px;
		 color: #000066;}
.Estilo14 {font-size: 16px}
.Estilo15 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;}
.Estilo16 {font-size: 14px; color: #000000; font-family: Arial, Helvetica, sans-serif; font-weight: bold;}
.Estilo17 {
	font-size: 12px;
	color: #000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
td {
	font:11px Verdana, Arial, Helvetica, sans-serif;
	color:#003366;
	}
	
a {
	color: #FF6600;
	font-weight:bold;#99CCFF
	}
	
a:hover {
	color: #3366CC;
	}
	

/* ID Styles */
#navigation td {
	border-bottom: 2px solid #91FF91;
	}
	
#navigation a {
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	color: #005D07;
	line-height:16px;
	letter-spacing:.1em;
	text-decoration: none;
	display:block;
	padding:8px 6px 10px 26px;
	background: url("imagenes/punto_verde.png") 14px 45% no-repeat;
	}
	
#navigation a:hover {
	background: #ffffff url("imagenes/punto_verde.png") 14px 45% no-repeat;
	color:#29367C;
	}

.navText {
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	color: #003366;
	line-height:16px;
	letter-spacing:.1em;
	text-decoration: none;
	}

/*FUENTES DE LA PAGINACION*/

a.p:link {
    color: #009900;
    text-decoration: none;
}
a.p:visited {
    color: #FF6600;
    text-decoration: none;
}
a.p:active {
    color: #009900;
    text-decoration: none;
}
a.p:hover {
    color: #009900;
    text-decoration: underline;
}
a.ord:link {
    color: #FFFF00;
	text-decoration: none;
}
a.ord:visited {
    color: #FFFF00;
    text-decoration: none;
}
a.ord:active {
    color: #FFFF00;
    text-decoration: none;
}
a.ord:hover {
    color: #FFFF00;
    text-decoration: underline;
}

-->
</style>
</head>
<body>
<table width="955" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td>
<?php
}
?>

<!--PIE DE PAGINA DEL SISTEMA-->
<?php
function do_html_pie(){
?>
	</td></tr></table>
  </body>
  </html>
<?php
}
?>

<!--ERROR 1:USUARIO NO VALIDO-->
<?php
function do_error1(){
	$tabla1 ="<table width='750' align='center'><tr><td align='center'>";
	$tabla1.="<span class='Estilo10'>USUARIO NO VALIDO</span></td></tr>";
	$tabla1.="<tr><td align='center'><a href='index.php'>";
	$tabla1.="<img src='imagenes/flecha_izq.gif' width='16' height='16' border='0'>";
	$tabla1.="</a></td></tr></table>";
	echo '</br>',$tabla1;
}
?>

<!--ERROR 2:NO HA INTRODUCIDO LOS DATOS COMPLETOS-->
<?php
function do_error2(){
	$tabla1 ="<table width='750' align='center'><tr><td align='center'>";
	$tabla1.="<span class='Estilo10'>NO HA INTRODUCIDO LOS DATOS COMPLETOS. POR FAVOR INTENTE DE NUEVO.</span></td></tr>";
	$tabla1.="<tr><td align='center'><a href='sistema.php'>";
	$tabla1.="<img src='imagenes/flecha_izq.gif' width='16' height='16' border='0'>";
	$tabla1.="</a></td></tr></table>";
	echo '</br>',$tabla1;
}
?>


<!--ERROR 2:NO HA INTRODUCIDO LOS DATOS COMPLETOS-->
<?php
function do_error2_1($pag){
	$tabla1 ="<table width='750' align='center'><tr><td align='center'>";
	$tabla1.="<span class='Estilo10'>NO HA INTRODUCIDO LOS DATOS COMPLETOS. POR FAVOR INTENTE DE NUEVO.</span></td></tr>";
	$tabla1.="<tr><td align='center'><a href='$pag'>";
	$tabla1.="<img src='imagenes/flecha_izq.gif' width='16' height='16' border='0'>";
	$tabla1.="</a></td></tr></table>";
	echo '</br>',$tabla1;
}
?>

<!--ERROR 3:ERROR INGRESANDO LOS DATOS A LA BASE DE DATOS-->
<?php
function do_error3(){
	$tabla1 ="<table width='750' align='center'><tr><td align='center'>";
	$tabla1.="<span class='Estilo10'>ERROR INGRESANDO LOS DATOS A LA BASE DE DATOS</span></td></tr>";
	$tabla1.="<tr><td align='center'>";
	$tabla1.="<a href='javascript:history.back(1)'><img src='imagenes/flecha_izq.gif' width='16' height='16' border='0'></a>";
	//$tabla1.="<a href='fagdoc.php'><img src='../imagenes/flecha_izq.gif' width='16' height='16' border='0'></a>";
	$tabla1.="</td></tr></table>";
	echo '</br>',$tabla1;
}
?>

<!--ERROR 4:DATOS NO EXISTEN O NO COINCIDEN-->
<?php
function do_error4(){
	$tabla1 ="<table width='750' align='center'><tr><td align='center'>";
	$tabla1.="<span class='Estilo10'>DATOS NO EXISTEN O NO COINCIDEN</span></td></tr>";
	$tabla1.="<tr><td align='center'>";
	$tabla1.="<a href='sistema1.php'><img src='imagenes/flecha_izq.gif' width='16' height='16' border='0'></a>";
	$tabla1.="</td></tr></table>";
	echo '</br>',$tabla1;
}
?>

<!--CONTINUAR 1:CONTINUAR-->
<?php
function do_continuar1($pag){
	$tabla ="<table width='750' align='center'><tr><td align='center'>";
	$tabla.="<span class='Estilo10'>CONTINUAR</span></td></tr>";
	$tabla.="<tr><td align='center'><a href='$pag'>";
	$tabla.="<img src='imagenes/flecha_der.gif' width='16' height='16' border='0'>";
	$tabla.="</a></td></tr></table>";
	echo '</br>',$tabla;
}
?>

<!--CONVERTIR FECHA FORMATO ISO-->
<?php
function InvertirFecha ($d_txtfechnac){
		$d_txtfechnac = explode("/",$d_txtfechnac);
		krsort($d_txtfechnac);
		$d_txtfechnac = implode($d_txtfechnac,"-");
		return $d_txtfechnac;
}
?>

<!--CONVERTIR FECHA FORMATO DD/MM/AAAA-->
<?php
function ArreglarFecha ($d_txtfechnac){
		$d_txtfechnac = explode("-",$d_txtfechnac);
		krsort($d_txtfechnac);
		$d_txtfechnac = implode($d_txtfechnac,"/");
		return $d_txtfechnac;
}
?>

<!--NOMBRE DEL CENTRO-->
<?php
function BuscarCentro ($centro){
	$conector=ConectarBD();
	$sql2 = "SELECT centro FROM ef_procli_centros WHERE codigo='$centro'";
	$conCentro=EjecuteExec($conector,$sql2) or die($sql2);
	$fila2=ObtenerFila($conCentro);
	$centro=$fila2[0];
	return $centro;
}
?>

<!--NOMBRE DEL INVESTIGADOR-->
<?php
function BuscarInvestigador ($investigador){
	$conector=ConectarBD();
	$sql3 = "SELECT investigador FROM ef_procli_investigadores WHERE cedula='$investigador'";
	$conInvestigador=EjecuteExec($conector,$sql3) or die($sql3);
	$fila3=ObtenerFila($conInvestigador);
	$investigador=$fila3[0];
	return $investigador;
}
?>



<!--NOMBRE DEL ESTATUS-->
<?php
function BuscarEstatus ($estatus){
	$conector=ConectarBD();
	$sql4 = "SELECT estatus FROM ef_procli_estatus WHERE codigo='$estatus'";
	$conEstatus=EjecuteExec($conector,$sql4) or die($sql4);
	$fila4=ObtenerFila($conEstatus);
	$estatus=$fila4[0];
	return $estatus;
}
?>

<!--NOMBRE DE LA ENTIDAD-->
<?php
function BuscarEntidad ($entidad){
	$conector=ConectarBD();
	$sql5 = "SELECT entidad FROM ef_procli_patrocinantes WHERE codigo='$entidad'";
	$conEntidad=EjecuteExec($conector,$sql5) or die($sql5);
	$fila5=ObtenerFila($conEntidad);
	$entidad=$fila5[0];
	return $entidad;
}
?>

<!--OBTENER DIA DE LA SEMANA-->
<?php
function DiaSemana($d_txtfechnac){
		$d_txtfechnac = explode("-",$d_txtfechnac);//explode convierte una cadena en un array
		$diaSem=$d_txtfechnac[0];
		switch($diaSem){
			case 'Sunday':
				$diaSem='Domingo';
				break;
			case 'Monday':
				$diaSem='Lunes';
				break;
			case 'Tuesday':
				$diaSem='Martes';
				break;
			case 'Wednesday':
				$diaSem='Mi?rcoles';
				break;
			case 'Thursday':
				$diaSem='Jueves';
				break;
			case 'Friday':
				$diaSem='Viernes';
				break;
			case 'Saturday':
				$diaSem='S?bado';
				break;
		}
		return $diaSem;
}
?>

<!--CONECTOR-->
<?php
function ConectarBD(){
  return mysql_connect("172.16.0.10","acruz","10485");
}
?>

<!--EJECUTAR EXEC-->
<?php
function EjecuteExec($conector,$sql){
	mysql_select_db("bdcatinhrr",$conector);
	return mysql_query($sql,$conector);
}
?>

<!--EJECUTAR FETCH-->
<?php
function ObtenerFila($conector){
	return mysql_fetch_row($conector);
}
?>

<!--NUMERO DE FILAS-->
<?php
function NumFila($conector){
	return mysql_num_rows($conector);
}
?>

<!--OBTENER RESULTADO-->
<?php
function ObResultado($conector,$campo,$fila){
	return mysql_result($conector,$campo,$fila);
}
?>


<!--UBICA UNIDAD ADMINISTRATIVA-->
<?php
function BuscarUnidad ($unidad){
	include "cx/cxbdinhrr.php";
	$sql = "SELECT unidades.unidad,unidades.piso,edificios.edificio FROM unidades,edificios WHERE unidades.codunidad='$unidad' AND unidades.codedif=edificios.codedif";
	$ResUnidad=mysql_query($sql,$conectorinhrr);
	if(mysql_num_rows($ResUnidad)>0){
		$campo1 = mysql_fetch_object($ResUnidad);
		$unidad=$campo1->unidad;
		$unidad.=', ';
		$unidad.=$campo1->edificio;
		$unidad.=' Piso ';
		$unidad.=$campo1->piso;
		return $unidad;
	}
}
?>