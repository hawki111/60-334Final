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
</ul>
</td></tr>
</table>
</head>
<body>
<h3>Employee Dashboard</h3>
<p>Search for Booking by BookingID, CustomerID, or Room Number.</p>
<p>Seach for a Customer by CustomerID, First or Last name.</p>
<form action="staffView.php" method="POST">
<table>
<tr align="right">
<td>Search Booking: <input type="text" placeholder="Search Term..." name="bookSearch" ></td>
<td><input type="Submit" value="Search"></form></td>
</tr>
<tr align="right"><form action="staffView.php" method="POST">
<td>Search Customer: <input type="text" placeholder="Search Term..." name="frequent"></td>
<td><input type="Submit" value="Search"></td>
</tr>
</table> 
</form>
</body>
<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	session_start();
	
	if(isset($_POST['checkin'])){
		$bookingid = $_POST['checkin'];
		$query = "UPDATE `booking` SET `checkedIn` = '1' WHERE `booking`.`bookingID` = '$bookingid';";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
	}
	
	if(isset($_POST['isfrequent'])){
		$customerID = $_POST['isfrequent'];
		$query = "UPDATE `customer` SET `isFrequent` = '1' WHERE `customer`.`customerID` = '$customerID';";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
	}
	
	if(isset($_POST['bookSearch']) && isset($_SESSION['userid'])){
		$searchTerm = $_POST['bookSearch'];
		if($searchTerm == ""){
			$query = "Select * FROM booking;";
		}else{
			$query  = "Select * FROM booking WHERE bookingID = '$searchTerm' OR CustomerID = '$searchTerm' OR roomNumber = '$searchTerm';";
		}
		
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
		echo "<h4>Customer Check-in</h4>";
		echo "<table id='booking'>";
		echo "<tr><td>BookingID</td><td>CustomerID</td><td>Room Number</td><td>Start</td><td>End</td><td>Balance</td><td>Checked In</td></tr>";
		$rows = $result->num_rows;
		for($i=0;$i<$rows;++$i){
			$result->data_seek($i);
			$row = $result->fetch_array(MYSQLI_NUM);
			
			
			echo "<tr><td id='booking'>$row[0]</td><td id='booking'>$row[1]</td><td id='booking'>$row[2]</td><td id='booking'>$row[3]</td><td id='booking'>$row[4]</td><td id='booking'>$$row[5]</td><td id='booking'>$row[6]</td>
						<td><form action='staffView.php' method='POST'><input type='submit' value='Check In'></td>
						<input type='hidden' value='$row[0]' name='checkin'>
						<input type='hidden' value='$searchTerm' name='bookSearch'></form>
						</tr>";
			
		}
		echo "</table>";
		
		
	}
	echo "";
	if(isset($_POST['frequent'])){
		$searchTerm = $_POST['frequent'];
		if($searchTerm == ""){
			$query = "Select * FROM customer";
		}else{
			$query = "Select * FROM customer WHERE customerID = '$searchTerm' OR Fname = '$searchTerm' OR Lname = '$searchTerm'";
		}
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
		echo "<h4>Customer Upgrade</h4>";
		echo "<table id='booking'>";
		echo "<tr><td>CustomerID</td><td>First Name</td><td>Last Name</td><td>Is Frequent</td></tr>";
		$rows = $result->num_rows;
		
		for($i=0;$i<$rows;++$i){
			$result->data_seek($i);
			$row = $result->fetch_array(MYSQLI_NUM);
			
			
			echo "<tr><td id='booking'>$row[0]</td><td id='booking'>$row[1]</td><td id='booking'>$row[2]</td><td id='booking'>$row[3]</td>
						<td><form action='staffView.php' method='POST'><input type='submit' value='Upgrade'></td>
						<input type='hidden' value='$row[0]' name='isfrequent'>
						<input type='hidden' value='$searchTerm' name='frequent'></form>
						</tr>";
			
		}
		echo "</table>";
		
	}


?>
</html>