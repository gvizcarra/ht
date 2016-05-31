<?php 

$titulo = ":. Seguimiento de Estratégias .:";
$hostname_ = "localhost";
$database_ = "estrategias_isc";
$username_ = "dbuser";
$password_ = "dbuser!";
//echo $database_;
$con_ = mysql_connect($hostname_, $username_, $password_) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_, $con_);
?>