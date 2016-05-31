<?php
include_once("../conexion_ip78.php");
include("../../mainfile.php");
include("inc_menu.php");



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
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-detailview.js"></script>

    
	
</head>
<body>
	 
	<?php menu();?>
	<table id="dg" title="Crew" style="width:700px;height:auto">
		<thead>
			<tr>
				<th field="name" width="50" editor="{type:'validatebox',options:{required:true}}">Crew</th>
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
				url: 'htcrew_json.php',
				saveUrl: 'htcrew_save.php',
				updateUrl: 'htcrew_save.php',
				destroyUrl: 'htcrew_del.php',
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
					},
					view: detailview,
                detailFormatter:function(index,row){
                    return '<div style="padding:2px"><table class="ddv"></table></div>';
                },
                onExpandRow: function(index,row){
                    var ddv = $(this).edatagrid('getRowDetail',index).find('table.ddv');
                    ddv.edatagrid({
                        url:'htcrewPeople_json.php?id='+row.id,
						saveUrl: 'htcrewPeople_save.php',
						updateUrl: 'htcrewPeople_save.php',
						destroyUrl: 'htcrewPeople_del.php',
                        fitColumns:true,
                        singleSelect:true,
                        rownumbers:true,
                        loadMsg:'',
                        height:'auto',
                        columns:[[
                            {field:'id',title:'Id',width:10},
                            {field:'name',title:'Name',width:100},
							{field:'type',title:'Type',width:50
								
								,formatter:function(value,row,index){
									
									switch(value)
									{
										case 'wo':
											return 'Worker';
										break;
										
										case 'fo':
											return 'Foreman';
										break;
										
										case 'fl':
											return 'Forklift';
										break;
										
										case 'tr':
											return 'Tractor';
										break;
										
										default: 
										  return 'Worker';
										
										}
									
									
									}
								
								},
                            //{field:'unitprice',title:'Unit Price',width:100,align:'right'}
                        ]],
                        onResize:function(){
                            $('#dg').edatagrid('fixDetailRowHeight',index);
                        },
                        onLoadSuccess:function(){
                            setTimeout(function(){
                                $('#dg').edatagrid('fixDetailRowHeight',index);
                            },0);
                        }
                    });
                    $('#dg').edatagrid('fixDetailRowHeight',index);
                }
				
				
			});
		});
	</script>
	
</body>

  </center>
  </html>