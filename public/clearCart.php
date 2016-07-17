<?php
//clear shopping cart
session_start();
    
if(isset($_SESSION['items'])){
    unset($_SESSION['items']);
}
header("Location: shoppingCart.php"); 
?>