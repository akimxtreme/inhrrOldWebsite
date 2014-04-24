<?php
include('funciones.php');
require('fpdf.php');
//$m=$_GET['m'];
//$mes=BuscarMes($m);
$year_encabezado=$_GET['a'];

class PDF extends FPDF
{
//Cabecera de pagina
function Header()
{
	global $conn;
	global $mes;
	global $year_encabezado;
	$conn = ConectarBD();
	//Arial bold 6
	$this->SetFont('Arial','',5);
	//Fecha Registros
	//$this->Cell(250,5,$mes.' '.$year,0,1,'R');	
	//Arial bold 8
	$this->SetFont('Arial','B',10);
	//Titulo
	$this->Cell(300,5,'LISTADO DE PROTOCOLOS CLINICOS'.' '.$year_encabezado,0,1,'C');
	//Salto de Linea
	$this->Ln();
	//Titulos de las Columnas
	//COLUMNA 1
	$this->setXY(20,30);
	$this->setFont('Arial','B',5);
	$this->SetDrawColor(0,0,0);
	$this->SetTextColor(0,0,0);
	$this->SetLineWidth(.1);
	$this->Cell(15,5,'(1) NUMERO',1,0,'C',0);
	//COLUMNA 2
	$this->Cell(10,5,'(2) AÑO',1,0,'C',0);
	//COLUMNA 3
	$this->Cell(105,5,'(3) TITULO',1,0,'C',0);
	//COLUMNA 4
	$this->Cell(20,5,'(4) DURACION',1,0,'C',0);
	//COLUMNA 5
	$this->Cell(20,5,'(5) NO. PACIENTES',1,0,'C',0);
	//COLUMNA 6
	$this->Cell(70,5,'(6) CENTRO DE INVESTIGACION / INVESTIGADOR PRINCIPAL',1,0,'C',0);
	//COLUMNA 7
	$this->Cell(25,5,'(7) FECHA APROBACION',1,0,'C',0);
	//COLUMNA 8
	$this->Cell(20,5,'(8) ESTATUS',1,0,'C',0);
	//COLUMNA 9
	$this->Cell(30,5,'(9) PATROCINADOR',1,1,'C',0);									
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
	$this->Cell(310,4,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
	//Posicion: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','',6);
	//Numero de pagina
	//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	//$this->Cell(83,4,'Revision 0',0,0,'L');
	//$this->Cell(83,4,' ',0,0,'L');
	//$this->Cell(83,4,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
	$this->Cell(310,4,$fecha,0,0,'R');
	
}
}

//Creacion del objeto de la clase heredada
$pdf=new PDF('L','mm','legal');
$pdf->SetMargins(20,20,10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$c=0;
$numero = array();
$year = array();
$titulo = array();
$duracion = array();
$nropacientes = array();
$fechaaprob = array();
$estatus = array();
$fechafinal = array();
$entidad = array();
$ctroinvest = array();
//BUSCA TODA LA INFORMACION DE LOS EXPEDIENTES
$sql1 = "select ef_protocoloclinico.numero, ef_protocoloclinico.year, ef_protocoloclinico.titulo, ef_protocoloclinico.duracion, ef_protocoloclinico.nro_pacientes, ef_protocoloclinico.fecha_aprobacion, ef_procli_estatus.estatus, ef_protocoloclinico.fecha_final, ef_procli_patrocinantes.entidad from ef_protocoloclinico, ef_procli_estatus, ef_procli_patrocinantes where ef_protocoloclinico.cod_estatus=ef_procli_estatus.codigo and ef_protocoloclinico.cod_entidad=ef_procli_patrocinantes.codigo and ef_protocoloclinico.year='".$_GET['a']."' order by ef_protocoloclinico.numero";

//$sql1 = "select ef_protocoloclinico.numero, ef_protocoloclinico.year, ef_protocoloclinico.titulo, ef_protocoloclinico.duracion, ef_protocoloclinico.nro_pacientes, ef_protocoloclinico.fecha_aprobacion, ef_procli_estatus.estatus, ef_protocoloclinico.fecha_final, ef_procli_patrocinantes.entidad from ef_protocoloclinico, ef_procli_estatus, ef_procli_patrocinantes where ef_protocoloclinico.cod_estatus=ef_procli_estatus.codigo and ef_protocoloclinico.cod_entidad=ef_procli_patrocinantes.codigo and ef_protocoloclinico.year='2008' order by ef_protocoloclinico.numero";
$ResReg = Ejecute($conn,$sql1) or die($sql1);
if (NumFila($ResReg) > 0){
	while ($Fila1 = ObtenerFila($ResReg)){
		$numero[$c] = $Fila1[0];
		$year[$c] = $Fila1[1];
		$titulo[$c] = $Fila1[2];
		$duracion[$c] = $Fila1[3];
		$nropacientes[$c] = $Fila1[4];
		$fechaaprobacion = $Fila1[5];
		$fechaaprob[$c] = ArreglarFecha($fechaaprobacion);
		$estatus[$c] = $Fila1[6];
		$fechafinal[$c]  = $Fila1[7];
		$entidad[$c] = $Fila1[8];
		$sql2="select ef_procli_centros.centro, ef_procli_investigadores.investigador from ef_procli_ctroinv, ef_procli_centros, ef_procli_investigadores where 	ef_procli_ctroinv.cod_centro=ef_procli_centros.codigo and ef_procli_ctroinv.cod_invppal=ef_procli_investigadores.cedula and ef_procli_ctroinv.numero='$numero[$c]'";
$consulta2=EjecuteExec($conn,$sql2) or die($sql2);
		if(NumFila($consulta2)>0){
			while($fila2=ObtenerFila($consulta2)){
				$centro=$fila2[0];
				$investigador=$fila2[1];
				$ctroinvest[$c].=$centro.' - '.$investigador.'; ';
			}
			$ctroinvest[$c]=trim($ctroinvest[$c]);
		}
		$c++;
	}
}
$fecha = date('d/m/Y');
$l=$c;
$y=35;
//ESTE FOR IMPRIME TANTAS LINEAS COMO REGISTROS HALLAN
for($c = 0; $c < $l; ++$c){
//FILA 4 CELDA 1
$pdf->setXY(20,$y);
$pdf->setFont('Arial','',6);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetLineWidth(.0);
$pdf->Cell(15,5,$numero[$c],'T',0,'C',0);
//FILA 4 CELDA 2
$pdf->setXY(35,$y);
$pdf->Cell(10,5,$year[$c],'T',0,'C',0);
//FILA 4 CELDA 3
$pdf->setXY(45,$y);
$pdf->MultiCell(105,5,$titulo[$c],'T','L',0);
//FILA 4 CELDA 4
$pdf->setXY(150,$y);
$pdf->MultiCell(20,5,$duracion[$c],'T','C',0);
//FILA 4 CELDA 5
$pdf->setXY(170,$y);
$pdf->MultiCell(20,5,$nropacientes[$c],'T','C',0);
//FILA 4 CELDA 6
$pdf->setXY(190,$y);
$pdf->MultiCell(70,5,$ctroinvest[$c],'T','L',0);
//FILA 4 CELDA 7
$pdf->setXY(260,$y);
$pdf->MultiCell(25,5,$fechaaprob[$c],'T','C',0);
//FILA 4 CELDA 8
$pdf->setXY(285,$y);
$pdf->MultiCell(20,5,$estatus[$c].$fechafinal[$c],'T','C',0);
//FILA 4 CELDA 9
$pdf->setXY(305,$y);
$pdf->MultiCell(30,5,$entidad[$c],'T','L',0);
$sumo='no';
if(((strlen($titulo[$c])>=937)&&(strlen($titulo[$c])<=1014))||((strlen($ctroinvest[$c])>=577)&&(strlen($ctroinvest[$c])<=624))){
	$y=$y+55;
	$sumo='si';
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=859)&&(strlen($titulo[$c])<=936))||((strlen($ctroinvest[$c])>=529)&&(strlen($ctroinvest[$c])<=576))){
	if($sumo=='no'){
		$y=$y+50;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=781)&&(strlen($titulo[$c])<=858))||((strlen($ctroinvest[$c])>=481)&&(strlen($ctroinvest[$c])<=528))){
	if($sumo=='no'){
		$y=$y+45;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=703)&&(strlen($titulo[$c])<=780))||((strlen($ctroinvest[$c])>=433)&&(strlen($ctroinvest[$c])<=480))){
	if($sumo=='no'){
		$y=$y+40;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=625)&&(strlen($titulo[$c])<=702))||((strlen($ctroinvest[$c])>=385)&&(strlen($ctroinvest[$c])<=432))){
	if($sumo=='no'){
		$y=$y+35;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=547)&&(strlen($titulo[$c])<=624))||((strlen($ctroinvest[$c])>=337)&&(strlen($ctroinvest[$c])<=384))){
	if($sumo=='no'){
		$y=$y+30;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=469)&&(strlen($titulo[$c])<=546))||((strlen($ctroinvest[$c])>=289)&&(strlen($ctroinvest[$c])<=336))){
	if($sumo=='no'){
		$y=$y+25;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=391)&&(strlen($titulo[$c])<=468))||((strlen($ctroinvest[$c])>=241)&&(strlen($ctroinvest[$c])<=288))){
	$y=$y+20;
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=313)&&(strlen($titulo[$c])<=390))||((strlen($ctroinvest[$c])>=193)&&(strlen($ctroinvest[$c])<=240))){
	if($sumo=='no'){
		$y=$y+15;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=235)&&(strlen($titulo[$c])<=312))||((strlen($ctroinvest[$c])>=145)&&(strlen($ctroinvest[$c])<=192))){
	if($sumo=='no'){
		$y=$y+10;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
	}
}elseif(((strlen($titulo[$c])>=156)&&(strlen($titulo[$c])<=234))||((strlen($ctroinvest[$c])>=96)&&(strlen($ctroinvest[$c])<=144))){
	if($sumo=='no'){
		$y=$y+5;
		$sumo='si';
	}
	if($y>=170){
		$pdf->AddPage();
		$y=25;
		
	}
}
if($y>=165){
	$pdf->AddPage();
	$y=35;
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
$pdf->Cell(315,5,' TOTAL SOLICITUDES RECIBIDAS: '.$l,1,1,'R');
$pdf->Output();
?>