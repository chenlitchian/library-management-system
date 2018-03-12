<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','library');
// Establish database connection.

// define('DB_HOST','mytestdb.cvt1z1cuzptx.us-east-2.rds.amazonaws.com:3306');
// define('DB_USER','chenlitchian');
// define('DB_PASS','12341234');
// define('DB_NAME','library');

try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
echo "Connected successfully"; 
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
echo "Connected fail"; 
}
?>