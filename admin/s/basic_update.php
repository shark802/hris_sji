<?php
		include('dbcon.php');
		include('session.php');
		
		$pos_id = $_POST['position_id'];
        
        $pos = $_POST['com_position'];
        $bpay = $_POST['basic_pay'];
		
        mysqli_query($connection,"update com_position set 
        com_position = '$pos', basic_pay = '$bpay'
		where position_id = '$pos_id'
		")or die(mysqli_error());

		?>

		
		
		
		