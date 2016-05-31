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

    
	
</head>
<body>
	 
	<?php menu();?>
	<table id="dg" title="People" style="width:800px;height:auto">
		<thead>
			<tr>
				
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
	/* wo=worker
fo=foreman
fl=forklift
tr=tractor*/
	var workerType = [
		    {type:'wo',name:'Worker'},
		    {type:'fo',name:'Foreman'},
		    {type:'fl',name:'Forklift'},
		    {type:'tr',name:'Tractor'}
		];
		
		var genderType = [
		    {type:'m',name:'Male'},
		    {type:'f',name:'Female'} 
		];


		$(function(){
			$('#dg').edatagrid({
				url: 'htpeople_json.php',
				saveUrl: 'htpeople_save.php',
				updateUrl: 'htpeople_save.php',
				destroyUrl: 'htpeople_del.php',
				toolbar : '#toolbar',
				pagination : true,
				pageSize:50,
				idField : 'id',
				sorting : true,
				rownumbers : true,
				fitColumns : true,
				singleSelect : true,
				columns:[[
					
					/* 
					<th field="firstName" width="50" editor="{type:'validatebox',options:{required:true}}">First Name</th>
                <th field="middleName" width="50" editor="{type:'validatebox',options:{required:false}}">Middle Name</th>
                <th field="lastName" width="50" editor="{type:'validatebox',options:{required:false}}">Last Name</th>
                <th field="gender" width="50" editor="{type:'validatebox',options:{required:false}}">Gender</th>
                <th field="ssn" width="50" editor="{type:'validatebox',options:{required:false}}">SSN</th>
                <th field="dob" width="50" editor="{type:'validatebox',options:{required:false}}">DOB</th>
                <th field="type" width="20" editor="{type:'validatebox',options:{required:false}}">Type</th>
                <th data-options="field:'active',width:25,align:'center',editor:{type:'checkbox',options:{on:'Yes',off:'No'}}">Active</th>
*/
						{field:'firstName',title:'First Name',width:65,editor:{type:'validatebox',options:{required:true}} },
						{field:'middleName',title:'Middle',width:50,editor:'text'},
						{field:'lastName',title:'Last',width:65,editor:'text' },
						{field:'gender',title:'Gender',width:35,
							
							editor:{
								type:'combobox',
								options:{
									valueField:'type',
									textField:'name',
									data:genderType,
									required:true
								}
							},formatter:function(value,row,index){
								if (value=='m')
								 { return 'Male'; } 
								else 
								{ return 'Female'; } 
							}
						},
						//{field:'gender',title:'Gender',width:50,editor:'text' },
						{field:'ssn',title:'SSN',width:50,editor:'text' },
						{field:'dob',title:'DOB',width:50,editor:'text' },
						{field:'type',title:'Type',width:50,editor:'text' ,
							
							editor:{
								type:'combobox',
								options:{
									valueField:'type',
									textField:'name',
									data:workerType,
									required:true
								}
							},formatter:function(value,row,index){
									
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
						{field:'active',title:'Active',width:25,align:'center',
							editor:{
								type:'checkbox',
								options:{
									on: 'Yes',
									off: 'No'
								}
							}
						}
						/* {field:'productid',title:'Product',width:100,
							formatter:function(value,row){
								return row.productname || value;
							},
							editor:{
								type:'combobox',
								options:{
									valueField:'productid',
									textField:'name',
									data:products,
									required:true
								}
							}
						},*/
						
						//{field:'attr1',title:'Attribute',width:180,editor:'text'},
						 

					
				]],
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