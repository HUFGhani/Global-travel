<?php
	// Start the session
	session_start();

	$Email = isset($_POST['Email']) ? $_POST['Email'] : '';
	$Password = isset($_POST['Password']) ? $_POST['Password'] : '';
    $return = isset($_POST['return']) ? $_POST['return'] : "index.php";


include '../include/Connection.php';

if ($stmt = $connection->prepare("SELECT * FROM customer WHERE cust_email=? AND cust_password =?")) {
 
    // Bind a variable to the parameter as a string. 
    $stmt->bind_param("ss", $Email, $Password);
 
    // Execute the statement.
    $stmt->execute();
 
    // Get the variables from the query.
   // $stmt->bind_result($result);
    $result = $stmt->get_result();
    $stmt->fetch();

    // Close the prepared statement.
    $stmt->close();
}

	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
		
	}
	
	 if(mysqli_num_rows($result)==0){
         // Redirecting To Login
        if ($stmt2 = $connection->prepare("SELECT * FROM employee WHERE emp_email=? AND emp_password =?")) {
 
            // Bind a variable to the parameter as a string. 
            $stmt2->bind_param("ss", $Email, $Password);

            // Execute the statement.
            $stmt2->execute();

            // Get the variables from the query.
           // $stmt->bind_result($result);
            $result2 = $stmt2->get_result();
            $stmt2->fetch();

            // Close the prepared statement.
            $stmt2->close();
        }
        
        if (!$result2) {
            header("Location: Login.php?login=false"); 
        }
        if(mysqli_num_rows($result2)==0){
            header("Location: Login.php?login=false"); 
	    }
        
        else{
             while($row = mysqli_fetch_array($result2))
            {
                $_SESSION['emp_id'] = $row['emp_id'];
                $_SESSION['emp_forename'] = $row['emp_forename'];
            }          
            header("Location: admin.php"); 
	    }   		
	}
	else{
		 while($row = mysqli_fetch_array($result))
        {
            $_SESSION['cust_id'] = $row['cust_id'];
        	$_SESSION['cust_forename'] = $row['cust_forename'];
		}

	
		header("Location: $return"); 
	}
	
	// 4. Release returned data
    mysqli_free_result($result);
   // 5. Close database connection
   mysqli_close($connection);
?>