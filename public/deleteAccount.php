<?php
include '../include/Header.php';
include '../include/connection.php';
?>



<?php
$cust_id = $_POST['cust_id'];

$stmt = mysqli_stmt_init($connection);


    $stmt = $connection->prepare("DELETE FROM booking_attractions WHERE booking_id_ck = ANY (SELECT booking_id FROM booking WHERE cust_id_fk = ?)");

    $stmt->bind_param("s", $cust_id);

    //execute prepared statement
    if($stmt->execute()){

     }else{
       die("Database query 1 failed.");

     }



    $stmt = $connection->prepare("DELETE FROM payment_details WHERE cust_id_fk = ?");

    $stmt->bind_param("s", $cust_id);

    //execute prepared statement
    if($stmt->execute()){

     }else{
       die("Database query 2 failed.");

     }

	

	
	$stmt = $connection->prepare("DELETE FROM invoice WHERE booking_id_fk = ANY (SELECT booking_id FROM booking WHERE cust_id_fk = ?)");

    $stmt->bind_param("s", $cust_id);

    //execute prepared statement
    if($stmt->execute()){


     }else{
       die("Database query 3 failed.");

     }

	
	
	$stmt = $connection->prepare("DELETE FROM booking WHERE cust_id_fk = ?");

    $stmt->bind_param("s", $cust_id);

    //execute prepared statement
    if($stmt->execute()){


     }else{
       die("Database query 4 failed. ");

     }




	$stmt = $connection->prepare("DELETE FROM customer WHERE cust_id = ?");

    $stmt->bind_param("s", $cust_id);

    //execute prepared statement
    if($stmt->execute()){


       session_destroy();

     }else{
       die("Database query 5 failed. ");

     }

			
			 $stmt->close();

			

?>


</body>

</html>


<?php
mysqli_close($connection);
?>