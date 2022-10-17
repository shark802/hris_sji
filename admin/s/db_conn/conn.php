<?php
	$conn = new mysqli('139.177.190.17', 'j@son', 'j@$0n%$h@rKDB', 'hris_sji');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>