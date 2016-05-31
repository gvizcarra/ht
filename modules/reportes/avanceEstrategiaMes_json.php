<?php
include_once("../conexion_pdo_ip78.php");

$idZona = isset($_GET["idZona"])?$_GET["idZona"]:"0";	
 		$datosArray = array();
        try {
			
            $conn = fn_mysql_pdo_con();
            // execute the stored procedure
            $sql = "CALL avanceEstrategiaPorMetaMes('".$idZona."');";
            $res = $conn->query($sql);
			//echo $sql;
            $res->setFetchMode(PDO::FETCH_ASSOC);  
			while ($row = $res->fetch())
			{ //echo "1";
				array_push($datosArray, $row);
			}
			
			echo json_encode($datosArray);
			
        } 
		 catch (PDOException $pe)
		 {
            die("Error occurred:" . $pe->getMessage());
         }
?>