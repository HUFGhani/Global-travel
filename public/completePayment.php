<?php
	// Start the session
	session_start();

	$cardType = isset($_POST['cardType']) ? $_POST['cardType'] : '';
	$cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
    $cardHolder = isset($_POST['cardHolder']) ? $_POST['cardHolder'] : '';
    $expiryDate = isset($_POST['expiryDate']) ? $_POST['expiryDate'] : '';
    $issueNumber = isset($_POST['issueNumber']) ? $_POST['issueNumber'] : '';
    $securityCode = isset($_POST['securityCode']) ? $_POST['securityCode'] : '';
    $cust_id = $_SESSION['cust_id'];

//echo $cust_id;


include '../include/Connection.php';
   
 for($i = 0; $i < count($_SESSION['items']); $i++){
     
     
     //insert into booking table
     if ($stmt = $connection->prepare("INSERT INTO booking (booking_date, booking_adults, booking_children, booking_students, booking_senior, cust_id_fk) VALUES (?,?, ?, ?, ?, ?)")) {
    
        // Bind the variables to the parameter as strings. 
        $stmt->bind_param("ssssss", date('Y-m-d'), $_SESSION['items'][$i]['adultq'], $_SESSION['items'][$i]['childq'], $_SESSION['items'][$i]['studentq'], $_SESSION['items'][$i]['seniorq'], $cust_id);

            // Execute the statement.
        $stmt->execute();

        // Close the prepared statement.
        $stmt->close();
        $booking = mysqli_insert_id($connection);
     }  
     
     //insert into booking_attraction table
     if ($stmt2 = $connection->prepare("INSERT INTO booking_attractions (attract_id_ck, booking_id_ck, attract_date) VALUES (?,?,?)")) {
        $attract_id = $_SESSION['items'][$i]['attract_id'];
 
        // Bind the variables to the parameter as strings. 
        $stmt2->bind_param("sss", $attract_id, $booking, date('Y-m-d'));

            // Execute the statement.
        $stmt2->execute();

        // Close the prepared statement.
        $stmt2->close();
     }   
     
    if ($stmt3 = $connection->prepare("INSERT INTO invoice (booking_id_fk, invoice_date, invoice_total) VALUES (?,?,?)")) {
            $total = $_SESSION['items'][$i]['total'];
                
        // Bind the variables to the parameter as strings. 
        $stmt3->bind_param("sss", $booking, date('Y-m-d'), $total);

            // Execute the statement.
        $stmt3->execute();

        // Close the prepared statement.
        $stmt3->close();
        $invoice = mysqli_insert_id($connection);

     } 
     
    if ($stmt4 = $connection->prepare("INSERT INTO payment_details (cust_id_fk, invoice_id_fk, pay_card_type, pay_total, pay_date, pay_cardNo, pay_issue_no, pay_expiry_date, pay_security_code, pay_card_holder) VALUES (?,?,?,?,?,?,?,?,?,?)")) {
            $total = $_SESSION['items'][$i]['total'];
               
        if(trim($issueNumber) == ''){
             $issueNumber = null;
        }
        
        // Bind the variables to the parameter as strings. 
        $stmt4->bind_param("ssssssssss", $cust_id, $invoice, $cardType, $total, date('Y-m-d'), $cardNumber, $issueNumber, $expiryDate, $securityCode, $cardHolder);

            // Execute the statement.
        $stmt4->execute();

        // Close the prepared statement.
        $stmt4->close();
     } 
     
     
 }
// 5. Close database connection
   mysqli_close($connection);

        unset($_SESSION['items']);

header("Location: shoppingCart.php?order=complete");
   
?>