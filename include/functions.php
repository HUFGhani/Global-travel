<?php
function redirect_to($new_location) {
	header("Location: " . $new_location);
	exit;
}
function mysql_prep($string) {
	global $connection;

	$escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
}
function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}
function find_staff_by_id($staff_id) {
	global $connection;
	
	$safe_admin_id = mysqli_real_escape_string($connection, $staff_id);
	
	$query  = "SELECT * ";
	$query .= "FROM employee ";
	$query .= "WHERE emp_id = {$safe_admin_id} ";
	$query .= "LIMIT 1";
	$admin_set = mysqli_query($connection, $query);
	confirm_query($admin_set);
	if($admin = mysqli_fetch_assoc($admin_set)) {
		return $admin;
	} else {
		return null;
	}
}
function find_all_staff() {
	global $connection;

	$query  = "SELECT * ";
    $query .= "FROM employee ";
    $query .= "ORDER BY emp_email ASC";
	$staff_set = mysqli_query($connection, $query);
	confirm_query($staff_set);
	return $staff_set;
}
function find_all_at() {
	global $connection;

	$query  = "SELECT * ";
	$query .= "FROM attractions ";
	$query .= "ORDER BY attract_id ASC";
	$staff_set = mysqli_query($connection, $query);
	confirm_query($staff_set);
	return $staff_set;
}
function find_att_by_id($att_id) {
	global $connection;

//	$safe_admin_id = mysqli_real_escape_string($connection, $att_id);

	$query  = "SELECT * ";
	$query .= "FROM attractions ";
	$query .= "WHERE attract_id = {$att_id} ";
	$admin_set = mysqli_query($connection, $query);
	confirm_query($admin_set);
	if($admin = mysqli_fetch_assoc($admin_set)) {
		return $admin;
	} else {
		return null;
	}
}
?>