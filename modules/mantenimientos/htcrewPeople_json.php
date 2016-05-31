<?php
		include_once("../conexion_ip78.php");
		
		$idx = isset($_GET["id"])?$_GET["id"]:"0";
 		$datosArray = array();
 
			
            
         
            $sql = "SELECT c.id,CONCAT(p.firstName,' ',middleName,' ',lastName) AS name,p.type
 					FROM ht_crewpeople c INNER JOIN ht_people p 
						ON c.idPeople = p.id
					WHERE c.idCrew = '".$idx."'";
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