<?php
include_once("../conexion_ip78.php");
include("../../mainfile.php");

$idZona		= "DA15";


if (is_object($GLOBALS['xoopsUser']) ) 
{ 
	
	$Nombre = $GLOBALS['xoopsUser']->getVar('uname');
	$Nombre2 = $GLOBALS['xoopsUser']->getVar('name');
	$id = $GLOBALS['xoopsUser']->getVar('uid');
	$isAdmin = $GLOBALS['xoopsUser']->isAdmin();
	
	if($isAdmin)
	{ $idZona = $_GET["idZona"]; }
	else
	{ $idZona = $GLOBALS['xoopsUser']->getVar('user_from'); }
	
	if($isAdmin)
	{ $idProceso = $_GET["idProceso"]; }
	else
	{ $idProceso = $GLOBALS['xoopsUser']->getVar('user_occ'); }
	
	//echo "proc: ".$idProceso;
}

/*echo "Z: ".$idZona."<br>";
echo "n: ".$Nombre."<br>";
echo "n2: ".$Nombre2."<br>";
echo "id: ".$id."<br>";
echo "admin: ".$isAdmin."<br>";*/
?>

	<head>
 	<link rel="stylesheet" type="text/css" href="../../../jeasyui/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../../jeasyui/icon.css">
	<link rel="stylesheet" type="text/css" href="../../../jeasyui/demo.css">
	<script type="text/javascript" src="../../../jeasyui/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="../../../jeasyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="../../../jeasyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="../../../jeasyui/easyui-lang-es.js"></script>
    <script type="text/javascript" src="../../../jeasyui/jquery.pivotgrid.js"></script>
    
	
</head>
<body>
    <h2>Avance de Estrategia de Perdidas Mensual SDD</h2>

   
 	Zona:<select id="idZona">
    <option value="DA00">Divisional</option>
    <option value="DA01">Tijuana</option>
    <option value="DA02">La Paz</option>
    <option value="DA08">Ensenada</option>
    <option value="DA10">Constitucion</option>
    <option value="DA15">Mexicali</option>
    <option value="DA16">San Luis</option>
    <option value="DA17">Los Cabos</option>
    </select>
    &nbsp;<input type="button" id="filtrar" value="Filtrar">
    <table id="pg" style="width:1026px;height:600px"></table>
    <style type="text/css">
       
        .demo-rtl a.pivotgrid-item{
            text-align: right;
		 /*background-color:#FF9A35*/
        }
    </style>
    <script type="text/javascript">
        $(function(){
			
            load1();
			
			$("#filtrar").click(function(){
				
				load1();
			});
			
        });
 
        function load1(){
			var par_idZona = $("#idZona option:selected").val();
			var x_gwh =0.00,x_metaGwh=0.00,x_gwhAcum=0.00,x_metaGwhAcum=0.00;
			var x_eventos =0.00,x_metaEventos=0.00,x_EventosAcum=0.00,x_metaEventosAcum=0.00;
			var retornar = "";
			var verde = 'font-weight:600;color:#060',amarillo='font-weight:600;background-color:#FF9A35;color:#FFFFFF',rojo = 'font-weight:600;background-color:#D70000;color:#FFFFFF';
			
            $('#pg').pivotgrid({
                url:'avanceEstrategiaMes_json.php?idZona='+par_idZona,
                method:'get',
				loadFilter:'myLoadFilter',
				pivot:{
                    rows:['estrategia','accion'],
                    columns:['mes'],
                    values:[
                        {field:'metaGwh',title:'Meta G',width:50,op:'sum'},
						{field:'gwh',title:'GWH',width:50,op:'sum'},	
						{field:'metaEventos',title:'Meta Evts',width:60,op:'sum'}, 
                        {field:'eventos',title:'Evts',width:50,op:'sum'}				
											 
                    ]
                },
                frozenColumnTitle:'<span style="font-weight:bold">Estrategia</span>',
                valuePrecision:2,
                   valueStyler:function(value,row,index){
					 	  
						    if(/gwh$/.test(this.field))
						    { x_gwh = parseFloat(value)?parseFloat(value):parseFloat(0.00); }
							
							if(/metaGwh$/.test(this.field))
							{ x_metaGwh = parseFloat(value)?parseFloat(value):parseFloat(0.00); }
							
							if(/eventos$/.test(this.field))
						    { x_eventos = parseFloat(value)?parseFloat(value):parseFloat(0.00); }
							
							if(/metaEventos$/.test(this.field))
							{ x_metaEventos = parseFloat(value)?parseFloat(value):parseFloat(0.00); }
							
							// GWH
							
							if((/gwh$/.test(this.field))&&(x_gwh<x_metaGwh) &&(x_metaGwh>0))
							{ 
							 if(x_gwh>(x_metaGwh*.8))
							  { retornar = amarillo;}
							  else	
								{ retornar = rojo; }
								
								return retornar;
							}
							
							
							if((/gwh$/.test(this.field))&&(x_gwh>=x_metaGwh))
							{return verde;}
							else if(/gwh$/.test(this.field))
							{return rojo;}
							
							
							// EVENTOS
							
							if((/eventos$/.test(this.field))&&(x_eventos<x_metaEventos)&&(x_metaEventos>0))
							{ 
							 if(x_eventos>(x_metaEventos*.8))
							  { retornar = amarillo;}
							  else	
								{ retornar = rojo; }
								
								return retornar;
							}
							
							
							if((/eventos$/.test(this.field))&&(x_eventos>=x_metaEventos)&&(x_metaEventos>0))
							{return verde;}
							else if(/eventos$/.test(this.field))
							{return rojo;}
							
							// EVENTOS						 
							
                }    
            })
        }
		

		
    </script>
    
    <script>
    $(function(){
            
			 //$(".datagrid-row>td>div>span").removeClass("tree-hit tree-expanded").addClass("tree-hit tree-collapsed");
        });</script>
</body>
</html>
  </center>
  </html>