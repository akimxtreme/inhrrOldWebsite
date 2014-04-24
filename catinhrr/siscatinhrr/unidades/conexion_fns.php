<!--CONECTOR-->
<?php
function ConectarBD(){
  return mysql_connect("172.16.0.10","acruz","10485");
}
?>

<!--EJECUTAR EXEC-->
<?php
function EjecuteExec1($cx,$sql){
	mysql_select_db("bdcatinhrr",$cx);
	return mysql_query($sql,$cx);
}
?>

<!--EJECUTAR EXEC-->
<?php
function EjecuteExec2($cx,$sql){
	mysql_select_db("inhrr",$cx);
	return mysql_query($sql,$cx);
}
?>


<!--EJECUTAR FETCH-->
<?php
function ObtenerFila($cx){
	return mysql_fetch_row($cx);
}
?>

<!--NUMERO DE FILAS-->
<?php
function NumFila($cx){
	return mysql_num_rows($cx);
}
?>

<!--OBTENER RESULTADO-->
<?php
function ObResultado($cx,$campo,$fila){
	return mysql_result($cx,$campo,$fila);
}
?>