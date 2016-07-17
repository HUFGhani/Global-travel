<?php include '../include/Connection.php';?>
<?php include '../include/AdminHeader.php';?>

<body class='bookings'>
<h2>Total of salaries paid per month</h2>
    <?php
    // 2. Perform database query
    $query  = "SELECT ROUND((SUM(emp_salary)/12), 2) as 'Monthly_Salaries' FROM employee";
    
    $result = mysqli_query($connection, $query);
    // Test if there was a query error
    if (!$result) {
    	die("Database query failed.");
    }
$row = mysqli_fetch_assoc($result); ?>
<table class='bookings'>
		<tr>
		<th>Monthly Salaries</th>
		</tr>
		  <tr>
<td><h1><?php echo $sum = $row['Monthly_Salaries'];?></h1></td>
</tr>
</table>
</body>
    <?php
 // 4. Release returned data
		  mysqli_free_result($result);
 // 5. Close database connection
mysqli_close($connection);
?>
</html>