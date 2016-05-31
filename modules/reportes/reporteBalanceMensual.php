<?php
include("../../mainfile.php");
include(XOOPS_ROOT_PATH."/header.php");
include_once $GLOBALS['xoops']->path('modules/system/constants.php');

 
include_once("../conexion_ip78.php");
$MesesSelect=$_POST['cat'];
//$MesesSelect=$_POST['subcat'];
$mes = date('m');
$anio = date('Y');


if ( isset($_SERVER['HTTP_USER_AGENT']) &&  (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) )
 { header('X-UA-Compatible: IE=8'); }
 

$idZona = 0;
$idAnio = isset($_GET["idAnio"])?$_GET["idAnio"]:$anio;
$idMes  = isset($_GET["idMes"])?$_GET["idMes"]:$mes;
 
 
$zonas 				 = array();
$energiaRecibida 	 = array();
$energiaEntregada 	 = array();
$perdidasEnergia 	 = array();
$porcentajePerdidas  = array();
$metaMensual 	 	 = array();
$metaPerdidasEnergia = array();
$GwhRequeridoMeta	 = array(); 



?>
<form name="f1" action="<?php echo $PHP_SELF; ?>" method="post" >
<?php



	
//Fin combos

$sql = "SELECT idZona AS id, nombre AS zona 
		FROM zonas ";
$res = mysql_query($sql);
//echo $sql;
while ($row = mysql_fetch_assoc($res))
{
	//echo "si";
	$idZ = $row["id"];
	
 	$energiaRecibida[$idZ] 	   = 0;
	$energiaEntregada[$idZ]	   = 0;
	$perdidasEnergia[$idZ] 	   = 0;
	$porcentajePerdidas[$idZ]  = 0;
	$metaMensual[$idZ] 		   = 0;
	$metaPerdidasEnergia[$idZ] = 0;
	$GwhRequeridoMeta[$idZ]    = 0;
	 
	
	 
	
	$zonas[$idZ] = $row["zona"];
	
	//echo "<br>Zona: ".$zonas[$idZ];
}

				
 					
		echo "<div class=\"titulo\"> Balance de Energia Mensual </div>";
		echo "<div class=\"subtitulo\">  &nbsp;</div>";
		echo "<div class=\"subtitulo\"> &nbsp; </div>";	
	 

$sqlEnergia = "SELECT SUM(e.cantidad) AS cantidadEnergia,
				e.idzona,e.tipo,e.externoInterno AS extInt
 				FROM energia AS e 
					INNER JOIN conceptoEnergia AS ce ON (e.idConcepto = ce.id)
					WHERE e.anio = '".$idAnio."' AND e.mes = '".$idMes."'
   			   GROUP BY e.idZona , e.externoInterno, e.tipo;";		
$resEnergia = mysql_query($sqlEnergia);
 //echo $sqlEnergia. "<BR>";

while ($rowE = mysql_fetch_assoc($resEnergia))
{
	$idZZ = $rowE["idzona"];
	//$cantidadEnergia += $rowE["cantidadEnergia"];
	$extInt  = $rowE["extInt"];
	
	if($rowE["tipo"]=="1") 
	 { 
	 	$energiaEntregada[$idZZ]   += $rowE["cantidadEnergia"];
		if($extInt==1)
		 { $energiaEntregada["DA00"] += $rowE["cantidadEnergia"]; }
	 }
	 
	 if($rowE["tipo"]=="2")
	 { 
	 	$energiaRecibida[$idZZ]   += $rowE["cantidadEnergia"]; 
		if($extInt==1)
		 { $energiaRecibida["DA00"] += $rowE["cantidadEnergia"]; }
	}
	 
	 
 
}

$sqlM = "SELECT *
 FROM metas 
 WHERE anio = '".$idAnio."' AND mes = '".$idMes."'";		
$resM = mysql_query($sqlM);
// echo $sqlM. "<BR>";

while ($rowM = mysql_fetch_assoc($resM))
{
	$idZZ = $rowM["idZona"];
	$valorMeta = $rowM["valor"];
 
	 	$metaMensual[$idZZ]   = $valorMeta;
 
}



?>
 <html>
  <head>
    <link href="css/estilo.css" rel="stylesheet" type="text/css"> 
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
  <script type="text/javascript" src="../../../../jeasyui/jquery-1.6.min.js"></script>
  </head>
  <body onload=disableselect();>
