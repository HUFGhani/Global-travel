<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Global Tickets Ltd</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body id="cart">
    <?php include '../include/Header.php'; ?> 
        
    		<!-- 		create title of Registration -->
		<h2 class="signUpHeading">Enter Card Details</h2>
			
		<div class="cardDetailsContainer">
			<form action="completePayment.php" method="post">	
				<table class="cardDetailsTable">
					<tr>
						<th>Card Type: </th>
						<td>
                            <select name="cardType">
                              <option value="Maestro">Maestro</option>
                              <option value="Delta">Delta</option>
                              <option value="Visa Electron">Visa Electron</option>
                              <option value="MaterCard">MaterCard</option>
                              <option value="Solo">Solo</option>
                              <option value="Visa">Visa</option>
                            </select>
                        </td>
					</tr>
					<tr>
						<th>Card Number: </th>
						<td><input type="text" name="cardNumber" class="cardBoxes" required></td>
					</tr>
					<tr>
						<th>Card Holder: </th>
						<td><input type="text" name="cardHolder" class="cardBoxes" required></td>
					</tr>
					<tr>
						<th>Expiry Date: </th>
						<td><input type="date" name="expiryDate" class="cardBoxes" required></td>
					</tr>
                    <tr>
						<th>Issue Number: </th>
						<td><input type="text" name="issueNumber" class="cardBoxes" placeholder="Optional"></td>
					</tr>
					<tr>
						<th>Security Code: </th>
						<td><input type="text" name="securityCode" class="cardBoxes" required></td>
					</tr>

				</table>
				
				<div class="buttonContainer">
					<input type="submit" value="Complete Payment" class="Buttons">
				</div>
			</form>
		</div>
        
        
    </body>
</html>