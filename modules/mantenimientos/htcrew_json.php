<?php
		include_once("../conexion_ip78.php");
		

 		$datosArray = array();
 
			
            
         
            $sql = "SELECT id,name,active FROM ht_crew";
            //$res = mysqli_query($sql);
			 //echo $sql;
			 
			 if(!$result = $db->query($sql))
			 {   die('Error [' . $db->error . ']'); }
            
			while($row = $result->fetch_assoc())
			{ //echo "1";
				array_push($datosArray, $row);
			}
			
			
			$result->free();
			$db->close();
			echo json_encode($datosArray);
	?>