<?
//CONSULTA TABLA TIPO DE PERSONAL
    mysql_connect("localhost","root","2006");
	require_once('varias_fns.php');
	do_html_encabezado('');
?> 

<script language="JavaScript">
function muestra(queCosa)
{
    alert(queCosa);
}
</script>
<p>&nbsp;</p>
<p class="Estilo1">
<form action="consulta3.php" method="post">
Término de Búsqueda:
<input type="text" name="criterio" size="40" maxlength="150">&nbsp;
<input type="image" name="boton_submit" src="imagenes/busca.gif" alt="Buscar">&nbsp;Buscar
</form>
&nbsp;</p>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
<tr bgcolor="#006600"><td align="center" colspan="6" class="Estilo11">RESULTADO DE SU CONSULTA</td></tr>
</table>
<br>
<?
//inicializo el criterio y recibo cualquier cadena que se desee buscar
$criterio = "";
$txt_criterio = "";
if ($_POST["criterio"]!=""){
   $txt_criterio = $_POST["criterio"];
   $criterio = " where codigo like '%" . $txt_criterio . "%' or tipo like '%" . $txt_criterio . "%'";
}

$sql="SELECT * FROM bdcatinhrr.tipos".$criterio;
$res=mysql_query($sql);
$numeroRegistros=mysql_num_rows($res);
if($numeroRegistros<=0)
{
    echo "<div align='center'>";
    echo "<font face='verdana' size='-2'>No se encontraron resultados</font>";
    echo "</div>";
}else{
    //////////elementos para el orden
    if(!isset($orden))
    {
       $orden="codigo";
    }
    //////////fin elementos de orden

    //////////calculo de elementos necesarios para paginacion
    //tamaÃ±o de la pagina
    //$tamPag=5;
	$tamPag=10;

    //pagina actual si no esta definida y limites
    if(!isset($_GET["pagina"]))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $pagina = $_GET["pagina"];
    }
    //calculo del limite inferior
    $limitInf=($pagina-1)*$tamPag;

    //calculo del numero de paginas
    $numPags=ceil($numeroRegistros/$tamPag);
    if(!isset($pagina))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $seccionActual=intval(($pagina-1)/$tamPag);
       $inicio=($seccionActual*$tamPag)+1;

       if($pagina<$numPags)
       {
          $final=$inicio+$tamPag-1;
       }else{
          $final=$numPags;
       }

       if ($final>$numPags){
          $final=$numPags;
       }
    }

//////////fin de dicho calculo

//////////creacion de la consulta con limites
$sql="SELECT * FROM bdcatinhrr.tipos ".$criterio." ORDER BY ".$orden.",codigo ASC LIMIT ".$limitInf.",".$tamPag;
$res=mysql_query($sql);

//////////fin consulta con limites
echo "<div align='center'>";
echo "<font face='verdana' size='-2'>encontrados ".$numeroRegistros." resultados<br>";
echo "ordenados por <b>".$orden."</b>";
if(isset($txt_criterio)){
    echo "<br>Valor filtro: <b>".$txt_criterio."</b>";
}
echo "</font></div>";
echo "<table align='center' width='100%' border='0' cellspacing='1' cellpadding='0'>";
echo "<tr><td colspan='6'><hr noshade></td></tr>";
echo "<th class='Estilo9' bgcolor='#006600'><a class='ord' href='".$_SERVER["PHP_SELF"]."?pagina = ".$pagina."&orden=codigo&criterio=".$txt_criterio."'>CODIGO</a></th>";
echo "<th colspan='3' class='Estilo9' bgcolor='#006600'><a class='ord' href='".$_SERVER["PHP_SELF"]."?pagina = ".$pagina."&orden=tipo&criterio=".$txt_criterio."'>TIPO DE PERSONAL</a></th>";
//echo "<th class='Estilo9' bgcolor='#006600'><a class='ord' href='".$_SERVER["PHP_SELF"]."?pagina = ".$pagina."&orden=tipop&criterio=".$txt_criterio."'>DEPENDENCIA</a></th>";
while($registro=mysql_fetch_array($res))
{
?>
   <!-- tabla de resultados -->
    <tr bgcolor="#CCFF99" onMouseOver="this.style.backgroundColor='#CCCCCC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#CCFF99'"o"];" onClick="javascript:muestra('<? echo "[".$registro["codigo"]."] ".$registro["tipo"]; ?>');">
	<td width="10%" class="Estilo13" align="center"><? echo $registro["codigo"]; ?></td>
	<td colspan="3" width="70%" class="Estilo13">&nbsp;<? echo $registro["tipo"]; ?></td>
    <!--<td width="20%" class="Estilo13" align="center"><? echo $registro["depende"]; ?></td>-->
    </tr>
   <!-- fin tabla resultados -->
<?
}//fin while
echo "</table>";
}//fin if
//////////a partir de aqui viene la paginacion
?>
    <br>
    <table border="0" cellspacing="0" cellpadding="0" align="center">
    <tr><td align="center" valign="top">
<?
    if($pagina>1)
    {
       echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=".$orden."&criterio=".$txt_criterio."'>";
       echo "<font face='verdana' size='-2'>anterior</font>";
       echo "</a> ";
    }

    for($i=$inicio;$i<=$final;$i++)
    {
       if($i==$pagina)
       {
          echo "<font face='verdana' size='-2'><b>".$i."</b> </font>";
       }else{
          echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."&criterio=".$txt_criterio."'>";
          echo "<font face='verdana' size='-2'>".$i."</font></a> ";
       }
    }
    if($pagina<$numPags)
   {
       echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."&criterio=".$txt_criterio."'>";
       echo "<font face='verdana' size='-2'>siguiente</font></a>";
   }
//////////fin de la paginacion
?>
    </td></tr>
    </table>
<hr noshade style="color:006600;height:1px">
<div align="center"><font face="verdana" size="-2"><a class="p" href="sistema.php">Ir al Menu Principal</a></font></div>
<?
	do_html_pie();
    mysql_close();
?> 