<?php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  if(isset($_POST['fname'])){  //New User Creation
	  $userid = $_POST['userid'];
	  $fname = $_POST['fname'];
	  $lname = $_POST['lname'];
	  $pword = $_POST['pword'];
	  $token = hash('haval192,5', $pword);
	  $query  = "INSERT INTO `customer` (`customerID`, `Fname`, `Lname`, `isFrequent`, `password`) VALUES ('$userid', '$fname', '$lname', '0', '$token');";
	  $result = $conn->query($query);
	  if (!$result) die ("Database access failed: " . $conn->error);
	  echo "Account Created";
	  echo "<script>window.location = 'dateSelect.php'</script>";
  }else{						//User Authentication
  
  $userid = $_POST['uname'];
  $pword = $_POST['pword'];
  $arrive = $_POST['arrive'];
  $depart = $_POST['depart'];

  $query  = "SELECT * FROM `customer` WHERE (customerID = '$userid')";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);
  elseif($result->num_rows){
		$row = $result->fetch_array(MYSQLI_NUM);   
		$result->close();
		$token = hash('haval192,5', $pword);
		
		if($token == $row[4]){
			
			session_start();
			$_SESSION['userid'] = $_POST['uname'];
			$_SESSION['arrive'] = $_POST['arrive'];
			$_SESSION['depart'] = $_POST['depart'];
		
			header("Location: http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/roomSelect.php");
			die();
		}else{
			header("Location: http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/dateSelect.php");
			die();
		}
  }
  else{
	  header("Location: http://hawki111.myweb.cs.uwindsor.ca/60334/Assignments/final/html/dateSelect.php");
	  die();
  }
  
  }

?>