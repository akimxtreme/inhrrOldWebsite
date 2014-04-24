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
	$this->Cell(65,10,'Distribución de Documentos Controlados',0,1,'C');
}

//Pie de página
function Footer()
{
	global $fecha;
	//Posición: a 2,1 cm del final
	$this->SetY(-21);
	//Arial italic 8
	$this->SetFont('Arial','B',7);	
	$this->cell(0,4,'L-PEGC-004',0,1,'L');
	//Posición: a 1,8 cm del final
	$this->SetY(-18);
	//Arial italic 8
	$this->SetFont('Arial','B',7);
	$this->cell(0,4,'Marzo 2007',0,1,'L');
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','B',7);
	//Número de página
	//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	$this->Cell(20,4,'Revisión 2',0,0,'L');
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
$sql1 = "select codigo, nrorevision, codunidades, observacion, ingreso, usuario from distribucion where codigo='".$_GET['cod']."'";
$Resultado1 = Ejecute($conn,$sql1) or die($sql1);
	if (NumFila($Resultado1) > 0){
		while ($Fila1 = ObtenerFila($Resultado1)){
		$codigo = $Fila1[0];
		$nrorevision = $Fila1[1];
		$codunid = $Fila1[2];
		$observacion = $Fila1[3];
		$ingreso = $Fila1[4];
		$ing=substr($ingreso,0,10);
		$ing=ArreglarFecha($ing);
		$usuario = $Fila1[5];
		//$usuario=BuscarUsuario($usuario);
		$fecha_actual = date('Y-m-d');
		$fecha_arreglada = ArreglarFecha($fecha_actual);w.google.co.ve/
		$fecha=$fecha_arreglada;
		}
	}
//BUSCAR TITULO		
$sql7 = "select titulo from documentos where codigo ='".$_GET['cod']."'";
$ResTitulo= Ejecute($conn,$sql7) or die($sql7);
if(NumFila($ResTitulo)>0){
	$Fila1 = ObtenerFila($ResTitulo);
	$titulo = $Fila1[0];		
}
//BUSCO CADA UNIDAD QUE REPARTIO L$usuarioAS COPIAS		
$copias = explode(",",$codunid);

for($c = 0, $l = count($copias); $c < $l; ++$c){
	$copuni = explode(".",$copias[$c]);
	$num[$c]=$copuni[0];
	$codu[$c]=$copuni[1];
	//BUSCAR UNIDAD
	$sqlunidad = "select unidad from unidades where codunidad='$copuni[1]'";
	$Resultado2 = Ejecute($conn,$sqlunidad) or die($sqlunidad);
	if (NumFila($Resultado2) > 0){
		$Fila2 = ObtenerFila($Resultado2);
		$unid[$c] = $Fila2[0];
		
		
	}
}
$l=$c;

//BUSCA NOMBRE Y APELLIDO DEL USUARI
//$sql6 = "select nombres, apellidos from usuarios where usuario = '$usuario'";
//$ResUsuario= Ejecute2($conn,$sql6) or die($sql6);
//if(NumFila($ResUsuario)>0){
	//$Fila3 = ObtenerFila($ResUsuario);
	//$nombre = $Fila3[0];
	//$apellido = $Fila3[1];			
//}

//Mostrando los datos en el reporte				

//FILA 1 CELDA 1
$pdf->setXY(20,50);
$pdf->setFont('Arial','B',9);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(25,5,'(1) Código: '."\n".$codigo,1,'T',0,'L',0);
//FILA 2 CELDA 1
$pdf->setXY(45,50);
$pdf->setFont('Arial','B',9);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(155,5,'(2) Título del Documento: '."\n".$titulo.', Revisión '.$nrorevision,1,'T',0,'R',0);
//FILA 3
$pdf->Ln(); 
//FILA 4 CELDA 1
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(25,5,'(3) Cód.Área:',1,0,'C',0);
//FILA 4 CELDA 2
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(75,5,'(4) Nro. de C/C y Nombre del Área:',1,0,'C',0);
//FILA 4 CELDA 3
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(30,5,'(5) Receptor',1,0,'C',0);
//FILA 4 CELDA 4
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(25,5,'(6) Firma',1,0,'C',0);
//FILA 4 CELDA 5
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(25,5,'(7) Fecha',1,1,'C',0);

//ESTE FOR IMPRIME TANTAS LINEAS COMO COPIAS HALLAN DEL DOCUMENTO
for($c = 0; $c < $l; ++$c){
//FILA 5 CELDA 1
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(25,10,$codu[$c],1,0,'C',0);
//FILA 5 CELDA 2
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(75,10,$num[$c].'. '.$unid[$c],1,0,'L',0);
//FILA 5 CELDA 3
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(30,10,' ',1,0,'L',0);
//FILA 5 CELDA 4
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(25,10,' ',1,0,'L',0);
//FILA 5 CELDA 5
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->Cell(25,10,' ',1,1,'L',0);
}
$pdf->Ln(); 
//FILA OBSERVACIONES
$pdf->setFont('Arial','B',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(180,5,'(8) Observación(es): '."\n".$observacion,1,1,'L',0);
$pdf->Ln(); 

//FILA FIRMAS CELDA 1
$pdf->setXY(20,240);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(60,5,'(9) Fecha: '."\n".$ing,1,'T',0,'L',0);
//FILA FIRMAS CELDA 2
$pdf->setXY(80,240);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(60,5,'(10) Elaborado Por: '."\n".' ',1,'T',0,'C',0);
//FILA FIRMAS CELDA 3
$pdf->setXY(140,240);
$pdf->setFont('Arial','',8);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.1);
$pdf->MultiCell(60,5,'(11) Revisado Por: '."\n".' ',1,'T',0,'R',0);
//SALTO DE LINEA
$pdf->Ln();
$pdf->Output();
?>