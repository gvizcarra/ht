<?php
include("../../../mainfile.php");
include_once(XOOPS_ROOT_PATH."/class/xoopsmodule.php");
include(XOOPS_ROOT_PATH."/include/cp_functions.php");

if ( $xoopsUser ) 
{
	$xoopsModule = XoopsModule::getByDirname("mimodulo"); /*RECUERDA PONER EL NOMBRE DE TU MODULO AQUI*/
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) 
	{ 
		redirect_header(XOOPS_URL."/",3,_NOPERM);
		exit();
	}
} else 
{
	redirect_header(XOOPS_URL."/",3,_NOPERM);
	exit();
}

if ( file_exists("../language/".$xoopsConfig['language']."/admin.php") ) 
{
	include("../language/".$xoopsConfig['language']."/admin.php");
} else 
{
	include("../language/english/admin.php");
}

global $xoopsModule;


xoops_cp_header();
OpenTable();

echo "<a href='administracion.php'>"._MI_MODULO_ADMIN."</a><br />";

CloseTable();
xoops_cp_footer();

?>