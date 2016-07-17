<?php require_once("../include/functions.php"); ?>
<?php

$cust_forename = isset ( $_POST ['cust_forename'] ) ? $_POST ['cust_forename'] : "";
$cust_surname = isset ( $_POST ['cust_surname'] ) ? $_POST ['cust_surname'] : "";
$cust_title = isset ( $_POST ['cust_title'] ) ? $_POST ['cust_title'] : "";
$cust_address = isset ( $_POST ['cust_address'] ) ? $_POST ['cust_address'] : "";
$cust_postcode = isset ( $_POST ['cust_postcode'] ) ? $_POST ['cust_postcode'] : "";
$cust_tel = isset ( $_POST ['cust_tel'] ) ? $_POST ['cust_tel'] : "";
$cust_email = isset ( $_POST ['cust_email'] ) ? $_POST ['cust_email'] : "";
$cust_DOB = isset ( $_POST ['cust_DOB'] ) ? $_POST ['cust_DOB'] : "";
$cust_town = isset ( $_POST ['cust_town'] ) ? $_POST ['cust_town'] : "";
$cust_password = isset ( $_POST ['cust_password'] ) ? $_POST ['cust_password'] : "";

include '../include/Connection.php';

// 2. Perform database query
	$query  = "INSERT INTO customer (cust_forename, cust_surname, cust_title, cust_address, cust_postcode, cust_tel, cust_email, cust_DOB, cust_town, cust_password) VALUES ('$cust_forename', '$cust_surname', '$cust_title', '$cust_address', '$cust_postcode', '$cust_tel', '$cust_email', '$cust_DOB', '$cust_town', '$cust_password')";
	
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
     // 4. Release returned data
   #  mysqli_free_result($result);
     // 5. Close database connection
    #s mysqli_close($connection);
header("Location: login.php");



?>


        
      