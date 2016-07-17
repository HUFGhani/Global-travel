<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Global Tickets Ltd</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body id="cart">
    <?php include '../include/Header.php'; ?> 
  
 
<?php
 if(!$signedIn){
    echo "<h1>You are not signed in.</h1>
          <h2>Sign in here to purchase your items</h2>
          <form action='login.php' id='labelCenter'>
              <input type=\"submit\" value=\"Sign In\"  class=\"Buttons\"/>
              <input type='hidden' name='return' value='$page'>
          </form>";
     
 }
elseif(count($_SESSION['items'])==0){
    header("Location: shoppingCart.php");

}
else{
?>
   <div class="checkoutContainer">
		
<!-- 		create a field set that contains all the items being ordered in a table -->
		<fieldset class="detailsFieldset">
			<legend class="checkoutLegend">Item Details</legend>
 <?php       
    if(!isset($_SESSION['items'])){
        $_SESSION['items'] = array();
    }

   if(count($_SESSION['items'])>0){
       ?>
    
        <table class="checkoutTable">
        <tr>
		  <th width="10%">Description</th>
          <th colspan=2 width="30%">Price</th>
		  <th colspan=2 width="30%" >Quantity</th>
		  <th colspan=2 width="30%">Amount</th>
        </tr>
             
  <?php 
        
    $completeTotal = 0;
    $ticketsTotal = 0;
    $adultTotal = 0;
    $childTotal = 0;
    $studentTotal = 0;
    $seniorTotal = 0;
    for($i = 0; $i < count($_SESSION['items']); $i++){
  ?>
   
        <tr>
            <td width="10%"><?php echo $_SESSION['items'][$i]['attract_name'] ?><br /><?php echo $_SESSION['items'][$i]['city_name'] ?>, <?php echo $_SESSION['items'][$i]['country_name'] ?> </td>
            <td width="10%" class="checkoutValues">Adult Ticket : <br/>Child Ticket : <br/>Student Ticket : <br/>Senior Ticket : <br/></td>
            <td width="7%" class="checkoutValues">£<?php echo $_SESSION['items'][$i]['adultPrice'] ?><br/>£<?php echo $_SESSION['items'][$i]['childPrice'] ?><br/>£<?php echo $_SESSION['items'][$i]['studentPrice'] ?><br/>£<?php echo $_SESSION['items'][$i]['seniorPrice'] ?><br/></td>
            <td width="11%" class="checkoutValues">
                <label>Adult Ticket(s) :</label><br/>
                <label>Child Ticket(s) :</label><br/>
                <label>Student Ticket(s) :</label><br/>
                <label>Senior Ticket(s) :</label><br/>
            </td>
            <td width="5%" class="checkoutValues">
                <label><?php echo $_SESSION['items'][$i]['adultq'] ?></label><br/>
                <label><?php echo $_SESSION['items'][$i]['childq'] ?></label><br/>
                <label><?php echo $_SESSION['items'][$i]['studentq'] ?></label><br/>
                <label><?php echo $_SESSION['items'][$i]['seniorq'] ?></label><br/>
            </td>


            <td width="10%" class="checkoutValues">Adult Total : <br/>Child Total : <br/>Student Total : <br/>Senior Total : <br/></td>
            <td width="7%" class="checkoutValues">£<?php echo $_SESSION['items'][$i]['adultPrice'] * $_SESSION['items'][$i]['adultq'] ?><br/>£<?php echo $_SESSION['items'][$i]['childPrice'] * $_SESSION['items'][$i]['childq'] ?><br/>£<?php echo $_SESSION['items'][$i]['studentPrice'] * $_SESSION['items'][$i]['studentq'] ?><br/>£<?php echo $_SESSION['items'][$i]['seniorPrice'] * $_SESSION['items'][$i]['seniorq'] ?><br/></td>

        </tr>
       
<?php  
       $completeTotal += $_SESSION['items'][$i]['total'];
        $tickets = $_SESSION['items'][$i]['adultq'] + $_SESSION['items'][$i]['childq'] + $_SESSION['items'][$i]['studentq'] + $_SESSION['items'][$i]['seniorq'];
        $ticketsTotal += $tickets;
        $adultTotal += $_SESSION['items'][$i]['adultq'];
        $childTotal +=  $_SESSION['items'][$i]['childq'];
        $studentTotal += $_SESSION['items'][$i]['studentq'];
        $seniorTotal += $_SESSION['items'][$i]['seniorq'];
    }

  ?>
        <tfoot class="foot">
          <tr>
<!--
            <td></td><td></td><td></td><td></td><td></td><td></td>
            <td class="total">Total : </td>
            <td>£<?php echo $completeTotal?></td>
-->
          </tr>
    </table>
<?php
?>
		</fieldset>
	</div>	
    <div class="buyContainer">	
		<fieldset class="buyFieldset">
			<legend class="checkoutLegend">Buy Now</legend>
			<h3>Order Summary</h3>
			<table class="buyTable">
                <tr>
					<th>Number Of Adult Tickets: </th>
					<td><?php echo $adultTotal?></td>
				</tr>
                <tr>
					<th>Number Of Child Tickets: </th>
					<td><?php echo $childTotal?></td>
				</tr>
                <tr>
					<th>Number Of Student Tickets: </th>
					<td><?php echo $studentTotal?></td>
				</tr>
                <tr>
					<th>Number Of Senior Tickets: </th>
					<td><?php echo $seniorTotal?></td>
				</tr>
                <tr>
					<th>Total Number Of Tickets: </th>
					<td><?php echo $ticketsTotal?></td>
				</tr>

				<tfoot class="buyfoot">
					<tr>
	      				<th>Order Total :</th>
	    			    <td><b>£<?php echo money_format('%.2n', $completeTotal); ?></b></td>
	  			    </tr>
				</tfoot>
			</table>
			
<!-- 			add a button that passes the price, delivery price and the delivery type to the CompleteOrder servlet -->
			<form action="cardDetails.php">
				<input type="submit" value="Buy Now" class="buynowButton">
				<input type="hidden" name="price" value="<?php echo $completeTotal ?>"> 

			</form>
			
		</fieldset>
	</div>        
<?php
   }
}
?>