<?php
include('funciones.php');
require('fpdf.php');

class PDF extends FPDF
{
//Cabecera de página
function Header()
{
	//Logo
	$this->Image('LogoINH45x57.jpg',20,10);
	//Arial bold 12
	$this->SetFont('Arial','B',10);
	//Movernos a la derecha
	$this->Cell(55);
	//Emblema INHRR
	$this->Cell(70,5,'Instituto Nacional de Higiene',0,1,'C');
	$this->Cell(55);
	$this->Cell(70,5,'"Rafael Rangel"',0,0,'C');
	//Salto de Línea
	$this->Ln(12);
	//Arial bold 12
	$this->SetFont('Arial','B',16);
	//Movernos a la derecha
	$this->Cell(55);
	//Título
	$this->Cell(65,10,'Protocolo Clínico',0,1,'C');
}

//Pie de página
function Footer()
{
	global $fecha;
	//Posición: a 2,1 cm del final
	$this->SetY(-21);
	//Arial italic 8
	$this->SetFont('Arial','B',7);	
	$this->cell(0,4,'F-RCDM-011',0,1,'L');
	//Posición: a 1,8 cm del final
	$this->SetY(-18);
	//Arial italic 8
	$this->SetFont('Arial','B',7);
	$this->cell(0,4,'Novienbre 2010',0,1,'L');
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','B',7);
	//Número de página
	//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	$this->Cell(20,4,'Revisión 0',0,0,'L');
	$this->Cell(140,4,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	$this->Cell(20,4,$fecha,0,0,'R');
	
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF('P','mm','LETTER');
$pdf->SetMargins(20,20,10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//BUSCA TODA LA INFORMACION DE LA DISTRIBUCION
$conn = ConectarBD();
//$sql1 = "select numero, titulo, duracion, nro_pacientes, fecha_aprobacion, cod_estatus, fecha_final from ef_protocoloclinico where numero='".$_GET['cod']."'";
//$sql1 = "select ef_protocoloclinico.numero, ef_protocoloclinico.year, ef_protocoloclinico.fase, ef_protocoloclinico.titulo, ef_protocoloclinico.duracion, ef_protocoloclinico.nro_pacientes, ef_protocoloclinico.fecha_aprobacion, ef_procli_estatus.estatus, ef_protocoloclinico.fecha_final, ef_procli_patrocinantes.entidad, ef_protocoloclinico.observacion from ef_protocoloclinico, ef_procli_estatus, ef_procli_patrocinantes where ef_protocoloclinico.cod_estatus=ef_procli_estatus.codigo and ef_protocoloclinico.cod_entidad=ef_procli_patrocinantes.codigo and ef_protocoloclinico.numero='080022'";
$sql1 = "select ef_protocoloclinico.numero, ef_protocoloclinico.year, ef_protocoloclinico.fase, ef_protocoloclinico.titulo, ef_protocoloclinico.duracion, ef_protocoloclinico.nro_pacientes, ef_protocoloclinico.fecha_aprobacion, ef_procli_estatus.estatus, ef_protocoloclinico.fecha_final, ef_procli_patrocinantes.entidad, ef_protocoloclinico.observacion from ef_protocoloclinico, ef_procli_estatus, ef_procli_patrocinantes where ef_protocoloclinico.cod_estatus=ef_procli_estatus.codigo and ef_protocoloclinico.cod_entidad=ef_procli_patrocinantes.codigo and ef_protocoloclinico.numero='".$_POST['num']."'";
$Resultado1 = EjecuteExec($conn,$sql1) or die($sql1);
	if (NumFila($Resultado1) > 0){
		while ($Fila1 = ObtenerFila($Resultado1)){
		$numero = $Fila1[0];
		$year = $Fila1[1];
		$fase = $Fila1[2];
		$titulo = $Fila1[3];
		$duracion = $Fila1[4];
		$nropacientes = $Fila1[5];
		$fechaaprobacion = $Fila1[6];
		$fechaaprob = ArreglarFecha($fechaaprobacion);
		$estatus = $Fila1[7];
		//$codestatus = $Fila1[5];
		//$estatus=BuscarEstatus($codestatus);
		$fechafinal = $Fila1[8];
		$fechafin = ArreglarFecha($fechafinal);
		$entidad = $Fila1[9];
		$observacion = $Fila1[10];
		$fecha_actual = date('Y-m-d');
		$fecha = ArreglarFecha($fecha_actual);
		}
	}
	
//BUSCAR CENTRO - INVESTIGADOR
$c=0;
$ctroinvest = array();
$sql2="select ef_procli_centros.centro, ef_procli_investigadores.investigador from ef_procli_ctroinv, ef_procli_centros, ef_procli_investigadores where ef_procli_ctroinv.cod_centro=ef_procli_centros.codigo and ef_procli_ctroinv.cod_invppal=ef_procli_investigadores.cedula and ef_procli_ctroinv.numero='$numero'";
$consulta2=EjecuteExec($conn,$sql2) or die($sql2);
if(NumFila($consulta2)>0){
	while($fila2=ObtenerFila($consulta2)){
		$centro=$fila2[0];
		$investigador=$fila2[1];
		$ctroinvest[$c]=$centro.' - '.$investigador;
		$c++;
	}
}
$l1=$c;

//Mostrando los datos en el reporte				

//FILA 1 CELDA 1
$pdf->setXY(20,50);
$pdf->setFont('Arial','B',9);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(60,5,'(1) Numero: ',1,1,'L',0);
//FILA 1 CELDA 2
$pdf->setXY(80,50);
$pdf->Cell(60,5,'(2) Año: ',1,1,'L',0);
//FILA 1 CELDA 3
$pdf->setXY(140,50);
$pdf->Cell(60,5,'(3) Fase Clíninca del Estudio: ',1,1,'L',0);
//FILA 2 CELDA 1
$pdf->setXY(20,55);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(60,5,$numero,0,1,'L',0);
//FILA 2 CELDA 2
$pdf->setXY(80,55);
$pdf->Cell(60,5,$year,0,1,'L',0);
//FILA 2 CELDA 2
$pdf->setXY(140,55);
$pdf->Cell(60,5,$fase,0,1,'L',0);

//FILA 3 CELDA 1
$pdf->setFont('Arial','B',9);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(180,5,'(4) Título: ',1,1,'L',0);
//FILA 4 CELDA 1
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(180,5,$titulo,0,'T',0,'L',0);
//FILA 5
$pdf->Ln(); 
//FILA 6 CELDA 1
$pdf->setXY(20,90);
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(45,5,'(5) Duración:',1,1,'L',0);
//FILA 6 CELDA 2
$pdf->setXY(65,90);
$pdf->Cell(45,5,'(6) Nro. de Pacientes:',1,1,'L',0);
//FILA 6 CELDA 3
$pdf->setXY(110,90);
$pdf->Cell(45,5,'(7) Fecha Aprobación',1,1,'L',0);
//FILA 6 CELDA 4
$pdf->setXY(155,90);
$pdf->Cell(45,5,'(8) Estatus',1,1,'L',0);

//FILA 7 CELDA 1
$pdf->setXY(20,95);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(45,5,$duracion,0,'T','L',0);
//FILA 7 CELDA 2
$pdf->setXY(65,95);
$pdf->MultiCell(45,5,$nropacientes,0,'T','L',0);
//FILA 7 CELDA 3
$pdf->setXY(110,95);
$pdf->MultiCell(45,5,$fechaaprob,0,'T','L',0);
//FILA 7 CELDA 4
$pdf->setXY(155,95);
$pdf->MultiCell(45,5,$estatus,0,'T','L',0);
//FILA 8
$pdf->Ln();
//FILA 9 CELDA 1
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(180,5,'(9) Centros de Investigación e Investigadores Principales:',1,1,'L',0);
//FILA 10 CELDA 1
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
//ESTE FOR IMPRIME TANTOS CENTROS COMO TENGA EL PROTOCOLO
for($c = 0; $c < $l1; ++$c){
	$pdf->Cell(180,5,$ctroinvest[$c],0,1,'L',0);
}

//FILA 11 CELDA 1
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(180,5,'(10) Entidad Patrocinante:',1,1,'L',0);
//FILA 12 CELDA 1
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(180,5,$entidad,0,1,'L',0);

$pdf->Ln(); 
//FILA OBSERVACIONES
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(180,5,'(11) Observación(es): ',1,1,'L',0);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(180,5,$observacion,0,1,'L',0);
$pdf->Ln(); 

//SALTO DE LINEA
$pdf->Ln();
$pdf->Output();
?>