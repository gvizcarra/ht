<?php
$modversion['name'] = "Avance de Acciones";  	 
$modversion['version'] = 1; 			      
$modversion['description'] = "Reporte de Acciones para ISC";	 
$modversion['credits'] = "";			      
$modversion['license'] = "GPL see LICENSE";	 
$modversion['official'] = 1;			       
$modversion['image'] = "images/slogo.png";	 
$modversion['dirname'] = "reportes";		 

$modversion['hasAdmin'] = 0;			     
 	
$modversion['hasMain'] = 1; 

//SubMenu
$modversion['sub'][0]['name'] = "Reporte Balance";
$modversion['sub'][0]['url']  = "reporteBalance.php";
$modversion['sub'][1]['name'] = "Reporte Balance Mensual";
$modversion['sub'][1]['url']  = "reporteBalanceMensual.php";
$modversion['sub'][2]['name'] = "Energia Recuperada";
$modversion['sub'][3]['url']  = "index.php";
//$modversion['sub'][2]['name'] = "Cartera Vencida";
//$modversion['sub'][2]['url'] = "r_cartera_vencida.php";
//$modversion['sub'][3]['name'] = "Perdidas Técnicas";
//$modversion['sub'][3]['url'] = "r_perdidas_tecnicas.php";
	 
?>