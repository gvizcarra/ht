<?php
include("../../mainfile.php");
include(XOOPS_ROOT_PATH."/header.php");
include_once $GLOBALS['xoops']->path('modules/system/constants.php');
require_once('../INC_Arrays.php');
 
//include_once("../conexion.php");
require 'config.php'; //del Combo
@$cat=$_GET['cat'];		//del Combo
$MesesSelect=$_POST['cat'];
//$MesesSelect=$_POST['subcat'];


if ( isset($_SERVER['HTTP_USER_AGENT']) &&  (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) )
 { header('X-UA-Compatible: IE=8'); }
 

$idZona = 0;
if (is_object($GLOBALS['xoopsUser']) ) 
{ 
	$Zonade = $GLOBALS['xoopsUser']->getVar('user_from'); 
	$Nombre = $GLOBALS['xoopsUser']->getVar('uname');
	$Nombre2 = $GLOBALS['xoopsUser']->getVar('name');
	$id = $GLOBALS['xoopsUser']->getVar('uid');
	$Grupo = $GLOBALS['xoopsUser']->getVar('email');
}

/*echo "Zonade:   ".$Zonade."<br>"; 
echo "Nombre:   ".$Nombre."<br>"; 
echo "Nombre2:   ".$Nombre2."<br>"; 
echo "id:   ".$id."<br>"; 
echo "grupo:   ".$Grupo;
 */ 
  
//$nomZona = queZonaEs($idZona);
$zonas = array();
$e1p = array();
$e2p = array();
$e3p = array();
$e4p = array();
$e5p = array();

$e1r = array();
$e2r = array();
$e3r = array();
$e4r = array();
$e5r = array();

$ed1p = array();
$ed2p = array();
$ed3p = array();
$ed4p = array();
$ed5p = array();

$ed1r = array();
$ed2r = array();
$ed3r = array();
$ed4r = array();
$ed5r = array();




?>
<form name="f1" action="<?php echo $PHP_SELF; ?>" method="post" >
<?php

//Combos
///////// Getting the data from Mysql table for first list box//////////
$quer2="SELECT DISTINCT descripcion,id_mes FROM meses order by id_mes";
 
		if(isset($cat) and strlen($cat) > 0){
		$quer="SELECT DISTINCT id_zona, id_mes, meses_descripcion FROM v_estrategias where id_mes=$cat order by id_mes"; 
		}else{$quer="SELECT DISTINCT id_mes, meses_descripcion FROM v_estrategias order by id_mes"; } 

		echo "<select name='cat' onchange=\"reload(this.form)\"><option value=''>Seleccione Mes</option>";
		foreach ($dbo->query($quer2) as $noticia2) {
		if($noticia2['id_mes']==@$cat){echo "<option selected value='$noticia2[id_mes]'>$noticia2[descripcion]</option>"."<BR>";}
		else{echo  "<option value='$noticia2[id_mes]'>$noticia2[descripcion]</option>";}
		}
		echo "</select>";
		echo "&nbsp;&nbsp;&nbsp;";

/*
		echo "<select name='subcat'><option value='' >Seleccione Mes</option>";
		foreach ($dbo->query($quer) as $noticia) {
		echo  "<option value='$noticia[id_mes]'>$noticia[meses_descripcion]</option>";
		}
		echo "</select>";
        echo "&nbsp;&nbsp;&nbsp;<input type=submit value=Reporte class=\"button2\">";
echo "</form>";

		///////// Getting the data from Mysql table for first list box//////////
		$quer2="SELECT DISTINCT descripcion,id_zona FROM zonas order by id_zona"; 
		if(isset($cat) and strlen($cat) > 0){
		$quer="SELECT DISTINCT id_zona, id_mes, meses_descripcion FROM v_estrategias where id_zona=$cat order by id_mes"; 
		}else{$quer="SELECT DISTINCT id_zona, meses_descripcion FROM v_estrategias order by id_zona"; } 
	*/
	 echo "&nbsp;&nbsp;<input type=submit value=Reporte class=\"button2\">";	
	 echo "</form>";
	
//Fin combos

$sql = "SELECT id_zona AS id, descripcion AS zona 
		FROM estrategias_db.zonas WHERE id_zona IN(
   									SELECT DISTINCT id_zona AS zona 
										FROM estrategias_db.estrategias 
									)";
