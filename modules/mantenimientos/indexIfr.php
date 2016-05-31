<?php
include_once("../conexion_ip78.php");
include("../../mainfile.php");
include("inc_menu.php");

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
 
?>

	<head>
 	 	<link rel="stylesheet" type="text/css" href="../../jeasyui/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../jeasyui/icon.css">
	<link rel="stylesheet" type="text/css" href="../../jeasyui/demo.css">
	<script type="text/javascript" src="../../jeasyui/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../../jeasyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="../../jeasyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="../../jeasyui/easyui-lang-es.js"></script>

    
	
</head>
<body>
	 
	<?php menu();?>
	<table id="dg" title="Growers" style="width:700px;height:auto">
		<thead>
			<tr>
				<th field="name" width="50" editor="{type:'validatebox',options:{required:true}}">Grower</th>
                <th data-options="field:'active',width:5,align:'center',editor:{type:'checkbox',options:{on:'Yes',off:'No'}}">Active</th>

			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onClick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onClick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>
	<script type="text/javascript">
		$(function(){
			$('#dg').edatagrid({
				url: 'htgrower_json.php',
				saveUrl: 'htgrower_save.php',
				updateUrl: 'htgrower_save.php',
				destroyUrl: 'htgrower_del.php',
				toolbar : '#toolbar',
				pagination : true,
				pageSize:50,
				idField : 'id',
				sorting : true,
				rownumbers : true,
				fitColumns : true,
				singleSelect : true,
				rowStyler: function(index,row){
					if (row.active=='Yes' || row.active=='1')
					{ return row.active='Yes'; }
					else
					{ return row.active='No'; }
				},
				onError: function(index,row){
						alert(row.msg);
					}
				
				
			});
		});
	</script>
	
</body>

  </center>
  </html>