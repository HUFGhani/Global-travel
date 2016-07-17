<?php require_once("../include/Connection.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php include '../include/AdminHeader.php';?>
<?php
  $admin_set = find_all_at();
?>

<body id="manageAttract">
<h2>Manage attraction</h2>
<div class=overflow>
	<table class="bookings">
		<tr>
			<th>Name</th>
			<th>Website</th>
			<th>Phone</th>
			<th>Description</th>
			<th>Extra Info</th>
			<th>Adult Price</th>
			<th>Child Price</th>
			<th>Senior Price</th>
			<th colspan="2" >Actions</th>
		</tr>
    <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
         <tr>
			<td><?php echo htmlentities($admin["attract_name"]); ?></td>
			<td><?php echo htmlentities($admin["attract_website"]); ?></td>
			<td><?php echo htmlentities($admin["attract_phone"]); ?></td>
			<td><?php echo htmlentities($admin["description"]); ?></td>
			<td><?php echo htmlentities($admin["attract_extra_info"]); ?></td>
			<td><?php echo htmlentities($admin["attract_adult_price"]); ?></td>
			<td><?php echo htmlentities($admin["attract_child_price"]); ?></td>
			<td><?php echo htmlentities($admin["attract_senior_price"]); ?></td>
			 <td><a href="edit_att.php?attract_id=<?php echo urlencode($admin["attract_id"]); ?>">Edit</a></td>
        <td><a href="delete_att.php?attract_id=<?php echo urlencode($admin["attract_id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
		</tr>
		<?php } ?>
	</table>
    </div>
	<br />
	<a href="new_att.php">Add new attracrion</a>
</body>
 
</html>