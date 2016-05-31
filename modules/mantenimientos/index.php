<html>
  <head>
<?php

include("../../mainfile.php");
include(XOOPS_ROOT_PATH."/header.php");
include_once $GLOBALS['xoops']->path('modules/system/constants.php');
include_once("../conexion_ip78.php");
if ( isset($_SERVER['HTTP_USER_AGENT']) &&  (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) )
 { header('X-UA-Compatible: IE=8'); }
 
 $idZona = isset($_GET["idZona"])?$_GET["idZona"]:"DA01";
if (is_object($GLOBALS['xoopsUser']) ) 
{ 
	$Zonade = $GLOBALS['xoopsUser']->getVar('user_from'); 
	$Nombre = $GLOBALS['xoopsUser']->getVar('uname');
	$Nombre2 = $GLOBALS['xoopsUser']->getVar('name');
	$id = $GLOBALS['xoopsUser']->getVar('uid');
	$Grupo = $GLOBALS['xoopsUser']->getVar('email'); 
}
//echo "x ".$Zonade;
?>

 
  <body>
	 <iframe src="indexIfr.php" width="850" scrolling="yes" height="700" style="overflow:auto" frameborder="0"></iframe>
  </body>
  </center>
  </html>
<?php
include (XOOPS_ROOT_PATH."/footer.php");
?>