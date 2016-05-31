<?php 
function fn_mysql_pdo_con()
{
	$conx = new PDO("mysql:host=10.6.2.103;dbname=estrategias_isc",
								"dbuser", "dbuser!");
	return $conx;							
}
?>