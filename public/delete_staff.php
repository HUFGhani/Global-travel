
<?php require_once("../include/Connection.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php
   $admin= find_staff_by_id($_GET["emp_id"]);
  if (!$admin) {
  	// admin ID was missing or invalid or
  	// admin couldn't be found in database
  	redirect_to("manage_staff.php");
  }
  
  
  $id = $admin["emp_id"];

echo $id;
  $query = "DELETE FROM employee WHERE emp_id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);
  
  if ($result && mysqli_affected_rows($connection) == 1) {
  	// Success
  	$_SESSION["message"] = "Admin deleted.";
  	redirect_to("manage_staff.php");
  } else {
  	// Failure
  	$_SESSION["message"] = "Admin deletion failed.";
    redirect_to("manage_staff.php");
  }
?>
