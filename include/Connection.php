<?php

// 1. Create a database connection
$dbhost = "server";
$dbuser = "dbuser";
$dbpass = "dbpass";
$dbname = "dbname";
//$dbhost = "localhost";
//$dbuser = "root";
//$dbpass = "";
//$dbname = "Global_Tickets_Ltd";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  	// Test if connection occurred.

if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
     	mysqli_connect_error() . 
   	  " (" . mysqli_connect_errno() . ")"
       );
}

?>
