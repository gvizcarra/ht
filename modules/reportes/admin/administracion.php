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



/*ESTA FUNCION REALIZA TODA LA PARTE SUPERIOR DE LA P�GINA Y PONE EL MEN� DE ADMINISTRACION*/
xoops_cp_header();  


/***********************************************************************************************/
/********* AQUI PONES EL C�DIGO QUE SEA NECESARIO PARA LA ADMINISTRACION DE TU MODULO **********/
/***********************************************************************************************/


/*ESTA FUNCION REALIZA LA PARTE DERECHA E INFERIOR DE LA P�GINA DE ADMINISTRACION*/
xoops_cp_footer();  

?>