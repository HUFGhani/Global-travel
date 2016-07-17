<?php include '../include/Connection.php';?>
<?php include '../include/AdminHeader.php';?>

<body class='bookings'>
<h2>Yearly Financial Report</h2>
    <?php
    // 2. Perform database query
    $query  = "SELECT ROUND(SUM(emp_salary),2) 'Yearly Outgoings', ROUND(SUM(invoice_total),2)'Yearly Income',	ROUND((SUM(invoice_total) - SUM(emp_salary)),2) 'Gross'FROM
employee NATURAL JOIN invoice WHERE invoice_date LIKE'%15%'";
    
    $result = mysqli_query($connection, $query);
    // Test if there was a query error
    if (!$result) {
    	die("Database query failed.");
    }
?>
<table>
		<tr>
		<th>Yearly Outgoings</th>
		<th>Yearly Income</th>
		<th>Gross</th>
		</tr>
		  <tr>
		   <?php while($row = mysqli_fetch_assoc($result)){ ?>
		  <td><?php echo $sum = $row['Yearly Outgoings'];?></td>
        <td><?php echo $sum = $row['Yearly Income'];?></td>
	  <td><?php echo $sum = $row['Gross'];?></td>
</tr>
<?php } ?>
</table>
</body>
    <?php
 // 4. Release returned data
		  mysqli_free_result($result);
 // 5. Close database connection
mysqli_close($connection);
?>
</html>