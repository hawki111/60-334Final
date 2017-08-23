<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	for($i=1;$i<10;++$i){
		for($j=0;$j<10;++$j){
			$bed = rand(1,2);
			$bath = rand(1,2);
			$pet = rand(0,1);
			$smoke = rand(0,1);
			$room =  $i . "0" . $j;
			if($bed == 2 && $bath == 2){
				$price = 200 + ($i * 10);
			}else if($bed == 2 || $bath == 2){
				$price = 150 + ($i * 10);
			}else{
				$price = 100 + ($i * 10);
			}
			echo $bed . "Bed <br>";
			echo $bath . "Bath <br>";
			echo $i . "Floor <br>";
			echo $price . "Price <br><br>";
			$query = "INSERT INTO `room` (`roomID`, `floor`, `beds`, `bathrooms`, `pet`, `smoking`, `price`, `isAvailable`) VALUES ('$room', '$i', '$bed', '$bath', '$pet', '$smoke', '$price', '1')";
			$result = $conn->query($query);
			if (!$result) die ("Database access failed: " . $conn->error);
		}
	}
?>