<?php


// Start the session
session_start();


include 'connect.php';

	$newusername = $_POST['uname'];
	$newpassword = $_POST['psw'];

	$newusername = stripslashes($newusername);
	$newpassword = stripslashes($newpassword);

	$_SESSION["names1"] = $newusername;

	$query = "SELECT * FROM users WHERE Username='$newusername' and Password='$newpassword'";
	$result = mysqli_query($link, $query);

	$count= mysqli_num_rows($result);

	If($count ==1){
		$seconds = 1800 + time();
		setcookie(loggedin, date("h i - d: e"), $seconds);
		//echo "successful";

		header("location:pharmacyclient.php");

	}
	else{
		 echo "<script>
            alert('Incorrect login details');
            window.location.href='login.html';
            </script>";

	}mysqli_close($link);

?>
