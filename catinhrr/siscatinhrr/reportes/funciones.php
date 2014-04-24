<?php

	Function ConectarBD(){
		return mysql_connect("localhost","root","2006");
	}
	Function EjecuteExec($con,$sSQL){
		mysql_select_db("bdryc",$con);
		return mysql_query($sSQL,$con);
	}
	Function ObtenerFila($Curso){
		return mysql_fetch_row($Curso);
	}
	Function NumFila($Curso){
		return mysql_num_rows($Curso);
	}
	Function ObResultado($Curso,$Campo,$Fila){
		return mysql_result($Curso,$Fila,$Campo);
	}
	Function InvertirFecha($d_txtFecnac){
		$d_txtFecnac = explode("/",$d_txtFecnac);
		krsort($d_txtFecnac);
		$d_txtFecnac = implode($d_txtFecnac,"-");
		return $d_txtFecnac;
	}
	Function ArreglarFecha($d_txtFecnac){
		$d_txtFecnac = explode("-",$d_txtFecnac);
		krsort($d_txtFecnac);
		$d_txtFecnac = implode($d_txtFecnac,"/");
		return $d_txtFecnac;
	}
	Function TraerCedula(){
		$cedula = $_POST['cedula'];
		$cedula = (int)$cedula;
		return $cedula;
	}
	Function Ejecute($con,$sSQL){
		mysql_select_db("bdryc",$con);
		return mysql_query($sSQL,$con);
	}
	Function Ejecute2($con,$sSQL){
		mysql_select_db("inhrr",$con);
		return mysql_query($sSQL,$con);
	}
	Function Titulo(){
		$pdf->setFont('Arial','B',10);
		$pdf->SetDrawColor(0,0,0);
	 	$pdf->SetTextColor(0,0,0);
		$pdf->SetLineWidth(0);
	}			
	Function Texto(){			
		$pdf->setFont('Arial','I',10);
		$pdf->SetDrawColor(0,0,0);
	 	$pdf->SetTextColor(0,0,0);
		$pdf->SetLineWidth(0);	
	}	
//NOMBRE DEL USUARIO-->
function BuscarUsuario ($usuario){
	include "cxbdryc.php";
	$sql6 = "SELECT nombres, apellidos FROM usuarios WHERE usuario = '$usuario'";
	$ResUsuario=mysql_query($sql6,$cxryc);
	if(mysql_num_rows($ResUsuario)>0){
		$campo6 = mysql_fetch_object($ResUsuario);
		$persona=trim($campo6->nombres);
		$persona.=', ';
		$persona.=trim($campo6->apellidos);
		$usuario=$persona;
		return $usuario;
	}
}

//CENTRO-->
function BuscarCentro ($centro){
	include "cxbdryc.php";
	$sql7 = "SELECT centro FROM ef_procli_centros WHERE codigo = '$centro'";
	$ResCtro1=mysql_query($sql7,$cxryc);
	if(mysql_num_rows($ResCtro1)>0){
		$campo7 = mysql_fetch_object($ResCtro1);
		$centro=$campo7->centro;
		return $centro;
	}
}

//INVESTIGADOR-->
function BuscarInvestigador ($investigador){
	include "cxbdryc.php";
	$sql8 = "SELECT investigador FROM ef_procli_investigadores WHERE codigo = '$investigador'";
	$ResInv1=mysql_query($sql8,$cxryc);
	if(mysql_num_rows($ResInv1)>0){
		$campo8 = mysql_fetch_object($ResInv1);
		$investigador=$campo8->investigador;
		return $investigador;
	}
}

//ESTATUS-->
function BuscarEstatus ($codest){
	include "cxbdryc.php";
	$sql9 = "SELECT estatus FROM ef_procli_estatus WHERE codigo = '$codest'";
	$ResEst1=mysql_query($sql9,$cxryc);
	if(mysql_num_rows($ResEst1)>0){
		$campo9 = mysql_fetch_object($ResEst1);
		$codest=$campo9->estatus;
		return $codest;
	}
}

?>