<?php
		include_once("../conexion_ip78.php");
		
		$name = isset($_POST["name"])?$_POST["name"]:"0";
		$active = isset($_POST["active"])?$_POST["active"]:"0";
		$isNew = isset($_POST["isNewRecord"])?1:0;
		$idx = isset($_POST["id"])?$_POST["id"]:"0";
		//
		
		//echo "new: ".$isNew;
		  
		if($active=="Yes")
		{ $active = 1;}
		else
		{ $active = 0;}
         
		 	if($isNew)
             { $sql = "INSERT INTO ht_grower (name,active) VALUES ('".$name."','".$active."')"; 
			 }
			 else
			 { $sql = "UPDATE ht_grower SET name = '".$name."',active = '".$active."' WHERE id= '".$idx."'"; }
           // $res = mysqli_query($sql);
			  //echo $sql;
			 
			  if(!$db->query($sql))
			  {   die('Error [' . $db->error . ']'); }
			  else
			  {
				  if($isNew)
				  { $idx = $db->insert_id; }
				  
				  echo json_encode(array(
						'id' => $idx,
						'name' => $name,
						'active' => $active));
				  }
            
			 
			
			
			//$result->free();
//			$db->close();
			
			
			//echo json_encode($datosArray);
	?>