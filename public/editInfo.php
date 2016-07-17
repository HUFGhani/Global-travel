<?php
require_once("../include/functions.php");
include '../include/Header.php';
include '../include/connection.php';
//include 'Header.php';


if(!$signedIn){
  
     redirect_to("customerAccount.php");
 }
 else{
	$cust_id = $_POST['cust_id'];
			//prepared statement to prevent SQL injection
			// database query to select all customer information...For display...
			$stmt = $connection->prepare("SELECT * FROM customer WHERE cust_id = ? ");
			$stmt->bind_param("i", $cust_id);

			//execute prepared statement
			if($stmt->execute()){
				$result = $stmt->get_result();
				$stmt->close();

			//return data
			while($customer = mysqli_fetch_assoc($result)){
				$firstname = $customer["cust_forename"];
				$lastname = $customer["cust_surname"];
				$address = $customer["cust_address"];
				$postcode = $customer["cust_postcode"];
				$email = $customer["cust_email"];
				$tel = $customer["cust_tel"];
				$password = $customer["cust_password"];
				$town = $customer["cust_town"];
				$dob = $customer["cust_DOB"];
				$title = $customer["cust_title"];

			}

				echo "<h1>Welcome $name  </h1>";
				mysqli_free_result($result);

			}else{
				die("Database query failed.");
			}
		?>	

 <h1>Edit Account Information</h1>

 <div id="seperator">
 	<h2>Account Details</h2>
 </div>

	<div id="accountInfo">
		<form action="customerAccount.php" method="post">
		<table>
			<tr>
				<td>
					Title: 
				</td>
				<td>
					<?php 
					$miss = "";
				    $mrs = "";
				    $ms = ""; 
				    $mr = "";
					$dr = "";

					if($title == "Miss"){
						$miss = "selected";
					}else if($title == "Mrs"){
						$mrs = "selected";
					}else if($title == "Ms"){
						$ms = "selected";
					}else if($title == "Mr"){
						$mr ="selected";
					}else if($title == "Dr"){
						$dr ="selected";
					}
					

					 echo "<select name='title'>
						<option value='miss' $miss > Miss</option>
						<option value='mrs' $mrs >Mrs</option>
						<option value='ms' $ms >Ms</option>
						<option value='mr' $mr >Mr</option>
						<option value='dr' $dr >Dr</option>
					</select>";

					?>


				</td>
				</tr>
				<tr>
				<td>
					First Name: 
				</td>
				<td>

					<input type="text" name="firstname" value= "<?php echo $firstname ?>" class='cardBoxes' required />
				</td>
			</tr>
			<tr>
				<td>
					Surname: 
				</td>
				<td>
					<input type="text" name="surname" value="<?php echo $lastname ?>" class='cardBoxes' required />
				</td>
			</tr>
			<tr>				
				<td>
					Address: 
				</td>
				<td>
					<input type="text" name="address" value= "<?php echo $address ?>" class='cardBoxes' required />
				</td>
				</tr>
				<tr>
				<td>
					Town: 
				</td>
				<td>

					<input type="text" name="town" value= "<?php echo $town ?>" class='cardBoxes' required />
				</td>
			</tr>
			<tr>
				<td>
					Postcode: 
				</td>
				<td>
					<input type="text" name="postcode" value= "<?php echo $postcode ?>" class='cardBoxes' required/>
				</td>
			</tr>
			<tr>
				<td>
					Tel:	
				</td>
				<td>
					<input type="text" name="tel" value= "<?php echo $tel ?>" class='cardBoxes' required/>
				</td>
			</tr>
			</tr>
			<tr>
				<td>
					Email:	
				</td>
				<td>
					<input type="text" name="email" value= "<?php echo $email ?>" class='cardBoxes' required />
				</td>
			</tr>
			<tr>
				<td>
					DOB:	
				</td>
				<td>
					<input type="date" name="dob" value= "<?php echo $dob ?>" class='cardBoxes' required />
				</td>
			</tr>
		</table>
		<input type="submit" name="AccountChanges" class="Buttons" value="Save Changes"/>
		</form>
	</div>

 <div id="seperator">
 	<h2>Change Password</h2>

 </div>

	<div id="password">
	
		<?php
			if(isset($_POST['pwdChanged'])){
				if($_POST['origPwd'] == $password){
					if($_POST['newPwds'] == $_POST['repeatPwd']){
					$stmt = $connection->prepare("UPDATE customer SET 
						cust_password = ? 
						WHERE cust_id = ?");
					$stmt->bind_param("si", $_POST['newPwds'], $cust_id);
						//execute prepared statement
						if($stmt->execute()){
							$result = $stmt->get_result();
							$stmt->close();
							echo "<p>Your password has been changed.</p>";	
						}else{
							die("Database query failed.");
						}
					}else{
						echo "<p>Error: The passwords do not match.</p>";
					}
				}else{
					echo "<p>Error: Incorrect password. </p>";
				}
			}
		?>

		<form action="editInfo.php" method="post">
			<table>
				<tr>
					<td>
						Old password:
					</td>
					<td>
						<input type="password" name="origPwd" required class='cardBoxes'/>
					</td>
			 	</tr>
				<tr>
					<td>
						New password:
					</td>
					<td>
						<input type="password" name="newPwds" required class='cardBoxes'/>
					</td>
				</tr>
				<tr>
					<td>
						Re-enter passsword:
					</td>
					<td>
						<input type="password" name="repeatPwd" required class='cardBoxes'/>
					</td>
				</tr>
				</table>
			<input type="hidden" name="cust_id" value ="<?php echo $cust_id ?>" >
			<input type="submit" name="pwdChanged" class="Buttons" value="Save Changes"/>
		</form>

	</div>

 <div id="seperator">
 	 	<h2>Remove Account</h2>

 </div>

	 <form action="deleteAccount.php" method="post">
	 	<p>I confirm I would like to remove my account.
	 	<input type="checkbox" name="confirm" required /> 
	 	<input type="hidden" name="cust_id" value ="<?php echo $cust_id ?>" >
	 	<input type="submit" value ="Delete Account" class="Buttons" name="delete"/>
		</p>
	 </form>
 
</body>

</html>

<?php
mysqli_close($connection);
}
?>
