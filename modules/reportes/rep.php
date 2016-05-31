<?php 
include ("../../mainfile.php");
include ("../../header.php");
//global $xoopsTheme;$xoopsUser;
include_once $GLOBALS['xoops']->path('modules/system/constants.php');
global $xoopsTheme;$xoopsUser;$xoopsGroup;
OpenTable();

require_once('../conexion.php'); 
require_once('../validarRequeridos.php');
require_once('../INC_Arrays.php');

	
	if (is_object($GLOBALS['xoopsUser']) ) 
{ 
	$Zonade = $GLOBALS['xoopsUser']->getVar('user_from'); 
	$Nombre = $GLOBALS['xoopsUser']->getVar('uname');
	$NombreZona = $GLOBALS['xoopsUser']->getVar('name');
	$id = $GLOBALS['xoopsUser']->getVar('uid');
	$Grupo = $GLOBALS['xoopsUser']->getVar('id');
}

/*
if( strlen($xoopsUser->getVar("user_from")) > 0 ) {
	$DeZona=$xoopsUser->getVar("user_from"); 
} else {
	$DeZona='';
}*/
	
/*if( strlen($xoopsGroup->getVar("name")) > 0 ) {
	$NombreGrupo=$xoopsGroup->getVar("name"); 
} else {
	$NombreGrupo='';
}*/	
	

//echo "Zonade:   ".$Zonade."<br>"; 
//echo "Nombre:   ".$Nombre."<br>"; 
//echo "Bienvenido :   ".$NombreZona."<br>"; 
//echo "id:   ".$id."<br>"; 
//echo "grupo:   ".$Grupo;
	
	
	
$catalogo 	= "Reporte de Avance";
$deTabla  	= "v_semanasest";
$deCampo  	= "id_mes";
$abuscar    = $_POST["buscar"];
$rad1       = $_POST["rad1"];
$limit      = 50;   
$limitvalue = $page * $limit - ($limit); 
$backPos = 5;
$frontPos = 5; 

//********************** Para Grupo Admor Zona 
$groupid =0;
$UsuarioCompras 		= false;
$GrupoAdmonComprasZona 	= false;
$GrupoAdmonComprasDiv 	= false;

$UserId = $xoopsUser->uid();
//$DeZona = $xoopsUser->user_from(); 
//$DeZona = 1; 

//foreach ( $xoopsUser->groups as $groupid ){
//	echo "<pre>";var_dump($groupid);echo "</pre>";
//		}

foreach ( $xoopsUser->groups as $groupid ){

	if ($groupid == $ComprasGroupID)
		$GrupoAdmonComprasDiv = true;
	
	if (($groupid == $ComprasAdmonZonaGroupID))
		$GrupoAdmonComprasZona = true;		
}
//echo "GrupoAdmonComprasZona : ". $GrupoAdmonComprasZona;
//echo "GrupoAdmonComprasDivl : ". $GrupoAdmonComprasDiv;
//**********************		
if(empty($_GET["page"])) {
	$page = 1;
	$limitvalue = 0; 
} else {
	$page = $_GET["page"];
	$limitvalue = $page * $limit - ($limit); 
}	
		
		if ($abuscar != "") {
		$deCampo = "";
		switch ($rad1) 
		{
	   		case 2:
				$deCampo = "id_estrategia LIKE '%$abuscar%' ";
	   	    	break;
	   		case 3:
				$deCampo = "id_zona LIKE '%$abuscar%' ";				
	    	   	break;		   	
					}
		if ( $deCampo != "" ) $deCampo = " WHERE " . $deCampo;

		$query_count="SELECT count(*) as tot FROM " . $deTabla . "  " . $deCampo . "" ;
		
	$sql ="SELECT * FROM " . $deTabla . " " . $deCampo . " ORDER BY id_mes ASC LIMIT ".$limitvalue." , ".$limit;
	
	
		} 
		else 
		{
			$query_count="SELECT count(*) as tot FROM " . $deTabla . " " . $deCampo . "" ;
		$sql ="SELECT * FROM " . $deTabla . " " . $deCampo . " ORDER BY id_mes ASC LIMIT ".$limitvalue." , ".$limit;
		}

//echo $sql;
	
	
$result_count   = mysql_query($query_count); 
$rowTot 		= mysql_fetch_array($result_count);   
$totalrows      = $rowTot["tot"]; 
$result         = mysql_query($sql); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title><?php echo $titulo; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
validarRequeridos();
ajaxObject();
?>



<script language="JavaScript" type="text/JavaScript" src="../tooltip.js"></script>
<script language="Javascript">
function Buscar(form){
  if(form.rad1[1].checked || form.rad1[2].checked || form.rad1[3].checked || form.rad1[4].checked || form.rad1[5].checked ){
	 return setRequired2("buscar");
   }else{ form.buscar.value='.';}   
  return true;
 }
