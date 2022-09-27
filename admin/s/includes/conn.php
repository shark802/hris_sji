<?php
	$conn = new mysqli('localhost', 'root', 'j@$0n%$h@rKDB', 'hris_sji');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>