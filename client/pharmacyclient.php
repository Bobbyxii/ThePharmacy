<?php

session_start();
	//if(!isset($_COOKIE['loggedin'])){
	//header("location:index.html");

include 'connect.php';
// Start the session
//session_start();
$newusername2 = $_SESSION["names1"];
$newusername2 = stripslashes($newusername2);

$querysess = "SELECT ProductList FROM sessions";
$resultsess = mysqli_query($link, $querysess);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../favicon.ico">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>

	<title>ThePharmacy.</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!-- Custom styles for this template -->
	<link href="../css/client-styles.css" rel="stylesheet">

	<!--including awesome fonts with CDN-->
	<script src="https://kit.fontawesome.com/ea32cb0f24.js" crossorigin="anonymous"></script>


</head>
<body>

<br>
<h6 style= "color:darkblue; padding-left: 15px; text-transform: uppercase;"><?php echo 'WELCOME '. $newusername2;?></h6>

<form method="post" action= "login.html" class= "logout-form">
	<button type="submit" class= "btn_remove">Logout</button>
</form>
<div class="tab">
	<button class="tablinks" onclick="openCity(event, 'Task Records')" id="defaultOpen">STOCK UPDATE</button>
  <button class="tablinks" onclick="openCity(event, 'Manage Records')">NEW PRODUCTS</button>
  <button class="tablinks" onclick="openCity(event, 'Create/Update Users')">VIEW RECORDS</button>
</div>


<div id="Task Records" class="tabcontent" >

		<div class="row">
			<div class="col-lg-3 col-md-12 col-sm-12 col-12">
				<form class="form-group" >
					<title>STOCK INFORMATION</title>
						<label>Product Name<i style= "color: red">(LRW DATE)</i></label>
						<?php
						echo "<select name= 'sessdate' id='sessdate'class='form-control'>";
						while ($row = mysqli_fetch_array($resultsess)){
						    echo "<option value'".$row['ProductList']."'>".$row['ProductList']."</option>";
						}
						echo "</select>";
						?>
						<label>client ID</label>
							<input type="text" class="form-control" name="invigname" id="invigname"  value =<?php echo $newusername2;?> required readonly><br>
						<label>Product Price</label>
							<input type="text" class="form-control" name="pay" id="pay" value ="" ><br>
						<button type="button" id="updateButton" class="btn btn-primary form-control" onclick="productUpdate();">Add</button>
				</form>

			</div>
			<div class="col-lg-3 col-md-12 col-sm-12 col-12">
				<form name ="add_name" id = "add_name" class="table-form" action="inv_task.php"  method= "post" >

					<strong><h3>PREVIEW RECORDS</h3></strong>

		   <table id="productTable" class="table table-bordered table-condensed table-striped table-responsive-lg">
					<label style = "float: left;" >No. Of Enteries: </label>
					<input type="text" style = "float: left; margin: 0px 0px 8px 5px; width: 60px;" name="len" id="len" required value ="" readonly>

		        <thead>
		          <tr>
								<th>Edit</th>
								<th>Product</th>
		            <th>ID</th>
		            <th>Price</th>
								<th>Delete</th>
		          </tr>
		        </thead>
		    </table><br>
				<p style= "color: red"><i>Please carefully examine all entered details before submitting!!!</i></p>
				<button class="btn btn-primary" style = "background-color: #008000;" name = "submit" id = "submit">SUBMIT</button><br><br>
			</form>

			</div>

		</div>
	  </div>

<div id="Manage Records" class="tabcontent" >

  <?php

	include 'connect.php';

	$newusername2 = $_SESSION["names1"];

	$newusername2 = stripslashes($newusername2);

	mysqli_close($link);
	?>
	<br><br>
	<form action="taskdetails.php" method="post">

		<label for="testdate" style ="width: 100%; display: inline-block;"><b>ENTER PRODUCT DETAILS</b></label><i style= "color:blue; font-size:12px;">(Please enter accurately)</i><br>
		<input type="text" placeholder="Product name" name="tdate" required>
		<input type="text" style= "width:15%" placeholder="Price" name="inv_num" >

		<button type="submit" class= "btn-success">ADD</button>
	</form>


