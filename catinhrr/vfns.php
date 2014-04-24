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
	$tabla1 ="<table width='570' align='center'><tr><td align='center'>";
	$tabla1.="<span class='Estilo10'>NO HA INTRODUCIDO LOS DATOS COMPLETOS. POR FAVOR INTENTE DE NUEVO.</span></td></tr>";
	$tabla1.="<tr><td align='center'><a href='formulario.php'>";
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
	$tabla1 ="<table width='570' align='center'><tr><td align='center'>";
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
	$tabla ="<table width='570' align='center'><tr><td align='center'>";
	$tabla.="<span class='Estilo10'>CONTINUAR</span></td></tr>";
	$tabla.="<tr><td align='center'><a href='$pag' target='_top'>";
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