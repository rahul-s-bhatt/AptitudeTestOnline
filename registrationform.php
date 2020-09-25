 <?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="styles/registartion.css">
	<link rel="stylesheet" type="text/js" href="js/script.js">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
		<!-- Favicon -->
    <link rel="icon" href="favicon.png" type="image/png">
    <!-- JSON  -->
        <link rel="manifest" href="manifest.json">
</head>
<body>

		<div class="container">
			<div class="wrap">
				<form class="registration-form" name="register" method="post" action="registrationform.php">
					<span class="registration-form-title">REGISTRATION FORM </span> <br>
					<input type="text" name="username" value="username" class="wrap-input" required=""> 

					<input type="email" name="email" class="wrap-input" placeholder="Email">
					<input id="pwd" type="password" pattern=".{6,}" name="password" class="wrap-input" placeholder="Enter Password (6 or more)" value="password" required="">
					<input id="pwdConfirm" pattern=".{6,}" type="password" name="passwordConfirm" class="wrap-input" placeholder="Password Confirm"  required="">

					<button type="submit" value="submit" name="register_user" class="registration-form-button">Register</button>
				</form>

				<br>
				<?php include('errors.php') ?>
			    <a href="login.php">Already a User?</a>
			</div>
		</div>
	<script src="https://use.fontawesome.com/77b69c85b2.js"></script>
</body>
</html>

