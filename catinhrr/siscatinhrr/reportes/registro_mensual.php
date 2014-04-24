<?php
include('funciones.php');
require('fpdf.php');
$m=$_GET['m'];
$mes=BuscarMes($m);
$year=$_GET['a'];

class PDF extends FPDF
{
//Cabecera de pagina
function Header()
{
	global $conn;
	global $mes;
	global $year;
	$conn = ConectarBD();
	//Arial bold 6
	$this->SetFont('Arial','',5);
	//Fecha Registros
	$this->Cell(250,5,$mes.' '.$year,0,1,'R');	
	//Arial bold 8
	$this->SetFont('Arial','B',8);
	//Titulo
	$this->Cell(250,5,'REGISTRO MENSUAL DE EXPEDIENTES DE PRODUCTOS COSMETICOS',0,1,'C');
	//Salto de Linea
	$this->Ln();
	//Titulos de las Columnas
	//COLUMNA 1
	$this->setXY(20,30);
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(20,5,'(1) FECHA ENTRADA',1,0,'C',0);
	//COLUMNA 2
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(10,5,'(2) PCR',1,0,'C',0);
	//COLUMNA 3
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(20,5,'(3) No. M.S.',1,0,'C',0);
	//COLUMNA 4
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(15,5,'(4) RSPC',1,0,'C',0);
	//COLUMNA 5
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(10,5,'(5) INC',1,0,'C',0);
	//COLUMNA 6
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(10,5,'(6) RA',1,0,'C',0);
	//COLUMNA 7
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(30,5,'(7) NOMBRE DEL PATROCINANTE',1,0,'C',0);
	//COLUMNA 8
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(65,5,'(8) NOMBRE DEL PRODUCTO',1,0,'C',0);
	//COLUMNA 9
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(20,5,'(9) No. DE VARIANTES',1,0,'C',0);
	//COLUMNA 10
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(15,5,'(10) PAGO (BSF)',1,0,'C',0);
	//COLUMNA 11
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(35,5,'(11) EMPRESA',1,1,'C',0);										
}

//Pie de pagina
function Footer()
{
	global $fecha;
	//Posicion: a 2,1 cm del final
	//$this->SetY(-21);
	//Arial italic 6
	//$this->SetFont('Arial','B',6);	
	//$this->cell(0,4,'L-DMRO-000',0,1,'L');
	//Posicion: a 1,8 cm del final
	$this->SetY(-18);
	//Arial italic 8
	$this->SetFont('Arial','',6);
	//$this->cell(0,4,'Abril 2010',0,1,'L');
	$this->Cell(250,4,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
	//Posicion: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','',6);
	//Numero de pagina
	//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	//$this->Cell(83,4,'Revision 0',0,0,'L');
	//$this->Cell(83,4,' ',0,0,'L');
	//$this->Cell(83,4,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
	$this->Cell(250,4,$fecha,0,0,'R');
	
}
}

//Creacion del objeto de la clase heredada
$pdf=new PDF('L','mm','letter');
$pdf->SetMargins(20,20,10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$c=0;
$total=0;
//BUSCA TODA LA INFORMACION DE LOS EXPEDIENTES
$sql1 = "select entrada, pcr, nro_ms, rspc, inc, ra, patrocinante, producto, variantes, monto, empresa from expcosmeticos where YEAR(entrada)='".$_GET['a']."' and MONTH(entrada)='".$_GET['m']."' order by entrada";
//$sql1 = "select entrada, pcr, nro_ms, rspc, inc, ra, patrocinante, producto, variantes, monto, empresa from expcosmeticos where YEAR(entrada)='2010' and MONTH(entrada)='01' order by entrada";
$ResReg = Ejecute($conn,$sql1) or die($sql1);
if (NumFila($ResReg) > 0){
	while ($Fila2 = ObtenerFila($ResReg)){
		$fec_entrada = $Fila2[0];
		$entrada[$c]=ArreglarFecha($fec_entrada);
		$pcr[$c] = $Fila2[1];
		$nro_ms[$c] = $Fila2[2];
		$rspc[$c] = $Fila2[3];
		$inc[$c] = $Fila2[4];
		$ra[$c] = $Fila2[5];
		$patrocinante[$c] = $Fila2[6];
		$producto[$c] = $Fila2[7];
		$variante[$c] = $Fila2[8];
		$monto[$c] = $Fila2[9];
		$empresa[$c] = $Fila2[10];
		$total=$total+$monto[$c];
		$c++;
	}
}
$fecha_actual = date('d/m/Y');
$fecha =  $fecha_actual;
$l=$c;
$y=35;
//ESTE FOR IMPRIME TANTAS LINEAS COMO REGISTROS HALLAN
for($c = 0; $c < $l; ++$c){
$n=$c+1;
//FILA 4 CELDA 1
$pdf->setXY(20,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(20,5,$entrada[$c],'T',0,'C',0);
//FILA 4 CELDA 2
$pdf->setXY(40,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(10,5,$pcr[$c],'T',0,'C',0);
//FILA 4 CELDA 3
$pdf->setXY(50,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(20,5,$nro_ms[$c],'T','C',0);
//FILA 4 CELDA 4
$pdf->setXY(70,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(15,5,$rspc[$c],'T','C',0);
//FILA 4 CELDA 5strlen
$pdf->setXY(85,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1); 	
$pdf->MultiCell(10,5,$inc[$c],'T','C',0);
//FILA 4 CELDA 6
$pdf->setXY(95,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(10,5,$ra[$c],'T','C',0);
//FILA 4 CELDA 7
$pdf->setXY(105,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(30,5,$patrocinante[$c],'T','C',0);
//FILA 4 CELDA 8
$pdf->setXY(135,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(65,5,$producto[$c],'T','C',0);
//FILA 4 CELDA 9
$pdf->setXY(200,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(20,5,$variante[$c],'T','C',0);
//FILA 4 CELDA 10
$pdf->setXY(220,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(15,5,$monto[$c],'T','C',0);
//FILA 4 CELDA 11 
$pdf->setXY(235,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(35,5,$empresa[$c],'T','C',0);
if((strlen($producto[$c])>145)||(strlen($variante[$c])>42)){
	$y=$y+10;
}elseif(strlen($producto[$c])>77){
	$y=$y+5;
}
if(strlen($producto[$c])>175){
	$y=$y+5;
}
if($y>=180){
	$y=35;
	$pdf->AddPage();
}else{
	$y=$y+10;
}
}
//FILA RESUMEN
$pdf->setXY(20,$y);
$pdf->setFont('Arial','B',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
//$pdf->SetLineWidth(.1);
$pdf->Cell(250,5,' TOTAL SOLICITUDES RECIBIDAS: '.$l.'     TOTAL BSF: '.number_format($total,2),1,1,'R');
$pdf->Output();
?>