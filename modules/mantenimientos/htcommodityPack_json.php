<?php
		include_once("../conexion_ip78.php");
		
		$idx = isset($_GET["id"])?$_GET["id"]:"0";
 		$datosArray = array();
 
			
            
         
            $sql = "SELECT id,quantity,name,idCommodity,active FROM ht_CommodityPack WHERE idCommodity = '".$idx."'";
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