<table border="1" id="datos" class="bordered" >
 <thead>
 <tr>
 <td colspan="8">
  A&ntilde;o:&nbsp;
        <select panelHeight="auto" style="width:100px" id="idAnioFilter" name="idAnioFilter">
          <?php for($i = (date('Y')-2);$i<(date('Y')+1);$i++){?>
         <option value="<?php echo $i;?>" <?php if($idAnio==$i) {echo " Selected";}?>><?php echo $i;?></option>
          <?php }?>
         </select>
 &nbsp;Mes:&nbsp;
        <select panelHeight="auto" style="width:100px" id="idMesFilter"  name="idMesFilter">
             <option value="01" <?php if($idMes=="01") {echo " Selected";}?>>Enero</option>
             <option value="02" <?php if($idMes=="02") {echo " Selected";}?>>Febrero</option>
             <option value="03" <?php if($idMes=="03") {echo " Selected";}?>>Marzo</option>
             <option value="04" <?php if($idMes=="04") {echo " Selected";}?>>Abril</option>   
             <option value="05" <?php if($idMes=="05") {echo " Selected";}?>>Mayo</option>
             <option value="06" <?php if($idMes=="06") {echo " Selected";}?>>Junio</option>
             <option value="07" <?php if($idMes=="07") {echo " Selected";}?>>Julio</option>
             <option value="08" <?php if($idMes=="08") {echo " Selected";}?>>Agosto</option>
             <option value="09" <?php if($idMes=="09") {echo " Selected";}?>>Septiembre</option>
             <option value="10" <?php if($idMes=="10") {echo " Selected";}?>>Octubre</option>
             <option value="11" <?php if($idMes=="11") {echo " Selected";}?>>Noviembre</option>   
             <option value="12" <?php if($idMes=="12") {echo " Selected";}?>>Diciembre</option>   
         </select>
         &nbsp;
         <input type="button" value="Filtrar" id="idFiltrar">
         </td>
 </tr>
 <tr>
    <th  align="center">&nbsp;ZONA</th>
    <th align="center">&nbsp;ENERGÍA RECIBIDA (KWH)</th>
    <th align="center">&nbsp;ENERGÍA ENTREGADA (KWH)</th>
    <th align="center">&nbsp;PÉRDIDAS ENERGÍA (KWH)</th>
    <th align="center">&nbsp;% PÉRDIDAS </th>
    <th align="center">&nbsp;META MENSUAL</th>
    <th align="center">&nbsp;META PÉRDIDAS ENERGÍA</th> 
    <th align="center">&nbsp;GWh REQUERIDO META</th> 
 </tr></thead>
 
<?php foreach($zonas as $index=>$dato){
	
	if($index!="DA00") {?> 

 
 <tr>
   
   <?php 
   $color = "#0C0";
   $energiaRecibidaLocal = $energiaRecibida[$index]; 
   $energiaEntregadaLocal = $energiaEntregada[$index];
   $perdidasEnergiaLocal   = ($energiaRecibidaLocal-$energiaEntregadaLocal);
   $porcentajePerdidasLocal  = ((($energiaRecibidaLocal-$energiaEntregadaLocal)/$energiaRecibidaLocal)*100);
   $metaMensualLocal 	  = $metaMensual[$index];
   $metaPerdidasEnergiaLocal = (($metaMensualLocal*$energiaRecibidaLocal)/100);
   $GwhRequeridoMetaLocal = (($energiaRecibidaLocal-$energiaEntregadaLocal) -((($metaMensualLocal*$energiaRecibidaLocal)/100)));
   
    if($porcentajePerdidasLocal>$metaMensualLocal)
	{ $color = "#F00";}
   ?>
    <td align="center">&nbsp;<?php echo $dato;?></td>
    <td align="center">&nbsp;<?php echo number_format($energiaRecibidaLocal,0);?></td>
    <td align="center">&nbsp;<?php echo number_format($energiaEntregadaLocal,0);?></td>
    <td align="center">&nbsp;<?php echo number_format($perdidasEnergiaLocal,0);?></td>
    <td align="center" style="color:<?php echo $color;?>">&nbsp;<?php echo number_format($porcentajePerdidasLocal,2);?></td>
     <td align="center">&nbsp;<?php echo $metaMensualLocal;?></td>
    <td align="center" >&nbsp;<?php echo number_format($metaPerdidasEnergiaLocal,0);?></td>
    <td align="center" <?php if($GwhRequeridoMetaLocal>0) {echo "style='color:#F00'";}?>>&nbsp;<?php echo number_format($GwhRequeridoMetaLocal,0);?></td>
 </tr>
 <?php  }}?> 

 <tr>
    
    <?php 
		if(((($energiaRecibida["DA00"]-$energiaEntregada["DA00"])/$energiaRecibida["DA00"])*100)>$metaMensual["DA00"])
		{ $color = "#F00"; }
		else
		{ $color = "#0C0"; }
	?>
    <td align="center">&nbsp;<?php echo $zonas["DA00"];?></td>
    <td align="center">&nbsp;<?php echo number_format($energiaRecibida["DA00"],0);?></td>
    <td align="center">&nbsp;<?php echo number_format($energiaEntregada["DA00"],0);?></td>
    <td align="center">&nbsp;<?php echo  number_format(($energiaRecibida["DA00"] - $energiaEntregada["DA00"]),0);?></td>
    <td align="center"  style="color:<?php echo $color;?>">&nbsp;<?php echo number_format(((($energiaRecibida["DA00"]-$energiaEntregada["DA00"])/$energiaRecibida["DA00"])*100),2);?></td>
    <td align="center">&nbsp;<?php echo $metaMensual["DA00"];?></td>
    <td align="center">&nbsp;<?php echo number_format((($metaMensual["DA00"]*$energiaRecibida["DA00"])/100),0);?></td>
    <td align="center">&nbsp;<?php echo number_format((($energiaRecibida["DA00"]-$energiaEntregada["DA00"]) -((($metaMensual["DA00"]*$energiaRecibida["DA00"])/100))),0);?></td>  
 </tr>
 </table>

 	
    <script>
    $(function(){
		$( "#idFiltrar" ).click(function() {
				//cambiarLocation();		
				
				loc = "?idAnio="+selAnio()+"&idMes="+selMes();
				 
				  window.location.href = loc;		
			});	
			
			function selAnio()
				{
					var selE = $( "#idAnioFilter  option:selected" ).val();
					return  selE;	
				}
				
				function selMes()
				{
					var selE = $( "#idMesFilter  option:selected" ).val();
					return selE;	
				}
		});
    </script>
  </body>
     
</html>
<?php

include(XOOPS_ROOT_PATH."/footer.php");

?>