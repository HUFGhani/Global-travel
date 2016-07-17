<?php
include '../include/Header.php';
include '../include/Connection.php';
	// 2. Perform database query
	   $customer_id =  $_SESSION['cust_id'];

	
	$stmt = mysqli_stmt_init($connection);
	if (mysqli_stmt_prepare($stmt, "SELECT DISTINCT b.booking_id, a.attract_name, ba.attract_date, 
										b.booking_adults, b.booking_children, b.booking_students, 
										b.booking_senior, i.invoice_total
									FROM booking b
									INNER JOIN customer c
										ON b.cust_id_fk = ?
									INNER JOIN invoice i
										ON b.booking_id = i.booking_id_fk
									INNER JOIN booking_attractions ba
										ON ba.booking_id_ck = b.booking_id
									INNER JOIN attractions a
										ON a.attract_id = ba.attract_id_ck")) {
	
	// Bind customer_id parameter
	mysqli_stmt_bind_param($stmt, "i", $customer_id);
	
	// Execute query
	mysqli_stmt_execute($stmt);
	
	// Store the result(s)
	mysqli_stmt_store_result($stmt);
	
	// Get number of rows
	$rows = mysqli_stmt_num_rows($stmt);
	
	// Bind variables
	mysqli_stmt_bind_result($stmt, $bookingid, $attractname, $attractdate, $adults, $children, 
							       $students, $senior, $total);
		}

	?>

<!doctype html>
<html>


<head>
    <meta charset="UTF-8">
    <title>Display bookings</title>
    
    <link rel="stylesheet" type="text/css" href="css.css">
</head>


<body>

    <?php
            if ($rows > 0) {
				echo "<table class='bookings'>
						<tr> 
							<th>Booking ID</th> 
							<th>Date</th> 
							<th>Attraction Name</th> 
							<th>No. of Adults</th> 
							<th>No. of Children</th> 
							<th>No. of Students</th> 
							<th>No. of Seniors</th> 
							<th>Total Cost</th> 
							<th>Delete Booking</th> 
						</tr>";
				  
				// output data of each row
				// Could add link from 'attraction name' field to 'attraction info' page
				while (mysqli_stmt_fetch($stmt)) {
					echo "<tr>" .
							"<td>" . $bookingid . "</td>" .
							"<td>" . $attractname . "</td>" .
							"<td>" . $attractdate . "</td>" .
							"<td>" . $adults . "</td>" .
							"<td>" . $children . "</td>" .
							"<td>" . $students . "</td>" .
							"<td>" . $senior . "</td>" .
							"<td>" . $total . "</td>" .
                            "<td>"?> <form action="delete-bookings.php" method="post">
 		                               <input type="hidden" name="booking_id" value="<?php echo $bookingid; ?>"/>
                                       <input type="submit" value="Remove" class='Buttons'/>
                                     </form> </td> <?php
//							"<td>" . "<a href=delete-bookings.php?bookingID=" . $bookingid . ">[x]</a>" . "</td>" .
						 "</tr>";
						 }
						 echo "</table>";
						 } else {
							 // output 'No records' message
							 echo "<table> <tr> <th>No results found!</th> </tr> </table>";
							 }
	?>
    
</body>

    <?php 
	// 4. Release returned data
	mysqli_stmt_close($stmt);

	// 5. Close database connection
	mysqli_close($connection);
	?>
	
</html>