<?php include '../include/Connection.php';?>
<?php include '../include/AdminHeader.php';?>

<body class='bookings'>
<h2>Search Employees by Job Title:</h2>
    <?php

    // 2. Perform database query
    $query  = "SELECT emp_id, emp_forename, emp_surname, emp_job_descript FROM employee WHERE UPPER(emp_job_descript) LIKE '%".$_GET["job"]."%'";
    
    $result = mysqli_query($connection, $query);
    // Test if there was a query error
    if (!$result) {
    	die("Database query failed.");
    }
?>
<table>
		<tr>
		<th>id</th>
		<th>forename</th>
		<th>surname</th>
		<th>job descript</th>
		</tr>
		  <tr>
		   <?php while($row = mysqli_fetch_assoc($result)){ ?>
		  <td><?php echo $sum = $row['emp_id'];?></td>
		  <td><?php echo $sum = $row['emp_forename'];?></td>
		  <td><?php echo $sum = $row['emp_surname'];?></td>
		  <td><?php echo $sum = $row['emp_job_descript'];?></td>

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