<?php
		include_once("../conexion_ip78.php");
		
		$name = isset($_POST["name"])?$_POST["name"]:"0";
		$active = isset($_POST["active"])?$_POST["active"]:"1";
		$quantity = isset($_POST["quantity"])?$_POST["quantity"]:"0";
		$isNew = isset($_POST["isNewRecord"])?1:1;
		$idx = isset($_GET["id"])?$_GET["id"]:"0";
		//
		
		//echo "new: ".$isNew;
		  
		if($active=="Yes")
		{ $active = 1;}
		else
		{ $active = 0;}
         
		 	if($isNew)
             { $sql = "INSERT INTO ht_CommodityPack (name,quantity,active,idCommodity) VALUES ('".$name."','".$quantity."','".$active."','".$idx."')"; 
			 }
			 else
			 { $sql = "UPDATE ht_CommodityPack SET name = '".$name."',active = '".$active."',quantity = '".$quantity."' WHERE id= '".$idx."'"; }
           // $res = mysqli_query($sql);
			  // echo $sql;
			 
			  if(!$db->query($sql))
			  {   die('Error [' . $db->error . ']'); }
			  else
			  {
				  if($isNew)
				  { $idx = $db->insert_id; }
				  
				  echo json_encode(array(
						'id' => $idx,
						'name' => $name,
						'idCommodity' => $idx,
						'quantity' => $quantity,
						'active' => $active));
				  }
            
			 
			
			
			//$result->free();
//			$db->close();
			
			
			//echo json_encode($datosArray);
	?>