<?php include '../include/Header.php'; ?> 
	

<body id="cart">
    
           
 <?php       
    if(!isset($_SESSION['items'])){
        $_SESSION['items'] = array();
    }

   if(count($_SESSION['items'])>0){
       ?>
    
        <table class="cartTable">
        <caption>Your Shopping Cart</caption>
        <tr>
		  <th width="20%">Description</th>
          <th colspan=2 width="20%">Price</th>
		  <th colspan=3 width="40%" >Quantity</th>
		  <th colspan=2 width="20%">Amount</th>
        </tr>
             
  <?php 
        
    $completeTotal = 0;
    for($i = 0; $i < count($_SESSION['items']); $i++){
  ?>
   
        <tr>
            <td width="10%"><?php echo $_SESSION['items'][$i]['attract_name'] ?><br /><?php echo $_SESSION['items'][$i]['city_name'] ?>, <?php echo $_SESSION['items'][$i]['country_name'] ?> </td>
            <td width="10%">Adult Ticket : <br/>Child Ticket : <br/>Student Ticket : <br/>Senior Ticket : <br/></td>
            <td>£<?php echo $_SESSION['items'][$i]['adultPrice'] ?><br/>£<?php echo $_SESSION['items'][$i]['childPrice'] ?><br/>£<?php echo $_SESSION['items'][$i]['studentPrice'] ?><br/>£<?php echo $_SESSION['items'][$i]['seniorPrice'] ?><br/></td>
            <td width="11%">
                <label>Adult Ticket(s) :</label><br/>
                <label>Child Ticket(s) :</label><br/>
                <label>Student Ticket(s) :</label><br/>
                <label>Senior Ticket(s) :</label><br/>
            </td>
           <form action=updateCart.php> 
            <td width="3%">
                <input type="text" name="adultQuantity" class="txtQuantity" Value=<?php echo $_SESSION['items'][$i]['adultq'] ?>><br/>
                <input type="text" name="childQuantity" class="txtQuantity" Value=<?php echo $_SESSION['items'][$i]['childq'] ?>><br/>
                <input type="text" name="studentQuantity" class="txtQuantity" Value=<?php echo $_SESSION['items'][$i]['studentq'] ?>><br/>
                <input type="text" name="seniorQuantity" class="txtQuantity" Value=<?php echo $_SESSION['items'][$i]['seniorq'] ?>><br/>
            </td>

            <td width="5%">
			  <input type="submit" name="links" value="Update" class="cartLinks"/><br/> <input type="submit" name="links" value="Delete" class="cartLinks"/> <input type="hidden" name="id" value=<?php echo $i ?> /></form>
            </td>
            
            <td width="10%">Adult Total : <br/>Child Total : <br/>Student Total : <br/>Senior Total : <br/></td>
            <td width="10%">£<?php echo $_SESSION['items'][$i]['adultPrice'] * $_SESSION['items'][$i]['adultq'] ?><br/>£<?php echo $_SESSION['items'][$i]['childPrice'] * $_SESSION['items'][$i]['childq'] ?><br/>£<?php echo $_SESSION['items'][$i]['studentPrice'] * $_SESSION['items'][$i]['studentq'] ?><br/>£<?php echo $_SESSION['items'][$i]['seniorPrice'] * $_SESSION['items'][$i]['seniorq'] ?><br/></td>

        </tr>
       
<?php  
       $completeTotal += $_SESSION['items'][$i]['total'];
    }

  ?>
        <tfoot>
          <tr>
            <td></td><td></td><td></td><td></td><td></td><td></td>
            <td class="total">Total : </td>
            <td>£<?php echo money_format('%.2n', $completeTotal)?></td>
          </tr>
          <tr>
            <td colspan="7">
                <form action="clearCart.php" class="cartButtons">
                    <input type="submit" name="clear" value="Clear Shopping Cart"  class="Buttons"/>
			    </form>
            </td>
            <td>
                <form action="checkout.php" cart="cartButtons">
			    	<input type="submit" value="Checkout"  class="Buttons"/>
			    </form>
            </td>
        </tr>
    </table>

<?php
   }
elseif(isset($_GET['order']) ? $_GET['order'] : '' == "completed"){
    echo "<h1>Your Purchase Has Been Completed</h1>";
    echo "<form action='index.php' id='labelCenter'>";
    echo    "<input type=\"submit\" value=\"Continue Shopping\"  class=\"Buttons\"/>";
	echo "</form>";
}
else{
    echo "<h1>Your Basket Is Empty</h1>";
    echo "<form action='index.php' id='labelCenter'>";
    echo    "<input type=\"submit\" value=\"Continue Shopping\"  class=\"Buttons\"/>";
	echo "</form>";
    
}
?>
        
   	</body>
</html>