$res = mysql_query($sql);
//echo $sql;
while ($row = mysql_fetch_assoc($res))
{
	//echo "si";
	$e1p[$row["id"]] = 0;
	$e2p[$row["id"]] = 0;
	$e3p[$row["id"]] = 0;
	$e4p[$row["id"]] = 0;
	$e5p[$row["id"]] = 0;
	$eap[$row["id"]] = 0;
		
	$e1r[$row["id"]] = 0;
	$e2r[$row["id"]] = 0;
	$e3r[$row["id"]] = 0;
	$e4r[$row["id"]] = 0;
	$e5r[$row["id"]] = 0;
	$ear[$row["id"]] = 0;
	
	$ed1p = 0;
	$ed2p = 0;
	$ed3p = 0;
	$ed4p = 0;
	$ed5p = 0;
	
	$ed1r = 0;
	$ed2r = 0;
	$ed3r = 0;
	$ed4r = 0;
	$ed5r = 0;
	
	$edtp = 0;
	$edtr = 0;
	
	$zonas[$row["id"]] = $row["zona"];
	
	//echo "Zona: "."<br>".$zonas[$row["id"]];
}

/*
	if($MesesSelect =="")
		{
		$MesHoy = date("n");
		$MesesSelect =$MesHoy;	
	
		$sql = "SELECT id_zona,clave_estrategia, metanual_estrategia, programado_estrategia, real_estrategia, avance_estrategia, meses_descripcion FROM estrategias_db.v_estrategias where id_mes='".$MesesSelect."'";	
		echo "Seguimiento de Estrategias: ".$NombredelMes[$MesesSelect];	
		
		} 
	else 
		{	
		$sql = "SELECT id_zona,clave_estrategia, metanual_estrategia, programado_estrategia, real_estrategia, avance_estrategia, meses_descripcion, zonas_descripcion FROM estrategias_db.v_estrategias where id_mes='".$MesesSelect."' ";
		echo "Seguimiento de Estrategias: ".$NombredelMes[$MesesSelect];
			
		}
*/
		
			//$sql = "SELECT * FROM v_estrategias where id_mes <='".$MesesSelect."' ORDER BY id_semana";	
		//echo "Seguimiento de Estrategias: ".$NombredelMes[$MesesSelect];	
				
if($MesesSelect =="")
		{
		$MesHoy = date("n");
		$MesesSelect =$MesHoy;
		//$sql = "SELECT * FROM v_estrategias where id_mes <='".$MesesSelect."' order by id_semana";
		/*$sql="SELECT id_zona, zonas_descripcion, clave_estrategia, id_tipo,
		sum(primera_semana) as primera_semana,
		sum(segunda_semana) as segunda_semana,
		sum(tercera_semana) as tercera_semana, 
		sum(cuarta_semana)  as cuarta_semana
		FROM v_estrategias where id_mes <='".$MesesSelect."' and tipo_estrategia='1'
		group by id_zona,clave_estrategia,id_tipo";*/	
		
		$sql="SELECT id_zona, zonas_descripcion, clave_estrategia, 
		v_estrategias.id_tipo, id_accion, id_tipoAccion,
		Sum(primera_semana) AS primera_semana,
		Sum(segunda_semana) AS segunda_semana,
		Sum(tercera_semana) AS tercera_semana,
		Sum(cuarta_semana) AS cuarta_semana
		FROM v_estrategias where id_mes <='".$MesesSelect."' and tipo_estrategia='1' and id_tipoAccion='2'
		group by id_zona,clave_estrategia,id_tipo";
		
							
		echo "<div class=\"titulo\"> En Construccion </div>";
		echo "<div class=\"subtitulo\"> ****************************** </div>";
		//echo "<div class=\"subtitulo\"> Mes : ".$NombredelMes[$MesesSelect]."</div>";	
		echo $sql. "<BR>";
		} 
	else 
		{	
		//$sql = "SELECT * FROM v_estrategias where id_mes <='".$MesesSelect."' ORDER BY id_semana";
		/*$sql="SELECT id_zona, zonas_descripcion, clave_estrategia, id_tipo,
		sum(primera_semana) as primera_semana,
		sum(segunda_semana) as segunda_semana,
		sum(tercera_semana) as tercera_semana, 
		sum(cuarta_semana)  as cuarta_semana
		FROM v_estrategias where id_mes <='".$MesesSelect."' and tipo_estrategia='1' 
		group by id_zona,clave_estrategia,id_tipo";	*/
		
		$sql="SELECT id_zona, zonas_descripcion, clave_estrategia, 
		v_estrategias.id_tipo, id_accion, id_tipoAccion,
		Sum(primera_semana) AS primera_semana,
		Sum(segunda_semana) AS segunda_semana,
		Sum(tercera_semana) AS tercera_semana,
		Sum(cuarta_semana) AS cuarta_semana
		FROM v_estrategias where id_mes <='".$MesesSelect."' and tipo_estrategia='1' and id_tipoAccion='2'
		group by id_zona,clave_estrategia,id_tipo";

		//echo "Seguimiento de Estrategias: ".$NombredelMes[$MesesSelect];	
		echo "<div class=\"titulo\"> En Construccion </div>";
		echo "<div class=\"subtitulo\"> ****************************** </div>";
		//echo "<div class=\"subtitulo\"> Mes : ".$NombredelMes[$MesesSelect]."</div>";
		echo $sql . "<BR>";
		}

		
