<?php
	$conn = new mysqli('localhost', '2019_A04', 'Jhf2Y5Hqp4j8L6BU', '2019_A04');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>