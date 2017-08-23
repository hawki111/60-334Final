<html>
<link rel="stylesheet" href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/css/layout.css" type="text/css">
<head>
<title>A Hotel</title>

<table width="100%">
<td><a href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/index.html"><img src="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/logo.png" height="150" width="400" ></a></td>
</table>

</head>

<body>
<br><br><br>
<div id="index">
<p>Your Booking is Complete! Give these details to desk staff to check in.<br></p>
<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	echo "<link rel='stylesheet' href='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/css/layout.css' type='text/css'>";
	if(isset($_POST['room'])){
		session_start();
		$room = $_POST['room'];
		$arrive =  $_POST['arrive'];
		$depart = $_POST['depart'];
		$price = $_POST['price'];
		$userid = $_SESSION['userid'];
		echo "<p>Your Arrival Date is $arrive<br>";
		echo "Your Departure Date is $depart<br>";
		echo "Your room number is $room<br>";
		echo "Your room user id is $userid<br>";
		$date1=date_create($arrive);
		$date2=date_create($depart);
		$diff = date_diff($date1, $date2, true);
		$days = (int)$diff->format("%a");
		$price = $price * $days;
		$query = "SELECT isFrequent FROM `customer` WHERE customerID = '$userid';";
		$result = $conn->query($query);
		$result->data_seek(0);
		$row = $result->fetch_array(MYSQLI_NUM);
		if($row[0] == 1){
			$price = $price * .85;
			echo "You have recieved your 15% Frequent Customer Discount<br>";
		}
		echo "The final cost for a $days Day stay is $$price.</p>";
		$query  = "INSERT INTO `booking` (`CustomerID`, `roomNumber`, `start`, `end`, `balance`) VALUES ('$userid', '$room', '$arrive', '$depart', '$price')";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
	}
	session_destroy();
?>
<p>Click <a href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/index.html">Here</a> to return to the Home Page</p>
<p>Click <a href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/custManage.php">Here</a> to check your bookings</p>
</div>

</body>

</html>