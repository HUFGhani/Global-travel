<?php require_once("../include/Connection.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php include '../include/AdminHeader.php';?>

    <?php
    if (isset($_POST['submit'])) {
    $emp_email = mysql_prep($_POST["emp_email"]);
	$emp_forename = mysql_prep($_POST["emp_forename"]);
	$emp_surname = mysql_prep($_POST["emp_surname"]);
	$emp_address = mysql_prep($_POST["emp_address"]);
	$emp_town = mysql_prep($_POST["emp_town"]);
	$emp_postcode = mysql_prep($_POST["emp_postcode"]);
	$emp_tel = mysql_prep($_POST["emp_tel"]);
	$emp_salary = mysql_prep($_POST["emp_salary"]);
	$emp_job_descript = mysql_prep($_POST["emp_job_descript"]);
    $emp_hire_date = mysql_prep($_POST["emp_hire_date"]);
    $emp_password = mysql_prep($_POST["emp_password"]);
    $mng_id = mysql_prep($_POST["mng_id"]);


    //prepared statement to prevent SQL injection
	$stmt = $connection->prepare("Insert Into employee (
         emp_forename,emp_surname,emp_email,emp_address,emp_town,emp_postcode,emp_tel,emp_salary ,emp_job_descript, emp_password, emp_hire_date,mng_id) Values (?,?,?,?,?,?,?,?,?,?,?,?)");
			
		//bind params from form post
		$stmt->bind_param("ssssssssssss", $_POST['emp_forename'], $_POST['emp_surname'],
		$_POST['emp_email'], $_POST['emp_address'], $_POST['emp_town'], $_POST['emp_postcode'], $_POST['emp_tel'],     $_POST['emp_salary'], $_POST['emp_job_descript'], $_POST['emp_password'], $_POST['emp_hire_date'], $_POST['mng_id']);

		//execute prepared statement
		if($stmt->execute()){
		}else{
			die("Database query failed.");
		}

		$stmt->close();
   
} else {
    	// This is probably a GET request
    
    } // end: if (isset($_POST['submit']))
    
    ?>
    
    <h2>Add New Employee:</h2>
    <form action="new_staff.php?emp_id=<?php echo urlencode($admin["emp_id"]); ?>" method="post">
      <p>Username/Email Address:
        <input type="email" name="emp_email" />
      </p>
      <p>Forename:
        <input type="text" name="emp_forename" />
      </p>
      <p>Surname:
        <input type="text" name="emp_surname"  />
      </p>
      <p>Address:
        <input type="text" name="emp_address"  />
      </p>
      <p>Town:
        <input type="text" name="emp_town" />
      </p>
      <p>Postcode:
        <input type="text" name="emp_postcode" />
      </p>
        <p>Telephone:
        <input type="tel" name="emp_tel"  />
      </p>
      <p>Salary:
        <input type="number" name="emp_salary"  />
      </p>
      <p>Job Description:
         <textarea rows="4" cols="50" name="emp_job_descript"> </textarea>
      </p>
      <p>Hire Date:
        <input type="date" name="emp_hire_date" />
      <p>Password:
        <input type="password" name="emp_password" />
    <p>Manager Id:
        <input type="number" name="mng_id" />
      </p>
      <input type="submit" name="submit" value="Add New Employee" />
    </form>
    <br />
    <a href="manage_staff.php">Cancel</a>
    

</body>
    </html>