$res = mysql_query($sql);
//echo $sql. "<BR>";
$ed3pAcu=0;
while ($row = mysql_fetch_assoc($res))
{
	if($row["id_accion"]=='41')
	 { 
		if($row["id_tipo"]=='1')
	    { 
		$e1p[$row["id_zona"]]=$row["primera_semana"] + $row["segunda_semana"] + $row["tercera_semana"] + $row["cuarta_semana"];			
		$ed1p += $e1p[$row["id_zona"]];
			}
			else
			{
		$e1r[$row["id_zona"]] 	+= $row["primera_semana"]+$row["segunda_semana"]+$row["tercera_semana"]+$row["cuarta_semana"];
		$ed1r += $e1r[$row["id_zona"]];		
		 } 
	 }
	 
	 if($row["id_accion"]=='42')
	 { 
		if($row["id_tipo"]=='1')
		{ 
		$e2p[$row["id_zona"]]=$row["primera_semana"] + $row["segunda_semana"] + $row["tercera_semana"] + $row["cuarta_semana"];			
		$ed2p += $e2p[$row["id_zona"]];
			}
			else
			{
		$e2r[$row["id_zona"]] 	+= $row["primera_semana"]+$row["segunda_semana"]+$row["tercera_semana"]+$row["cuarta_semana"];
		$ed2r += $e2r[$row["id_zona"]];
			 } 
	 }
	 		 	
	 if($row["id_accion"]=='43')
	 { 
	 	
		if($row["id_tipo"]=='1')
			{ 
	    $e3p[$row["id_zona"]]=$row["primera_semana"] + $row["segunda_semana"] + $row["tercera_semana"] + $row["cuarta_semana"];			
		$ed3p += $e3p[$row["id_zona"]];
		
		/*echo "Zona************************************:".$row["zonas_descripcion"]. "<BR>";
		    echo "1:".$row["primera_semana"]."</br>";
			echo "2:".$row["segunda_semana"]."</br>";
			echo "3:".$row["tercera_semana"]."</br>";
			echo "4:".$row["cuarta_semana"]."</br>";
		echo "Estrategia:".$row["clave_estrategia"]. "<BR>";
		echo "3e_Prog:".$e3p[$row["id_zona"]]. "<BR>";
		echo "AcumiladoProg:".$ed3p. "<BR>";	*/	
			}
			else
			{
		$e3r[$row["id_zona"]] 	+= $row["primera_semana"]+$row["segunda_semana"]+$row["tercera_semana"]+$row["cuarta_semana"];
		$ed3r += $e3r[$row["id_zona"]];
		/*echo "Zona************************************:".$row["zonas_descripcion"]. "<BR>";
		    echo "1:".$row["primera_semana"]."</br>";
			echo "2:".$row["segunda_semana"]."</br>";
			echo "3:".$row["tercera_semana"]."</br>";
			echo "4:".$row["cuarta_semana"]."</br>";
		echo "Estrategia:".$row["clave_estrategia"]. "<BR>";
		echo "3e_Real:".$e3r[$row["id_zona"]]. "<BR>";
		echo "AcumiladoReal:".$ed3r. "<BR>";*/
			 } 
	 }
	 
 
	 if($row["id_accion"]=='45')
	 { 
	if($row["id_tipo"]=='1')
			{ 
		$e4p[$row["id_zona"]]=$row["primera_semana"] + $row["segunda_semana"] + $row["tercera_semana"] + $row["cuarta_semana"];			
		$ed4p += $e4p[$row["id_zona"]];
			}
			else
			{
		$e4r[$row["id_zona"]] 	+= $row["primera_semana"]+$row["segunda_semana"]+$row["tercera_semana"]+$row["cuarta_semana"];
		$ed4r += $e4r[$row["id_zona"]];
			 } 
	 }
	 
	 if($row["id_accion"]=='46')
	 { 
		if($row["id_tipo"]=='1')
	    	{ 
		$e5p[$row["id_zona"]]=$row["primera_semana"] + $row["segunda_semana"] + $row["tercera_semana"] + $row["cuarta_semana"];			
		$ed5p += $e5p[$row["id_zona"]];
			}
			else
			{
		$e5r[$row["id_zona"]] 	+= $row["primera_semana"]+$row["segunda_semana"]+$row["tercera_semana"]+$row["cuarta_semana"];
		$ed5r += $e5r[$row["id_zona"]];
		 	}		
	 }
	 
	 //Total Acumulado $eap 
	 $eap[$row["id_zona"]] =$e1p[$row["id_zona"]]+$e2p[$row["id_zona"]]+$e3p[$row["id_zona"]]+$e4p[$row["id_zona"]]+$e5p[$row["id_zona"]];
	 $ear[$row["id_zona"]] =$e1r[$row["id_zona"]]+$e2r[$row["id_zona"]]+$e3r[$row["id_zona"]]+$e4r[$row["id_zona"]]+$e5r[$row["id_zona"]];
	 
	 //$eap[$row["id_zona"]] += $row["programado_estrategia"];
	// $ear[$row["id_zona"]] += $row["real_estrategia"]
	 	 
	 //Total Divisional x estrategia
	 $edtp = $ed1p+$ed2p+$ed3p+$ed4p+$ed5p;
	 $edtr = $ed1r+$ed2r+$ed3r+$ed4r+$ed5r;
	 
	
//echo substr($num,0,strpos($num,'.')+3);
 
}
?>
 <html>
  <head>
    <link href="css/estilo.css" rel="stylesheet" type="text/css"> 
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<SCRIPT language=JavaScript>
        <!--
        function reload(form)
        {
        var val=form.cat.options[form.cat.options.selectedIndex].value;
        self.location='r_perdidas_tecnicas.php?cat=' + val ;
        }
        function disableselect()
        {
        <?Php
        if(isset($cat) and strlen($cat) > 0){
        echo "document.f1.subcat.disabled = true;";}
        else{echo "document.f1.subcat.disabled = true;";}
        ?>
        }
        //-->
        
        </script>
  
  </head>
  <body onload=disableselect();>
