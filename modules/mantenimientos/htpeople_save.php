<?php
		include_once("../conexion_ip78.php");
		
		$firstName = isset($_POST["firstName"])?$_POST["firstName"]:"0";
		$ssn = ($_POST["ssn"])?$_POST["ssn"]:"000-00-0000";
		$dob = ($_POST["dob"])?$_POST["dob"]:"0000-00-00";
		$type = ($_POST["type"])?$_POST["type"]:"wo";//wo,fo,fl,tr
		$lastName = ($_POST["lastName"])?$_POST["lastName"]:"";
		$middleName = ($_POST["middleName"])?$_POST["middleName"]:"";
		$gender = ($_POST["gender"])?$_POST["gender"]:"m";
		$active = ($_POST["active"])?$_POST["active"]:"0";
		
		$isNew = isset($_POST["isNewRecord"])?1:0;
		$idx = isset($_POST["id"])?$_POST["id"]:"0";
		//
		
		//echo "new: ".$isNew;
		  
		if($active=="Yes")
		{ $active = 1;}
		else
		{ $active = 0;}
         
		 	if($isNew)
             { 
			 $sql = "INSERT INTO ht_people (firstName,ssn,dob,type,lastName,middleName,gender,active) 
			 			VALUES ('".$firstName."','".$ssn."','".$dob."','".$type."','".$lastName."','".$middleName."','".$gender."','".$active."')"; 
			 }
			 else
			 { 
			 	$sql = "UPDATE ht_people SET firstName = '".$firstName."',type = '".$type."',ssn = '".$ssn."',dob = '".$dob."',lastName = '".$lastName."',middleName = '".$middleName."',gender = '".$gender."',active = '".$active."' 
			 		 	WHERE id= '".$idx."'"; 
				}
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
						'firstName' => $firstName,
						'middleName' => $middleName,
						'lastName' => $lastName,
						'dob' => $dob,
						'ssn' => $ssn,
						'type' => $type,
						'gender' => $gender,
						'active' => $active));
				  }
            
			 
			
			
			//$result->free();
//			$db->close();
			
			
			//echo json_encode($datosArray);
	?>