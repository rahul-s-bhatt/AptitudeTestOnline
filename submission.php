<?php 

	include 'server.php';

	$numCorrect = $_POST['nC'];
	$outOf = $_POST['outOf'];
	$wrong = $_POST['wrong'];
	$testName = $_POST['testName'];

	if (isset($_POST['nC'])) { 

			if(isset($_POST['username'])){
		    	$username = $_POST['username'];
			}

			if(isset($_POST['password'])){
			    $password = $_POST['password'];
			}
			

			$username = mysqli_real_escape_string($conn, $username);
			$password = mysqli_real_escape_string($conn, $password);

			$userIdRetrieve = "SELECT loginID FROM logintable WHERE loginUsername = '".$_SESSION['username']."'";
			$userIdQuery = mysqli_query($conn, $userIdRetrieve);

			$fetchID = mysqli_fetch_assoc($userIdQuery);

			$_SESSION['fetchID'] = $fetchID['loginID'];
			$loginID = $fetchID['loginID'];

			$socreID = "SELECT * FROM scoreboard WHERE loginID = '$loginID' AND testName = '$testName'";
			$socreIDQuery = mysqli_query($conn, $socreID);
			$scoreID = mysqli_fetch_assoc($socreIDQuery);

			if(mysqli_num_rows($socreIDQuery) >= 0){
				
				if($scoreID['correct'] < $numCorrect){
					$sqlForUpdating = "UPDATE scoreboard SET correct='$numCorrect', wrong = '$wrong' WHERE loginID='$loginID' AND testName = '$testName'";

					$resultUpdate = mysqli_query($conn, $sqlForUpdating);
				} 

			}if(mysqli_num_rows($socreIDQuery) == 0){
				$insertSQL = "INSERT INTO scoreboard(correct, outOf, wrong, loginID, testName) VALUES ('$numCorrect', '$outOf', '$wrong', '$loginID', '$testName')";

				$resultInsert = mysqli_query($conn, $insertSQL);

			}

		}

?>