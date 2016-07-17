
<?php require_once("../include/functions.php"); ?>
<?php require_once('../include/Connection.php');?>
<?php include '../include/AdminHeader.php';?>
<?php
$admin = find_att_by_id($_GET["attract_id"]);
  
  if (!$admin) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("Manage_attraction.php");
  }
?>

<?php 
if (isset($_POST['submit'])) {
	$attract_id = $admin["attract_id"];
	$description = mysql_prep($_POST["description"]);
	$attract_name = mysql_prep($_POST["attract_name"]);
	$attract_website = mysql_prep($_POST["attract_website"]);
	$attract_phone = mysql_prep($_POST["attract_phone"]);
	$attract_extra_info = mysql_prep($_POST["attract_extra_info"]);
	$attract_adult_price = mysql_prep($_POST["attract_adult_price"]);
	$attract_child_price = mysql_prep($_POST["attract_child_price"]);
	$attract_student_price = mysql_prep($_POST["attract_student_price"]);
	$attract_senior_price = mysql_prep($_POST["attract_senior_price"]);
	


    
    //prepared statement to prevent SQL injection
		$stmt = $connection->prepare("UPDATE attractions SET
		 description = ?,
         attract_name = ?,
		 attract_website = ?,
		 attract_phone = ?,
         attract_extra_info = ?,
		 attract_adult_price = ?,
		 attract_child_price  = ?,
		 attract_student_price  = ?, 
         attract_senior_price  = ? 
		 WHERE attract_id = $attract_id");
			
		//bind params from form post
		$stmt->bind_param("sssssssss", $description, $attract_name,
		$attract_website, $attract_phone, $attract_extra_info, $attract_adult_price,$attract_child_price, $attract_student_price,$attract_senior_price);

		//execute prepared statement
		if($stmt->execute()){
		}else{
			die("Database query failed.");
                echo $attract_id;
                echo $description;
                echo $attract_name;
                echo $attract_website;
                echo $attract_phone;
                echo $attract_extra_info;
                echo $attract_adult_price;
                echo $attract_child_price;
                echo $attract_student_price;
                echo $attract_senior_price;
		}

		$stmt->close();
    header("Location: Manage_attraction.php"); 

	
	} // end: if (isset($_POS

?>

<body class='bookings'>
      <h2>Edit Attraction: <?php echo htmlentities($admin["attract_name"]); ?></h2>
    <form action="edit_att.php?attract_id=<?php echo urlencode($admin["attract_id"]); ?>" method="post">
    <p>attract name:
        <input type="text" name="attract_name"  value="<?php echo htmlentities($admin["attract_name"] ); ?>" />
      </p>
      <p>description:</p>
      <p>
       <textarea rows="4" cols="50" name ="description"><?php echo htmlentities($admin["description"] ); ?>" </textarea>
      </p>
      <p>attract website:
        <input type="text" name="attract_website"  value="<?php echo htmlentities($admin["attract_website"] ); ?>" />
      </p>
       <p>attract phone:
        <input type="text" name="attract_phone" value="<?php echo htmlentities($admin["attract_phone"] ); ?>" />
      </p>
      <p>attract extra info:</p>
      <p>
       <textarea rows="4" cols="50" name ="attract_extra_info"><?php echo htmlentities($admin["attract_extra_info"] ); ?> </textarea>
      </p>
      <p>attract adult price:
        <input type="text" name="attract_adult_price"  value="<?php echo htmlentities($admin["attract_adult_price"] ); ?>" />
      </p>
      <p>attract child price:
        <input type="text" name="attract_child_price"  value="<?php echo htmlentities($admin["attract_child_price"] ); ?>" />
      </p>
      <p>attract student price:
        <input type="text" name="attract_student_price"  value="<?php echo htmlentities($admin["attract_student_price"] ); ?>" />
      </p>
       <p>attract senior price:
        <input type="text" name="attract_senior_price"  value="<?php echo htmlentities($admin["attract_senior_price"] ); ?>" />
      </p>
       <input type="submit" name="submit" value="Edit Attractions" />
    </form>
    <br />
    <a href="manage_attraction.php">Cancel</a>
</body>
</html>