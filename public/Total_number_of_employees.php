<?php include '../include/Connection.php';?>
<?php include '../include/AdminHeader.php';?>

<body class='bookings'>
<h2>Total Number Of Employees</h2>
    <?php
    // 2. Perform database query
    $query  = "SELECT COUNT(*) 'Number of Employees' FROM employee";
    
    $result = mysqli_query($connection, $query);
    // Test if there was a query error
    if (!$result) {
    	die("Database query failed.");
    }
?>
<table>
		<tr>
		<th>Number of Employees</th>
		</tr>
		  <tr>
		   <?php while($row = mysqli_fetch_assoc($result)){ ?>
		  <td><?php echo $sum = $row['Number of Employees'];?></td>

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