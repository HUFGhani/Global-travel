<?php
include '../include/Header.php';
include '../include/Connection.php';

	// Retrieve booking_id
		$booking_id = $_POST['booking_id'];
//		$booking_id = intval($_GET['bookingID']);
	
	// Delete booking data from 'booking_attractions' entity (foreign key constraint)
		

    if ($stmt = mysqli_stmt_init($connection)) {	

		if (mysqli_stmt_prepare($stmt, "DELETE FROM booking_attractions WHERE booking_id_ck = ?")) {
	
			// Bind customer_id parameter
				mysqli_stmt_bind_param($stmt, "i", $booking_id);
	
			// Execute query
				mysqli_stmt_execute($stmt);
	
			// Store the result(s)
				mysqli_stmt_store_result($stmt);
	
			// Get number of rows
				$ba_rows = mysqli_stmt_affected_rows($stmt);
				
			}
	
	
	// Delete invoice data from 'payment_details' entity (foreign key constraint)
	
		if (mysqli_stmt_prepare($stmt, "DELETE FROM payment_details WHERE invoice_id_fk = (SELECT invoice_id FROM invoice WHERE
                                        booking_id_fk = ?)")) {
	
			// Bind customer_id parameter
			    mysqli_stmt_bind_param($stmt, "i", $booking_id);
	
			// Execute query
				mysqli_stmt_execute($stmt);
	
			// Store the result(s)
				mysqli_stmt_store_result($stmt);
	
			// Get number of rows
				$pd_rows = mysqli_stmt_affected_rows($stmt);

			}
	
	
	// Delete booking data from 'invoice' entity (foreign key constraint)
	
		if (mysqli_stmt_prepare($stmt, "DELETE FROM invoice WHERE booking_id_fk = ?")) {
	
			// Bind customer_id parameter
				mysqli_stmt_bind_param($stmt, "i", $booking_id);
	
			// Execute query
				mysqli_stmt_execute($stmt);
	
			// Store the result(s)
				mysqli_stmt_store_result($stmt);
	
			// Get number of rows
				$i_rows = mysqli_stmt_affected_rows($stmt);
			
            }
        
	
	// Delete booking data from 'booking' entity
		
		if (mysqli_stmt_prepare($stmt, "DELETE FROM booking WHERE booking_id = ?")) {
	
			// Bind customer_id parameter
				mysqli_stmt_bind_param($stmt, "i", $booking_id);
	
			// Execute query
				mysqli_stmt_execute($stmt);
	
			// Store the result(s)
				mysqli_stmt_store_result($stmt);
	
			// Get number of rows
				$b_rows = mysqli_stmt_affected_rows($stmt);
		
			}
    }
	
	// Test for query errors
		// Record not in database
            if (!$stmt) {
                echo "<table> <tr> <th>" .
					 "Connection error" .
					 "</th> </tr> </table>";
            } else if ($ba_rows < 1 && $pd_rows < 1 && $i_rows < 1 && $b_rows < 1) {
				echo "<table> <tr> <th>" .
					 "Unable to delete booking: Record" . $booking_id . " - not found" .
					 "</th> </tr> </table>";
		// If no record is removed from 'booking_attractions' entity...
			} else if ($ba_rows < 1) {
				echo "<table> <tr> <th>" .
					 "<h2>Error deleting booking (ba): " . mysqli_error($stmt) . "</h2>" .
					 "</th> </tr> </table>";
		// If no record is removed from 'payment_details' entity...
			} else if ($pd_rows < 1) {
				echo "<table> <tr> <th>" .
					 "<h2>Error deleting booking (pd): " . mysqli_error($stmt) . "</h2>" .
					 "</th> </tr> </table>";
		// If no record is removed from 'invoice' entity... 
			} else if ($i_rows < 1) {
				echo "<table> <tr> <th>" .
					 "<h2>Error deleting booking (i): " . mysqli_error($stmt) . "</h2>" . 
					 "</th> </tr> </table>";
		// If no record is removed from 'booking' entity...
			} else if ($b_rows < 1) {
				echo "<table> <tr> <th>" .
					 "<h2>Error deleting booking (b): " . mysqli_error($stmt) . "</h2>" .
					 "</th> </tr> </table>";
		// If no issues arise...
			} else {
				echo "<table> <th> Booking (ID: $booking_id) successfully removed! </th> </table>";
				}
	?>

<!doctype html>
<html>


<head>
    <meta charset="UTF-8">
    <title>Delete booking</title>
    
    <link rel="stylesheet" type="text/css" href="css.css">
</head>


<body>
    
</body>

    <?php
	// 4. Release returned data
	mysqli_stmt_close($stmt);
	// 5. Close database connection
	mysqli_close($connection);
	?>
	
</html>