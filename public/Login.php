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
   
<!--    create container to hold the textboxes and buttons so it can be centered in the page -->
    <div class="loginForm">

	   <?php
	    $return = isset($_GET['return']) ? $_GET['return'] : "index.php";
		$message = "";
	    $Colour = "#2c3338";    
	    $signedUp = isset($_GET['signupComplete']) ? $_GET['signupComplete'] : '';
	    $login = isset($_GET['login']) ? $_GET['login'] : '';
	    //if the sign up has just been complete then set the message to sign up complete. set the colour of the message to white
		if($signedUp == "yes"){
			$message = "Sign Up Complete";
			$Colour = "#fff";
		}
	    //if the user has tried to login with the wrong details then set the message to username or password incorrect. 
	    //set the colour of the message to white
		else if($login == "false"){
			$message = "Username or Password Incorrect";
			$Colour = "#fff";
		}
		echo '<label class="error" style="color: '.$Colour.'">' .$message. '</label>'

		?>

<!-- 		create the textboxes for username and password, the button to signin, the message and the signup now text -->
        <form action="checklogin.php" method="post">
          <img alt="User" src="../images/user.png" style="width:16px; height:16px" class="icons"><input type="text" name="Email" placeholder="Email Address" class="boxes" required><br>
          <img alt="Lock" src="../images/lock.png" style="width:16px; height:16px" class="icons"><input type="password" name="Password" placeholder="Password" class="boxes" required><br>
         <input type='hidden' name='return' value='<?php echo $return  ?>'>
            <input type="submit" value="Sign In" class="signin">
        </form> 
        Not a member? <a href="registration.php" class="signup">Sign up now</a> 
    </div>   
</body>
</html>