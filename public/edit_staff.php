
<?php require_once("../include/Connection.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php include '../include/AdminHeader.php';?>

<?php
  $admin = find_staff_by_id($_GET["emp_id"]);
  
  if (!$admin) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_staff.php");
  }
?>

<?php 
if (isset($_POST['submit'])) {
	$emp_id = $admin["emp_id"];
    $emp_email = mysql_prep($_POST["emp_email"]);
	$emp_forename = mysql_prep($_POST["emp_forename"]);
	$emp_surname = mysql_prep($_POST["emp_surname"]);
	$emp_address = mysql_prep($_POST["emp_address"]);
	$emp_town = mysql_prep($_POST["emp_town"]);
	$emp_postcode = mysql_prep($_POST["emp_postcode"]);
	$emp_tel = mysql_prep($_POST["emp_tel"]);
	$emp_salary = mysql_prep($_POST["emp_salary"]);
	$emp_password = mysql_prep($_POST["emp_password"]);
    
//	$query  = "UPDATE employee SET ";
//    $query .= "emp_email = '{$emp_email}' ";
//	$query .= "emp_forename = '{$emp_forename}' ";
//	$query .= "emp_surname = '{$emp_surname}', ";
//	$query .= "emp_address = '{$emp_address}' ";
//	$query .= "emp_town = '{$emp_town}', ";
//	$query .= "emp_postcode = '{$emp_postcode}' ";
//	$query .= "emp_tel = '{$emp_tel}', ";
//	$query .= "emp_salary = '{$emp_salary}' ";
//	$query .= "emp_password = '{$emp_password}' ";
//	$query .= "WHERE emp_id = {$emp_id} ";
//	$result = mysqli_query($connection, $query);
    

		//prepared statement to prevent SQL injection
		$stmt = $connection->prepare("UPDATE employee SET
		 emp_email = ?,
         emp_forename = ?,
		 emp_surname = ?,
		 emp_address = ?,
         emp_town = ?,
		 emp_postcode = ?,
		 emp_tel  = ?,
		 emp_salary  = ?, 
         emp_password  = ? 
		 WHERE emp_id = $emp_id");
			
		//bind params from form post
		$stmt->bind_param("sssssssss", $_POST['emp_email'], $_POST['emp_forename'],
		$_POST['emp_surname'], $_POST['emp_address'], $_POST['emp_town'], $_POST['emp_postcode'], $_POST['emp_tel'], $_POST['emp_salary'], $_POST['emp_password']);

		//execute prepared statement
		if($stmt->execute()){
		}else{
			die("Database query failed.");
		}

		$stmt->close();
	
		header("Location: manage_staff.php"); 
	} // end: if (isset($_POS

?>

<body>
     
    <h2>Edit Admin: <?php echo htmlentities($admin["emp_email"]); ?></h2>
    <form action="edit_staff.php?emp_id=<?php echo urlencode($admin["emp_id"]); ?>" method="post">
      <p>Username/email address:
        <input type="email" name="emp_email" value="<?php echo htmlentities($admin["emp_email"] ); ?>" />
      </p>
      <p>forename:
        <input type="text" name="emp_forename"  value="<?php echo htmlentities($admin["emp_forename"] ); ?>" />
      </p>
      <p>surname:
        <input type="text" name="emp_surname"  value="<?php echo htmlentities($admin["emp_surname"] ); ?>" />
      </p>
      <p>address:
        <input type="text" name="emp_address"  value="<?php echo htmlentities($admin["emp_address"] ); ?>" />
      </p>
      <p>town:
        <input type="text" name="emp_town"  value="<?php echo htmlentities($admin["emp_town"] ); ?>" />
      </p>
      <p>postcode:
        <input type="text" name="emp_postcode"  value="<?php echo htmlentities($admin["emp_postcode"] ); ?>" />
      </p>
            <p>tel:
        <input type="tel" name="emp_tel"  value="<?php echo htmlentities($admin["emp_tel"] ); ?>" />
      </p>
      <p>salary:
        <input type="number" name="emp_salary"  value="<?php echo htmlentities($admin["emp_salary"] ); ?>" />
      </p>
      <p>hire date:
        <input type="date" name="emp_hire_date" disabled="disabled" value="<?php echo htmlentities($admin["emp_hire_date"] ); ?>" />
      <p>Password:
        <input type="password" name="emp_password" value="<?php echo htmlentities($admin["emp_password"] ); ?>" />
      </p>
      <input type="submit" name="submit" value="Edit Admin" />
    </form>
    <br />
    <a href="manage_staff.php">Cancel</a>
    
</body>
</html>