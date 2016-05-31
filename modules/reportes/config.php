<?Php
/////// Update your database login details here /////
$dbhost_name = "localhost"; // Your host name 
$database = "estrategias_db";       // Your database name
$username = "dbuser";            // Your login userid 
$password = "dbuser!";            // Your password 
//////// End of database details of your server //////

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?> 