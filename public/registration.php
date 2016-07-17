<!doctype html>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Global Tickets Ltd</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body class="loginBody">
<!-- Create heading containing logo and name of company -->
   <header>
		<img id="logo" src="../images/Logo.png" alt="Logo" style="width:128px;height:128px">
       	<img id="Title" src="../images/title2.png" alt="Logo" style="width:400;height:50px">
   </header>
<?php 	
echo '<div class="registrationContainer">
<!-- 			create a form which has textboxes stored in a table. the textbox text is gotten from the textvalues array  -->
			<form action="checkreg.php" method="post">	
				<table class="registrationTable">
					<tr>
						<th>Title: </th>
						<td><select  name="cust_title"> 
  							<option value="mr">Mr</option>
 							 <option value="mrs">Mrs</option>
 							 <option value="miss">Miss</option>
							  <option value="ms">Ms</option>
                                <option value="dr">Dr</option>
							</select>
						</td>
					</tr>
                    <tr>
						<th>Forename: </th>
						<td><input type="text" name="cust_forename" class="registrationBoxes" required></td>
					</tr>
					<tr>
						<th>Surname: </th>
						<td><input type="text" name="cust_surname" class="registrationBoxes" required></td>
					</tr>
					<tr>
						<th>Email: </th>
						<td><input type="text" name="cust_email" class="registrationBoxes" required></td>
					</tr>
					<tr>
						<th>Password: </th>
						<td><input type="password" name="cust_password" class="registrationBoxes" required></td>
					</tr>
					</table>
					<table class="registrationTable">
					<tr>
						<th>Date of Birth: </th>
						<td><input type="date" name="cust_DOB" class="registrationBoxes" required></td>
					</tr>
					<tr>
						<th>Address Line: </th>
						<td><input type="text" name="cust_address"  class="registrationBoxes" required></td>
					</tr>
					<tr>
						<th>Town: </th>
						<td><input type="text" name="cust_town" class="registrationBoxes" required></td>
						
					</tr>
					<tr>
						<th>Postcode: </th>
						<td><input type="text" name="cust_postcode" class="registrationBoxes" required></td>
					</tr>
						<th>Telephone Number: </th>
						<td><input type="text" name="cust_tel" class="registrationBoxes" required></td>
					</tr>
					<tr>
                    </table>
				
				<div class="buttonContainer">
					<input type="submit" value="Lets go..." class="Buttons">
					<input type="button" value="Cancel" onclick="window.location="login.php" class="Buttons">
				</div>
			</form>
		</div>
</div> '
?>