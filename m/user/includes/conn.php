<?php
	$conn = new mysqli('localhost', 'root', '', 'hris_sji');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>