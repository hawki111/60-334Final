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
<div id="index">
<form action="customerLogin.php" method="POST">
<table width="60%" align="center" id="selection">
<tr>
<td><h3>What Date would you like to arrive? </h3>(mm-dd-yyyy)<br><input type="date" name="arrive" required></td>
<td><h3>What Date would you like to depart? </h3>(mm-dd-yyyy)<br><input type="date" name="depart" required></td>
</tr>

<tr>
<td><h3>Enter your email: </h3><input type="text" name="uname" required></td>
<td><h3>Enter your password: </h3><input type="password" name="pword" required></td>
</tr>

</table>
<p align="center"><input type="image" name="submit" src="http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/images/button_show-rooms.png" border="0" alt="Submit" /></p>
</form>
</div>

</body>

</html>

<?php
	if(isset($_POST['logout'])){
		session_start();
		session_destroy();
	}
?>