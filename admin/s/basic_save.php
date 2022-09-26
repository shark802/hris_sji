
		<?php
		include('dbcon.php');
		include('session.php');
        
        $pos = $_POST['com_position'];
        $bpay= $_POST['basic_pay'];
      
        mysqli_query($connection,"insert into com_position(com_position,basic_pay)values ('$pos', '$bpay')")or die(mysqli_error());
		
        ?>