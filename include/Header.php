<?php
session_start();
$signedIn = false;
$page = basename($_SERVER['PHP_SELF']);
if(isset($_SESSION['cust_id'])){
    $signedIn = true;
    $name = $_SESSION['cust_forename'];
}
?>
<!doctype html>
<html>
	<head>  
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
-->

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
                    echo "<form action='Login.php' id='topRight'>
                            <input type='submit' id='logout' value='Sign In'>
                            <input type='hidden' name='return' value='$page'>
                         </form>";
                }
            ?>   
			<ul id="menu">
		       <li><a href="index.php" id="home">Home</a></li>
		       <li><a href="aboutUs.php" id="AboutUs">About Us</a></li>
		       <li><a href="customerAccount.php" id="YourAccount">Your Account</a></li>
		       <li><a href="shoppingCart.php"id="cart">Shopping Cart</a></li>
            </ul>
		
 </header>


 
