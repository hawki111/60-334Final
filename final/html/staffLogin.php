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

</head>

<body>
<form action="staffLogin.php" method="POST">
<table id="login"><tr>
<td id="login">Username: <input type="text" name="uname" required></td>
</tr><tr>
<td id="login">Password: <input type="password" name="pword" required></td>
</tr>
<tr><td>
<input type="submit" value="Login">
</td></tr>
</form>
</table>
</body>
</html>
<?php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  
  if(isset($_POST['uname'])){
  $userid = $_POST['uname'];
  $pword = $_POST['pword'];

  $query  = "SELECT * FROM `staff` WHERE (staffID = '$userid')";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);
  elseif($result->num_rows){
		$row = $result->fetch_array(MYSQLI_NUM);   
		$result->close();
		$token = hash('haval192,5', $pword);
		
		if($token == $row[4]){
			
			session_start();
			$_SESSION['userid'] = $_POST['uname'];
			if($row[3] == 1){
				header("Location: http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/adminView.php");
				die();
			}else{
				header("Location: http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/staffView.php");
				die();
			}
			
		}else{
			echo "Inorrect Password";
		}
  }
  else{
	  echo "Inorrect Username";
  }
  }

?>