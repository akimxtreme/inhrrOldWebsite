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
	$this->Cell(100);
	//Título
	$this->Cell(65,10,'DECRETO 1.808 DEL 23/04/97 GACETA OFICIAL NO. 36.203 DEL 12/05/1997',0,1,'C');
	//Salto de Línea
	$this->Ln(3);
	//Unidad Administrativa
	$this->setFont('Arial','B',10);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->MultiCell(320,5,'DEPARTAMENTO DE TESORERIA',1,'T',0,'L',0);
	$this->Ln();
	//Titulos de las Columnas
	//COLUMNA 1
	$this->setXY(20,65);
	$this->setFont('Arial','B',8);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(185,5,'CONCEPTO DEL PAGO',1,0,'C',0);
	//COLUMNA 2
	$this->setFont('Arial','B',8);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(30,5,'BASE IMPONIBLE',1,0,'C',0);
	//COLUMNA 3
	$this->setFont('Arial','B',8);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(50,5,'TARIFA',1,0,'C',0);
	//COLUMNA 4
	$this->setFont('Arial','B',8);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(30,5,'PAGOS MAYORES A',1,0,'C',0);
	//COLUMNA 5
	$this->setFont('Arial','B',8);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(100,5,'CONCEPTO INHRR',1,0,'C',0);
	//COLUMNA 6
	$this->setFont('Arial','B',8);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(30,5,'PORCENTAJE',1,1,'C',0);	
}

//Pie de página
function Footer()
{
	global $fecha;
	//Posición: a 2,1 cm del final
	$this->SetY(-21);
	//Arial italic 8
	$this->SetFont('Arial','B',7);	
	$this->cell(0,4,'L-DFTE-001',0,1,'L');
	//Posición: a 1,8 cm del final
	$this->SetY(-18);
	//Arial italic 8
	$this->SetFont('Arial','B',7);
	$this->cell(0,4,'Octubre 2010',0,1,'L');
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','B',7);
	//Número de página
	//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	$this->Cell(107,4,'Revisión 0',0,0,'L');
	$this->Cell(107,4,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	$this->Cell(106,4,$fecha,0,0,'R');
	
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF('L','mm','legal');
$pdf->SetMargins(20,20,10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$c=0;
$conn=ConectarBD;
//BUSCA TODA LA INFORMACION DE LA DISTRIBUCION
$sql1 = "select codigo, numeral, literal, concepto_pago, subconcepto_pago, concepto_inhrr, imponible, tarifa, mayores, porcentaje from impuestos where decreto='1808' order by codigo";
$ResDecreto = EjecuteExec($conn,$sql1) or die($sql1);
if (NumFila($ResDecreto) > 0){
	while ($Fila1 = ObtenerFila($ResDecreto)){
		$codigo[$c] = $Fila1[0];
		$numeral[$c] = $Fila1[1];
		$literal[$c] = $Fila1[2];
		$concepto_pago[$c] = $Fila1[3];
		$subconcepto_pago[$c] = $Fila1[4];
		$concepto_inhrr[$c] = $Fila1[5];
		$imponible[$c] = $Fila1[6];
		$tarifa[$c] = $Fila1[7];
		$mayores[$c] = $Fila1[8];
		$porcentaje[$c] = $Fila1[9];	
		$c++;
	}
}
$fecha_actual = date('d/m/Y');
$fecha =  $fecha_actual;
$l=$c;
$y=70;
//ESTE FOR IMPRIME TANTAS LINEAS COMO REGISTROS HALLAN
for($c = 0; $c < $l; ++$c){
$n=$c+1;
//FILA 4 CELDA 1
$pdf->setXY(20,$y);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(185,5,$codigo[$c].' '.$numeral[$c].' '.$literal[$c].' '.$concepto_pago[$c].' '.$subconcepto_pago[$c],'T','L',0);
//FILA 4 CELDA 2
$pdf->setXY(205,$y);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(30,5,$imponible[$c],'T','C',0);
//FILA 4 CELDA 3
$pdf->setXY(235,$y);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(50,5,$tarifa[$c],'T','L',0);
//FILA 4 CELDA 4
$pdf->setXY(285,$y);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(30,5,$mayores[$c],'T',0,'C',0);
//FILA 4 CELDA 5
$pdf->setXY(265,$y);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(25,5,$concepto_inhrr[$c],'T',0,'C',0);
//FILA 4 CELDA 6
$pdf->setXY(290,$y);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(50,5,$porcentaje[$c],'T',1,'L',0);
if($y>=180){
	$y=70;
	$pdf->AddPage();
}else{
	$y=$y+10;
}
}
$pdf->Output();
?>