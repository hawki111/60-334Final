
<html>
<link rel="stylesheet" href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/css/layout.css" type="text/css">
<head>
<title>A Hotel</title>

<table id="banner" width="100%">
<tr id="banner"><td><a href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/index.html"><img src="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/logo.png" height="150" width="400" ></a></td></tr>
<tr id="banner"><td>
<ul id="navlist">
<li><a href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/custAccount.php">Create Account</a></li>
<li><a href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/staffLogin.php">Staff Login</a></li>
<li><a href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/custManage.php">View Your Bookings</a></li>
<li><form action="dateSelect.php" method="POST">
	<input type="hidden" value="true" name="logout">
	<input type="submit" value="Logout"></form></li>
</ul>
</td></tr>
</table>
<?php
	echo "<script src='https://www.gstatic.com/charts/loader.js'></script>";
	echo "<script src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/js/chart.js'></script>";
	echo "<script src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/js/customerChart.js'></script>";
	
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	session_start();
	if(isset($_SESSION['userid'])){
	
	$query = "Select * FROM booking";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	
	$rows = $result->num_rows;
	
	echo "<h1>Booking Details</h1><table id='booking'>";
	echo "<tr><td id='booking'>Booking ID</td><td id='booking'>Customer ID</td><td id='booking'>Room Number</td><td id='booking'>Start Date</td><td id='booking'>End Date</td><td id='booking'>Balance</td><td id='booking'>Is Checked In</td></tr>";
	for($i=0;$i<$rows;++$i){
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo "<tr><td id='booking'>$row[0]</td><td id='booking'>$row[1]</td><td id='booking'>$row[2]</td><td id='booking'>$row[3]</td><td id='booking'>$row[4]</td><td id='booking'>$row[5]</td><td id='booking'>$row[6]</td></tr>";
	}
	echo "</table>";
	
	$query = "Select * FROM customer";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	echo "<h1>Customer Details</h1><table id='booking'>";
	echo "<tr><td id='booking'>Customer ID</td><td id='booking'>First Name</td><td id='booking'>Last Name</td><td id='booking'>Is Frequent</td></tr>";
	for($i=0;$i<$rows;++$i){
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo "<tr><td id='booking'>$row[0]</td><td id='booking'>$row[1]</td><td id='booking'>$row[2]</td><td id='booking'>$row[3]</td></tr>";
	}
	echo "</table>";
	echo "<h1>Create new staff account</h1>";
	echo "<form action='adminView.php' method='POST'>";
	echo "<table><tr><td><input type='text' placeholder='Username' name='userid' required></td></tr>
				<tr><td><input type='text' placeholder='First Name' name='fname' required></td></tr>
				<tr><td><input type='text' placeholder='Last Name' name='lname' required></td></tr>
				<select name='type'>
				<option value='1'>Admin</option>
				<option value='0'>Staff</option>
				</select>
				<tr><td><input type='password' placeholder='Password' name='pword' required></td></tr>";
	echo "</table><input type='hidden' value='true' name='newAccount'>
				  <input type='submit' value='Create Account'></form>";
				  
	if(isset($_POST['newAccount'])){
		$userid = $_POST['userid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$pword = $_POST['pword'];
		$type = $_POST['type'];
		$token = hash('haval192,5', $pword);
		$query = "INSERT INTO `staff` (`staffID`, `Fname`, `Lname`, `isAdmin`, `password`) VALUES ('$userid', '$fname', '$lname', '$type', '$token');";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
		echo "<h4>Account Created</h4>";
	}			  
	

	$index = 0;
	foreach($conn->query('SELECT isFrequent, COUNT(*) FROM customer GROUP BY isFrequent') as $row) { 
	
	$count[$index] = $row['COUNT(*)'];
	$categories[$index] = $row['isFrequent'];
	$index = $index + 1;
	}
	echo '<script>var categories = ' . json_encode($categories) . ';</script>';
	echo '<script>var count = ' . json_encode($count) . ';</script>';
	echo "<div id='customerChart_div' style='width:300; height:300' onload='drawCustomerChart()'></div>";
	
	}else{
		echo "You Must Be Logged In to view the Admin Dashboard";
	}
	
?>