<?php
include '../include/Header.php';
include '../include/connection.php';

	//this will be gathered from session. uncomment Code commented below!
	//$cust_id = 1; //just for testing - needs deleting

if(!$signedIn){
     echo "<h1>You are not signed in.</h1>
          <h2>Sign in here to view your account</h2>
          <form action='login.php' id='labelCenter'>
              <input type='submit' value='Sign In' class='Buttons'/>
              <input type='hidden' name='return' value='$page'>
          </form>";
     
 }
 else{

	$cust_id = $_SESSION['cust_id'];

	//to check if account info has been changed 
	if(isset($_POST['AccountChanges'])){


		//prepared statement to prevent SQL injection
		$stmt = $connection->prepare("UPDATE customer SET
		 cust_forename = ?,
		 cust_surname = ?,
		 cust_address = ?,
		 cust_postcode = ?,
		 cust_email = ?,
		 cust_tel  = ?,
		 cust_DOB  = ? 
		 WHERE cust_id = $cust_id");
			
		//bind params from form post
		$stmt->bind_param("sssssss", $_POST['firstname'], $_POST['surname'],
		$_POST['address'], $_POST['postcode'], $_POST['email'], $_POST['tel'], $_POST['dob']);

		//execute prepared statement
		if($stmt->execute()){
		}else{
			die("Database query failed.");
		}

		$stmt->close();

	}
?>


		<?php
			//prepared statement to prevent SQL injection
			// database query to select all customer information...For display...
			$stmt = $connection->prepare("SELECT * FROM customer WHERE cust_id = ? ");
			$stmt->bind_param("i", $cust_id);

			//execute prepared statement
			if($stmt->execute()){
				$result = $stmt->get_result();
				$stmt->close();

				//return data
				while($row = mysqli_fetch_assoc($result)){
					$name = $row["cust_forename"];
					$address = $row["cust_address"] . "<br />"
							   . $row["cust_postcode"];
					$email = $row["cust_email"];
					$tel = $row["cust_tel"];
				}

				echo "<h1>Welcome $name  </h1>";
				mysqli_free_result($result);

			}else{
				die("Database query failed.");
			}
		

		?>	

 <div id="seperator">
 	<h2>Account Overview</h2><br/>

		<?php echo
			"<h3>$address</h3>
			<h3>$email</h3>
			<h3>$tel</h3>"
		?>

 	<form action= "editInfo.php" method ="post" >
 		<input type="hidden" name="cust_id" value ="<?php echo $cust_id ?>">
 		<input type="submit" value="Edit Account Details" class ="Buttons"/>
	</form>
 	<form action= "display-bookings.php" method ="post">
 		<input type="hidden" name="cust_id" value ="<?php echo $cust_id ?>" >
 		<input type="submit" value="View Bookings" class="Buttons"/>
	</form>


	</div>   
</body>

</html>


<?php

	mysqli_close($connection);
	}
?>