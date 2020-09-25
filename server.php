<?php

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    $dbServerName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";

    $dbName = "chatsystem";

    // $dbServerName = "localhost";
    // $dbUsername = "id12962789_rahul";
    // $dbPassword = "123456";

    // $dbName = "id12962789_aptitudetestonline";

    $username = "";
    $email = "";
    $password = "";
    $passwordConfirm = "";

    $errors = array();

    $_SESSION['logged_in'] = false;

	
    // Create connection
    $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

	

    // Register User
	if(isset($_POST['register_user'])){

		if(isset($_POST['username'])){
		    $username = $_POST['username'];
		}

		if(isset($_POST['email'])){
		    $email = $_POST['email'];
		}
		if(isset($_POST['password'])){
		    $password = $_POST['password'];
		}
		if(isset($_POST['passwordConfirm'])){
		    $passwordConfirm = $_POST['passwordConfirm'];
		}



	    // check db for existing user with same username

	    $user_check_query = "SELECT loginUsername FROM loginTable WHERE loginUsername = '$username' LIMIT 1";
		
		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if($user){
			if (isset($user['username']) === $username) {
				array_push($errors, "This Username is taken!");
			}
			if (isset($user['email']) === $email) {
				array_push($errors, "This email ID is taken!");
			}
		}


		$username = mysqli_real_escape_string($conn, $username);
	    $password = mysqli_real_escape_string($conn, $password);
	    $passwordConfirm = mysqli_real_escape_string($conn, $passwordConfirm );

		if($password === $passwordConfirm){

			$password = md5($password);
			$query = "INSERT INTO loginTable(loginUsername, loginPassword) VALUES ('$username','$password')";
			$result = mysqli_query($conn, $query);
			$_SESSION['username'] = $username;
			$_SESSION['logged_in'] = $username;

			echo '<script type="text/javascript">'; 
			echo 'alert("User Has Registered Successfully!");'; 
			echo 'window.location.href = "index.php";';
			echo '</script>';
}

}

	// Login USer

	if (isset($_POST['login_user'])) {

		if(isset($_POST['username'])){
	    	$username = $_POST['username'];
		}

		if(isset($_POST['password'])){
		    $password = $_POST['password'];
		}

		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);
		
		$password = md5($password);

		$query = "SELECT loginUsername FROM loginTable WHERE loginUsername = '$username' AND loginPassword='$password'";
		$results = mysqli_query($conn, $query);

		if (mysqli_num_rows($results) == 1) {
			$row = mysqli_num_rows($results);
 			// if ($results){
			$_SESSION['logged_in'] =  $username;
			$_SESSION['username'] = $username;
			
			echo '<script type="text/javascript">'; 
			echo 'alert("User Has Successfully Logged In!");'; 
			echo 'window.location.href = "index.php";';
			echo '</script>';

		}else{
			array_push($errors, "Wrong Username/password eneterd!");
		}

		}

		
		// // Chat here!
		// if (isset($_POST['submitText'])) { 

		// 	if(isset($_POST['username'])){
		//     	$username = $_POST['username'];
		// 	}

		// 	if(isset($_POST['password'])){
		// 	    $password = $_POST['password'];
		// 	}
			

		// 	$username = mysqli_real_escape_string($conn, $username);
		// 	$password = mysqli_real_escape_string($conn, $password);
		// 	$chatText = $_POST['chatText'];
			

		// 	$userIdRetrieve = "SELECT loginID FROM logintable WHERE loginUsername = '".$_SESSION['username']."'";
		// 	$userIdQuery = mysqli_query($conn, $userIdRetrieve);

		// 	$fetchID = mysqli_fetch_assoc($userIdQuery);

		// 	// echo $fetchID['loginID'];

		// 	$_SESSION['fetchID'] = $fetchID['loginID'];

		// 	$insertSQL = "INSERT INTO chat(chatText, loginID) VALUES ('".$_POST['chatText']."', '".$fetchID['loginID']."')";

		// 	$resultInsert = mysqli_query($conn, $insertSQL);

		// }


?>	
