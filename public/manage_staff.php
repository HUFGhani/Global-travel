<?php require_once("../include/Connection.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php
  $admin_set = find_all_staff();
?>
<?php include '../include/AdminHeader.php';?>

<body id="manageStaff">
    
    <h2>Manage staff</h2>
	<table class="bookings">
		<tr>
			<th style="text-align: left; width: 200px;">Username/ Email address</th>
			<th>Forename</th>
			<th>Surname</th>
			<th>Address</th>
			<th>Town</th>
			<th>Postcode</th>
			<th>Phone</th>
			<th>Salary</th>
			<th>Job Description</th>
			<th>Hire Date</th>
			<th colspan="2" style="text-align: left;">Actions</th>
		</tr>
    <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
         <tr>
			<td><?php echo htmlentities($admin["emp_email"]);?></td>
			<td><?php echo htmlentities($admin["emp_forename"]); ?></td>
			<td><?php echo htmlentities($admin["emp_surname"]); ?></td>
			<td><?php echo htmlentities($admin["emp_address"]); ?></td>
			<td><?php echo htmlentities($admin["emp_town"]); ?></td>
			<td><?php echo htmlentities($admin["emp_postcode"]); ?></td>
			<td><?php echo htmlentities($admin["emp_tel"]); ?></td>
			<td><?php echo htmlentities($admin["emp_salary"]); ?></td>
			<td><?php echo htmlentities($admin["emp_job_descript"]); ?></td>
			<td><?php echo htmlentities($admin["emp_hire_date"]); ?></td>
			 <td><a href="edit_staff.php?emp_id=<?php echo urlencode($admin["emp_id"]); ?>">Edit</a></td>
        <td><a href="delete_staff.php?emp_id=<?php echo urlencode($admin["emp_id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
		</tr>
		<?php } ?>
	</table>
	<br />
	<a href="new_staff.php">Add new admin</a>

</body>
    <?php
mysqli_close($connection);
?>
</html>