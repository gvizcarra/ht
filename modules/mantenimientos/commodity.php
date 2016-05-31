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
	<table id="dg" title="Commodity" style="width:700px;height:auto">
		<thead>
			<tr>
				<th field="name" width="50" editor="{type:'validatebox',options:{required:true}}">Commodity</th>
                <th data-options="field:'active',width:5,align:'center',editor:{type:'checkbox',options:{on:'Yes',off:'No'}}">Active</th>

			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onClick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onClick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
       &nbsp;&nbsp;&nbsp; <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newPack()">Add Pack</a>
	</div>
	<script type="text/javascript">
	function getSelected(){
            
        }
		
		$(function(){
			
		
			
			
			$('#dg').edatagrid({
				
				url: 'htCommodity_json.php',
				saveUrl: 'htCommodity_save.php',
				updateUrl: 'htCommodity_save.php',
				destroyUrl: 'htCommodity_del.php',
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
                        url:'htcommodityPack_json.php?id='+row.id,
						saveUrl: 'htCommodity_save.php',
						updateUrl: 'htCommodity_save.php',
						destroyUrl: 'htCommodity_del.php',
                        fitColumns:true,
                        singleSelect:true,
                        rownumbers:true,
                        loadMsg:'',
                        height:'auto',
                        columns:[[
                            {field:'name',title:'Name',width:75},
                            {field:'quantity',title:'Quantity',width:25},
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
		
		function newPack(){
			var row = $('#dg').edatagrid('getSelected');
			var idpack = 0;
            if (row){
               var idpack = row.id;
			    $('#dlg').dialog('open').dialog('center').dialog('setTitle','New Pack');
				$('#fm').form('clear');
				url = 'htcommodityPack_save.php?id='+idpack;
            }
			else
			{ $.messager.alert('Info', 'Select a Commodity First!');}
			
			
		}
		
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
		}


	</script>
  
  <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
        closed="true" buttons="#dlg-buttons">
    <div class="ftitle">Commodity Packs</div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>Name:</label>
            <input name="name" class="easyui-textbox" required="true">
        </div>
        <div class="fitem">
            <label>Quantity:</label>
            <input name="quantity" class="easyui-textbox" required="true">
        </div>
        <div class="fitem">
            <label>Active:</label>
            <input name="phone" class="easyui-checkbox">
        </div>
         
    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
</div>
  
  
</body>

  </center>
  </html>