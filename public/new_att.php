
<?php require_once("../include/functions.php"); ?>
<?php require_once('../include/Connection.php');?>
<?php include '../include/AdminHeader.php';?>
<?php
//$admin = find_att_by_id($_GET["attract_id"]);
  
//  if (!$admin) {
//    // admin ID was missing or invalid or 
//    // admin couldn't be found in database
//    redirect_to("Manage_attraction.php");
//  }
?>

<?php 
if (isset($_POST['submit'])) {
	$description = mysql_prep($_POST["description"]);
	$attract_name = mysql_prep($_POST["attract_name"]);
    $city_id_fk = mysql_prep($_POST["city_id_fk"]);
	$emp_id_fk = mysql_prep($_POST["emp_id_fk"]);
	$attract_website = mysql_prep($_POST["attract_website"]);
	$attract_phone = mysql_prep($_POST["attract_phone"]);
	$attract_extra_info = mysql_prep($_POST["attract_extra_info"]);
	$attract_adult_price = mysql_prep($_POST["attract_adult_price"]);
	$attract_child_price = mysql_prep($_POST["attract_child_price"]);
	$attract_student_price = mysql_prep($_POST["attract_student_price"]);
	$attract_senior_price = mysql_prep($_POST["attract_senior_price"]);

    
      //prepared statement to prevent SQL injection
	$stmt = $connection->prepare("Insert Into attractions (city_id_fk, emp_id_fk, description, attract_name, attract_website, attract_phone, attract_extra_info, attract_adult_price, attract_child_price, attract_student_price , attract_senior_price) Values (?,?,?,?,?,?,?,?,?,?,?)");
			
		$stmt->bind_param("sssssssssss", $city_id_fk, $emp_id_fk, $description, $attract_name,
		$attract_website, $attract_phone, $attract_extra_info, $attract_adult_price,$attract_child_price, $attract_student_price,$attract_senior_price);

		//execute prepared statement
		if($stmt->execute()){
		}else{
			die("Database query failed.");
		}

		$stmt->close();
	    header("Location: Manage_attraction.php"); 

	} // end: if (isset($_POS

?>

<body class='bookings'>
      <h2>Add Attraction:</h2>
    <form action="new_att.php" method="post">
    <p>attract name:
        <input type="text" name="attract_name"  />
      </p>
      <p>description:</p>
      <p>
       <textarea rows="4" cols="50" name ="description"></textarea>
      </p>
      <p>attract website:
        <input type="text" name="attract_website"  />
      </p>
          <p>City id:
        <input type="text" name="city_id_fk"  />
      </p>
          <p>Employee id:
        <input type="text" name="emp_id_fk"  />
      </p>
       <p>attract phone:
        <input type="text" name="attract_phone"/>
      </p>
      <p>attract extra info:</p>
      <p>
       <textarea rows="4" cols="50" name ="attract_extra_info"></textarea>
      </p>
      <p>attract adult price:
        <input type="text" name="attract_adult_price" />
      </p>
      <p>attract child price:
        <input type="text" name="attract_child_price" />
      </p>
      <p>attract student price:
        <input type="text" name="attract_student_price"  />
      </p>
       <p>attract senior price:
        <input type="text" name="attract_senior_price" />
      </p>
       <input type="submit" name="submit" value="Add Attraction" />
    </form>
    <br />
    <a href="manage_attraction.php">Cancel</a>
</body>
</html>