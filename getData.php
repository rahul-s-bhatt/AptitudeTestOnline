<?php 
	include 'server.php';

    $sql = "SELECT * FROM chat";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            
            $sqll = "SELECT loginUsername FROM logintable WHERE loginID = '".$row['loginID']."'";
            
            $resultForLoginUsername = mysqli_query($conn, $sqll);
            $fetchUsername = mysqli_fetch_assoc($resultForLoginUsername);

            echo ucfirst($fetchUsername['loginUsername']). ": " .$row['chatText'].  "<br>";
        }
    }
?>