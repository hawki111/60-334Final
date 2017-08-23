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
<br><br><br>
<?php
  
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  
  session_start();
  
 
	  $arrive = $_SESSION['arrive'];
	  $depart = $_SESSION['depart'];
	  $pet = $_SESSION['pet'];
	  $smoke = $_SESSION['smoke'];
	  echo "<h1 align='center'>Your Set Arrival Date is: $arrive</h1>";
	  echo "<h1 align='center'>Your Set Departure Date is: $depart</h1>";
	  
	  $query  = "SELECT roomNumber FROM `booking` WHERE ((start between date '$arrive' and date '$depart') and (end between date '$arrive' and date '$depart')) OR ((start < date '$arrive') and (end between date '$arrive' and date '$depart')) OR ((end > date '$depart') and (start between date '$arrive' and date '$depart')) OR ((start < date '$arrive') and (end > date '$depart'))";
	  $result = $conn->query($query);
	  if (!$result) die ("Database access failed: " . $conn->error);
  
  $rows = $result->num_rows;
  
  if($rows !=0 ){
  $query  = "SELECT * FROM room WHERE roomID NOT IN (";
  for($i = 0 ; $i < $rows ; ++$i){
	  $result->data_seek($i);
	  $row = $result->fetch_array(MYSQLI_NUM);
	  $query = $query . $row[0] . ", ";
	  
  }
  $query = $query . $row[0] . ")";

  }elseif($rows == 0){
  $query = "SELECT * FROM room";
  }
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);
  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
	echo "
	<div id='room'><p id='roompic'>";
	if($row[2] == 1){
		echo "<img alt='One Bed'src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/1bed.jpg' width='200' height=140' id='roompic' alt='1bed'>";
	}else{
		echo "<img alt='Two Bed'src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/2bed.jpg' width='200' height='140' id='roompic' alt='2bed'>";
	}
	if($row[5] == 1){
		echo "<img alt='One Bed'src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/smoking.jpg' width='70' height=60' alt='smoking'>";
	}else{
		echo "<img alt='One Bed'src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/nosmoking.jpg' width='70' height=70' alt='no smoking'>";
	}
	if($row[4] == 1){
		echo "<img alt='One Bed'src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/pets.jpg' width='70' height=60' alt='pets'>";
	}else{
		echo "<img alt='One Bed'src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/nopets.png' width='70' height=70' alt='no pets'>";
	}
	
	echo"
	</p><p>Room Number: $row[0]<br></p>
	<p>Floor: $row[1] Beds: $row[2] Bathrooms: $row[3]</p>
	";
	echo "
	<form action='book.php' method='POST'>
    <input type='hidden' name='room' value='$row[0]'>
    <input type='hidden' name='arrive' value='$arrive'>
    <input type='hidden' name='depart' value='$depart'>
    <input type='hidden' name='price' value='$row[6]'>
	<p id='price'>Price: $$row[6]</p>
	<input type='image' name='submit' src='http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/button_book-room.png' border='0' alt='Submit' />
	</div>
	</form>";
	
  }

?>
<a href="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/dateSelect.php">Click here to change dates</a>

</body>

</html>