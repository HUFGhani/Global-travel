<?php
session_start();
$signedIn = false;
$page = basename($_SERVER['PHP_SELF']);
if(isset($_SESSION['emp_id'])){
    $signedIn = true;
    $name = $_SESSION['emp_forename'];
}
?>
<!doctype html>
<html>
	<head>  
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="../js/script.js"></script>
		<title>Global Tickets Ltd</title>
		<link rel="stylesheet" href="../css/style.css">
	</head>
	<!-- Create heading containing logo and name of company -->
   		<header>
			<img id="logo" src="../images/Logo.png" alt="Logo" style="width:128px;height:128px">
       		<img id="Title" src="../images/title2.png" alt="Logo" style="width:400;height:50px">
            <?php
                if($signedIn){
                    echo "<form action='logout.php' id='topRight'>
                            <label id='username'>Welcome back $name </label><br>
		       			    <input type='submit' id='logout' value='Logout'>
                            <input type='hidden' name='return' value='$page'>
		       			  </form>";
                   
                }
                else{
                    header("Location: index.php"); 

                }
            ?>   
			<ul id="menu">
               <li><a href="admin.php"id="home">Admin Home</a></li>
		       <li><a href="manage_staff.php" id="manageStaff">Manage Staff</a></li>
		       <li><a href="Manage_attraction.php" id="manageAttract">Manage Attractions</a></li>
		       <li><a href="generate_report.php" id="genReports">Reports</a></li>
		      
            </ul>
            </header>