<table border="1" id="datos" class="bordered" >
 <thead><tr>
    <th colspan="2" align="center">&nbsp;ZONA</th>
    <th align="center">&nbsp; Balance de Energia</th>
    <th align="center">&nbsp;Balanceo de Circuitos</th>
    <th align="center">&nbsp;Circuitos con &gt; perdidas en MT</th>
    <th align="center">&nbsp;Circuitos con &gt; perdidas en BT</th>
    <th align="center">&nbsp;AVANCE</th> 
 </tr></thead>
 
<?php foreach($zonas as $index=>$dato){?> 

 <tr>
    <td rowspan="2"><?php echo $dato;?>&nbsp;</td>
    <td>&nbsp;PROG</td>
    <td align="center">&nbsp;<?php echo $e1p[$index];?></td>
    <td align="center">&nbsp;<?php echo $e2p[$index];?></td>
    <td align="center">&nbsp;<?php echo $e3p[$index];?></td>
    <td align="center">&nbsp;<?php echo $e5p[$index];?></td>
    <td align="center">&nbsp;<?php echo number_format($eap[$index],2);?></td> 
 </tr>
 <tr>
    <td>&nbsp;REAL</td>
    <td align="center">&nbsp;<?php echo $e1r[$index];?></td>
    <td align="center">&nbsp;<?php echo $e2r[$index];?></td>
    <td align="center">&nbsp;<?php echo $e3r[$index];?></td>
    <td align="center">&nbsp;<?php echo $e5r[$index];?></td>
    <td align="center">
	<?php 	
	
		if($ear[$index]<$eap[$index])
		{
			echo "<font color='red'>".number_format($ear[$index],2)."</font>";
		}
		else
		{
			echo "<font color='black'>".number_format($ear[$index],2)."</font>";
		}
	
	?>
    </td>
 </tr>
 <?php }?> 
<tr>
    <td rowspan="2">Division&nbsp;</td>
    <td>&nbsp;PROG</td>
    <td align="center">&nbsp;<?php echo number_format($ed1p,2);?></td>
    <td align="center">&nbsp;<?php echo number_format($ed2p,2);?></td>
    <td align="center">&nbsp;<?php echo number_format($ed3p,2);?></td>
    <td align="center">&nbsp;<?php echo number_format($ed5p,2);?></td>
    <td align="center">&nbsp;<?php echo number_format($edtp,2);?></td>   
 </tr>
 <tr>
    <td>&nbsp;REAL</td>
    <td align="center">&nbsp;<?php echo number_format($ed1r,2);?></td>
    <td align="center">&nbsp;<?php echo number_format($ed2r,2);?></td>
    <td align="center">&nbsp;<?php echo number_format($ed3r,2);?></td>
    <td align="center">&nbsp;<?php echo number_format($ed5r,2);?></td>
    <td align="center">
    <?php 	
	
		if($edtr<$edtp)
		{
			echo "<font color='red'>".number_format($edtr,2)."</font>";
		}
		else
		{
			echo "<font color='black'>".number_format($edtr,2)."</font>";
		}
	?> 
    
    </td>  
 </tr>
 </table>

 	
  </body>
     
</html>
<?php

include(XOOPS_ROOT_PATH."/footer.php");

?>