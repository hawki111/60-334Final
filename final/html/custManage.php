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
</ul>
</td></tr>
</table>
</head>
<body>
<h3>Customer Dashboard</h3>
<p>Click Delete to cancel a booking.</p>
<table id="login">
<tr>
<form action="custManage.php" method="POST">
<td id="login">Email: <input type="text" name="uname"></td>
</tr><tr>
<td id="login">Password: <input type="password" name="pword"></td>
</tr><tr>
<td><input type="submit" value="Login"></td>
</tr>
</table>
<br><br>
</body>
</html>
<?php

	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	$uname = $_POST['uname'];
	$pword = $_POST['pword'];
	
	if(isset($_POST['delete'])){
		$bookingID = $_POST['delete'];
	    $query  = "DELETE FROM `booking` WHERE bookingID = '$bookingID';";
		$result = $conn->query($query);
		if (!$result) die ("Database access failed: " . $conn->error);
  }
	
  $query  = "SELECT * FROM `customer` WHERE (customerID = '$uname')";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);
  elseif($result->num_rows){
		$row = $result->fetch_array(MYSQLI_NUM);   
		$result->close();
		$token = hash('haval192,5', $pword);
		
		if($token == $row[4]){
			
			$query  = "Select * FROM booking WHERE customerID = '$uname';";
			$result = $conn->query($query);
			if (!$result) die ("Database access failed: " . $conn->error);
			echo "<table id='booking'>";
			echo "<tr><td>BookingID</td><td>CustomerID</td><td>Room Number</td><td>Start</td><td>End</td><td>Balance</td></tr>";
			$rows = $result->num_rows;
			for($i=0;$i<$rows;++$i){
			$result->data_seek($i);
			$row = $result->fetch_array(MYSQLI_NUM);
			
			
			echo "<tr><td id='booking'>$row[0]</td><td id='booking'>$row[1]</td><td id='booking'>$row[2]</td><td id='booking'>$row[3]</td><td id='booking'>$row[4]</td><td id='booking'>$$row[5]</td>";
			echo "<td><form action='custManage.php' method='POST'><input type='submit' value='Delete'></td></tr>
				  <input type='hidden' name='delete' value='$row[0]'>
				  <input type='hidden' name='uname' value='$uname'>
				  <input type='hidden' name='pword' value='$pword'>
				  </form>";
		}
		echo "</table>";
			
			
		}else{
			echo "Incorrect password";
		}
  }
  else{
	 echo "Invalid Username";
  }
  
  
		
	
?>