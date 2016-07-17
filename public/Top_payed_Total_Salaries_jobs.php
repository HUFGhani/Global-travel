<?php include '../include/Connection.php';?>
<?php include '../include/AdminHeader.php';?>

<body class='bookings'>
<h2>Top Earning Jobs</h2>
    <?php
    // 2. Perform database query
    $query  = "SELECT emp_job_descript 'Job Type', SUM(emp_salary) ' Total Salaries' FROM employee GROUP BY emp_job_descript ORDER BY 2 DESC";
    
    $result = mysqli_query($connection, $query);
    // Test if there was a query error
    if (!$result) {
    	die("Database query failed.");
    }
?>
<table >
		<tr>
		<th>Job Type</th>
		<th>Total Salaries</th>
		</tr>
		  <tr>
		   <?php while($row = mysqli_fetch_assoc($result)){ ?>
		  <td><?php echo $sum = $row['Job Type'];?></td>
<td><?php echo $sum = $row['Total Salaries'];?></td>
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