</div>

<div id="Create/Update Users" class="tabcontent">

  <form name="new_user" id= "new_user" action= ""; method= "post";>
    <h3>REGISTER NEW USER</h3>
    <label>Username </label><br>
    <input type="text" name= "user_name" id="user_name" placeholder=" Enter staff No." required value=""><br>
		<label>Full Name </label><br>
    <input type="name" name= "inv_name" id="inv_name" placeholder="Enter Full Name" required value=""><br>
    <label>Password: </label><br>
    <input type="password" name= "user_password" id="user_password" placeholder="Enter Password" required value=""><br>
    <label>Confirm Password: </label><br>
    <input type="password" name= "user_cpassword" id="user_cpassword" placeholder="Confirm Password" required value=""><br><br>
    <button class="btn btn-primary" style = "background-color: #008000;" name = "submit" id = "submit">SUBMIT</button>
  </form>

<hr class="new5">

    <form name="new_user" id= "new_user" action= ""; method= "post";>
    <h3>PREVIEW SALES RECORDS</h3>
    <label>PRODUCT </label><br>
    <input type="date" name= "new_date" id="new_date" placeholder="" required value=""><br><br>
    <button class="btn btn-primary" style = "background-color: #008000;" name = "create" id = "create">CREATE</button>
  </form>

</div>

   <?php

   if (isset($_POST['submit'])){

	include 'connect.php';

		$uname = $_POST["user_name"];
		$uname = stripslashes($uname);
		$iname = $_POST['inv_name'];
		$iname = stripslashes($iname);
		$ipass = $_POST['user_password'];
		$ipass = stripslashes($ipass);
		$cpass = $_POST['user_cpassword'];
		$cpass = stripslashes($cpass);

	if ($ipass != $cpass){
		$message = "REGISTRATION FAILED!!! Please enter matching password";
			echo "<script type='text/javascript'> alert('$message');</script>";
	} else {


	$query = "SELECT * FROM users WHERE Username='$uname'";
	$result = mysqli_query($link, $query);
	$count= mysqli_num_rows($result);
	If($count ==0){

			/*$uname = mysqli_real_escape_string($link, $_POST["user_name"]);
			$iname = mysqli_real_escape_string($link, $_POST["inv_name"]);
			$ipass = mysqli_real_escape_string($link, $_POST["user_password"]);*/

			$sqladd = "INSERT INTO users(Username, Password, invig_name) VALUES ('$uname', '$ipass', '$iname')";
			mysqli_query($link, $sqladd);

			$message = "New User Created";
			echo "<script type='text/javascript'>alert('$message');</script>";
			} else {
				$sqlUP = "UPDATE users SET Username='$uname',Password='$ipass',invig_name='$iname' WHERE Username='$uname'";
					mysqli_query($link, $sqlUP);

					$message = "Updated Successfully!!!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			}
	}
   }

   if(isset($_POST['create'])){
       include 'connect.php';

		$ndate = $_POST["new_date"];
		$ndate = stripslashes($ndate);

		$querydate = "SELECT * FROM sessions WHERE TestDate='$ndate'";
	    $resultdate = mysqli_query($link, $querydate);
	    $count= mysqli_num_rows($resultdate);
	    If($count ==0){

			$sqladddate = "INSERT INTO sessions(TestDate) VALUES ('$ndate')";
			mysqli_query($link, $sqladddate);

			$message = "New Date Created";
			echo "<script type='text/javascript'>alert('$message');</script>";
			} else {
				$sqlUPdate = "UPDATE users SET TestDate='$ndate'";
					mysqli_query($link, $sqlUPdate);

					$message = "Updated Successfully!!!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			}

   }
?>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" src="client.js"></script>

<script>

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


</script>

</body>
</html>
