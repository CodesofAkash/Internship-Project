<?php
	$conn = new mysqli('localhost', 'root', '', 'restaurent');
	if($conn->connect_error){
	   die("Connection failed: " . $conn->connect_error);
	}
?>