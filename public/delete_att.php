<?php include '../include/Connection.php';?>
<?php include '../include/AdminHeader.php';?>
<?php require_once("../include/functions.php"); ?>
<?php
   $admin= find_att_by_id($_GET["attract_id"]);
  if (!$admin) {
  	// admin ID was missing or invalid or
  	// admin couldn't be found in database
  	redirect_to("manage_attraction.php");
  }
  
  
  $id = $admin["emp_id"];
  $query = "DELETE FROM attractions WHERE attract_id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);
  
  if ($result && mysqli_affected_rows($connection) == 1) {
  	// Success
  	$_SESSION["message"] = "Admin deleted.";
  	redirect_to("manage_staff.php");
  } else {
  	// Failure
  	$_SESSION["message"] = "Admin deletion failed.";
  	redirect_to("manage_attraction.php");
  }
?>
