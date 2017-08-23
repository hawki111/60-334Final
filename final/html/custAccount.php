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
<h1>Create an Account</h1>
</head>
<form action="customerLogin.php" method="POST">
Email: <input type="text" name="userid" required><br><br>
First Name: <input type="text" name="fname" required><br><br>
Last Name: <input type="text" name="lname" required><br><br>
Password: <input type="password" name="pword" required><br><br>
<input type="submit" value="Create Account">
</form>
</html>