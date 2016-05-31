<?php
		include_once("../conexion_ip78.php");
		
		$idx = isset($_POST["id"])?$_POST["id"]:"0";
		//
		
		//echo "new: ".$isNew;
		  
 
       $sqlT = "SELECT * FROM ht_people WHERE id ='".$idx."'"; 
	   $resT = $db->query($sqlT);
	   $cnt = $resT->num_rows;
	   
		   if($cnt<=0)
			{ 	 
			 $sql = "DELETE FROM ht_people WHERE id= '".$idx."'"; 
         
			 
					  if($db->query($sql))
					  { echo json_encode(array('success'=>true)); }
			}
			else
			{
				echo json_encode(array(
						'isError' => true,
						'msg' => 'Data is Active/ in Use.'
						));
			}
			
?>