</script>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<form name="form" action="<?php echo $PHP_SELF; ?>" method="post" onsubmit='return Buscar(this);'>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#dedede">
	<tr class="headerbig" height="25">
		<td class="bg_m2" >&nbsp;</td>
	</tr>
</table>




</form>	


<table  width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr><td colspan="2">
	  	<table width="100%">
			<tr align="left" class="TituloTabla">  
				<td width="6%">Hacer</td>
				<td width="8%">Id_semana</td>
				<td width="31%">Descripci&oacute;n</strong></td>
				<td width="9%">Mes</td>
                <td width="9%">Tipo</td>
                <td width="9%">Real</strong></td>
				<td width="16%">Zona </strong></td>
                <td width="12%">Mes</td>
                <td width="12%">Metas</td>
			</tr>

			<?php 
				if(mysql_num_rows($result) != 0)
				{ 			?> <TR> <?PHP
					$haydatos = true;
					$j = 0; 
					while($row = mysql_fetch_array($result)) { 
					 		if(($j % 2) != 0){ ?> 
									<tr class="bg4"> 
						<?php } else {  ?>
									<tr align="left" valign="top" class="bg1">
						<?php } ?>
							<td valign="middle">
						
										<a href="#" onClick="openWin('<?php echo $catalogo; ?>Edit.php?id_estrategia=<?php echo $row["id_estrategia"]; ?>+clave_estrategia=<?php echo $row["clave_estrategia"];?>+id_zona=<?php echo $row["id_zona"];?>','Edit','status=yes,scrollbars=yes,width=800,height=350');">
											<img src="<?php echo $IconsPath;?>editar.png" border="0" alt="Editar Registro">										</a>									
                            </td>							
		      				<td valign="middle"><?php echo $row['id_semana']; ?></td>
					      	<td align="left" valign="top"><?php echo $row['descripcion_accion']; ?></td> 
                              
					      	<td><?php echo $row['id_mes']; ?></td>
					      
					      	<td>
							<?php echo $row['id_tipo']; ?>
							</td>	
                             <td>
							<?php echo $row['real_estrategia']; ?>
							</td>	
                             <td>
							<?php echo $row['zonas_descripcion']; ?>
                           
							</td>					   								
							<td><?php echo $row['meses_descripcion']; ?></td> 
					      	<td>
                            
                            <div align="center">	
							<?php 
							$sqlVerifica = "SELECT * FROM estrategias WHERE id_estrategia = '" . $row['id_estrategia'] . "'";
						    $resVerifica = mysql_query($sqlVerifica);

									if ( $row['real_estrategia']!=0)
									
									{
										
										?>
										<img src="images/check2.png" border="0" alt="Metas Capturadas" height="20" width="20">
									
										<?php									
									}
									
									mysql_free_result($resVerifica);
									?>	
								</div>
                            
                            </td> 							
		  					</tr>		
							<?php 
							$j++;
			     		}  
				} else {
					$haydatos = false;?>
					<tr>  
				 		<td colspan="12">No Existe información</td>
			    	</tr>
			<?php }?>
		</table>
      </td>
  </tr>
<?php  if ($haydatos) {
?>
  <tr>
  	<td width="90%">
	<?php 
	if($page != 1){ 
        $pageprev = $page-1;
        
        echo("<a class='button_m' href=\"$PHP_SELF?page=$pageprev&buscar=$abuscar&rad1=$rad1\"><<</a>&nbsp;&nbsp;"); 
    }else{
        echo("&nbsp;&nbsp;&nbsp;&nbsp;"); 
    }
    $numofpages = ceil($totalrows / $limit); 
	if ($numofpages == 0) { 
		$numofpages = 1; 
	}
	
	$tr = ceil($totalrows,-2);
    $acum = ceil(($tr / $numofpages),-1);

// print a series of numbers
    for($i = 1; $i <= $numofpages; $i++)
	{  
	if  ( ($i % $acum == 0 || $i == 1) || ($i>=$page-$backPos && $i<=$page+$frontPos) )
		{
        	if($i == $page)
			  {
                 echo("<font  class='smallred'>".$i."</font>&nbsp;"); 
        	  }
			else
			  {
                 echo("<a class='button_m' href=\"$PHP_SELF?page=$i&buscar=$abuscar&rad1=$rad1\">$i</a>&nbsp;");
 	          }
		}
	
    }

  
    if(($totalrows - ($limit * $page)) > 0){
        $pagenext = $page+1;         
        echo(" <a class='button_m' href=\"$PHP_SELF?page=$pagenext&buscar=$abuscar&rad1=$rad1\">>></a>&nbsp;&nbsp;"); 
    }
	?>
	</td>
	<td>
<?php 
	if ($numofpages==0) 
	{$numofpages = 1;}
	
	echo "<font class='button_m'> Pág. ".$page." de ".$numofpages."</font>"; ?>
	</td>
  </tr>
  <?php  } ?>

</table>
<p>&nbsp;</p>
</body>
</html>
<?php
CloseTable();
include (XOOPS_ROOT_PATH."/footer.php");
?>
