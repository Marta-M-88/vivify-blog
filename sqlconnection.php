<?php
$servername = "127.0.0.1";
$username = "root";
$password = " ";
$dbname = "blog";

$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
try {
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // namestam PDO error mode na izuzetak
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>