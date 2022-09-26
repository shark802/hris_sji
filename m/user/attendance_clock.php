<?php 
	include 'includes/session.php';
	include 'timezone.php';

	if(isset($_POST['id'])){
		$employee_id = $_POST['id'];
		$status = $_POST['status'];
		$date_now = date('Y-m-d');

		$chk_shift = "SELECT COUNT(*) as countRow FROM attendance WHERE employee_id = '$employee_id' AND 
							date = '$date_now' AND shift = 1";			
		$shf_query = $conn->query($chk_shift);
		$shf_row = $shf_query->fetch_assoc();
		
		if($shf_row['countRow'] < 2) {
			$shift = 1;
		} else {
			$shift = 2;
		}

		/* Auto Populate date
		for($i = 14; $i <= 78; $i++){
			$employee_id = $i;
			for($j = 11; $j <= 78; $j++){
				$date_now = '2022-08-'.$j;
				$time_now1 = '07:00:00';
				$time_now2 = '12:00:00';
				$time_now3 = '13:00:00';
				$time_now4 = '16:00:00';
				$status1 = 'in';
				$status2 = 'out';
				$shift1 = 1;
				$shift2 = 2;
				$num_hr1 = number_format(5, 2);
				$num_hr2 = number_format(3, 2);
	
				$sql1 = "INSERT INTO attendance (employee_id, date, clocked, status, shift) 
						VALUES ('$employee_id', '$date_now', '$time_now1', '$status1', '$shift1')";
				$conn->query($sql1);
	
				$sql2 = "INSERT INTO attendance (employee_id, date, clocked, status, shift, num_hr) 
						VALUES ('$employee_id', '$date_now', '$time_now2', '$status2', '$shift1', '$num_hr1')";
				$conn->query($sql2);
	
				$sql3 = "INSERT INTO attendance (employee_id, date, clocked, status, shift) 
						VALUES ('$employee_id', '$date_now', '$time_now3', '$status1', '$shift2')";
				$conn->query($sql3);
	
				$sql4 = "INSERT INTO attendance (employee_id, date, clocked, status, shift, num_hr) 
						VALUES ('$employee_id', '$date_now', '$time_now4', '$status2', '$shift2', '$num_hr2')";
				$conn->query($sql4);
			}
		}
		*/
		
		$check_timed_in = "SELECT status, shift, Count(shift) as countShift, SUM(num_hr) AS total_NumHrs FROM attendance WHERE employee_id = '$employee_id' AND 
							date = '$date_now'";			
		$query = $conn->query($check_timed_in);
		$row = $query->fetch_assoc();

		if($row['countShift'] >= 4 || $row['total_NumHrs'] >= 8){
			//$status = $row['status'];
			$output['error'] = true;

			if($status == 'in'){
				$output['message'] = '<b>You have already time in</b>';
			} else {
				$output['message'] = '<b>You have already time out</b>';
			}		
		} 
		else {
			$er_sql = "SELECT s.time_in, s.grace_period, er.schedule_id FROM employment_records AS er 
						LEFT JOIN schedules AS s ON s.id = er.schedule_id 
						WHERE employee_id = '$employee_id'";			
			$er_query = $conn->query($er_sql);
			$er_row = $er_query->fetch_assoc();
			$grace_period = $er_row['grace_period'];

			// Remarks
			// Ontime = 1
			// Late = 0
			// UnderTime = 2
			// Late UnderTime = 3
			// Ontime UnderTime = 4


			$remarks = 1; // Ontime
			$late = 0; // Late
			$undertime = 0; // Undetime

			$sched_clock = $er_row['time_in'];
			$sched_clock_InGrace = date('H:i:s', strtotime($sched_clock. ' +'.$grace_period.' minutes'));
			

			if($status == 'in'){
				// check employee time in Late
				if($status == 'in' && $shift == 1 && $sched_clock_InGrace < $time_now){
					$remarks = 0;
					$timeInDetails1 = date_create($sched_clock_InGrace);
					$timeInDetails2 = date_create($time_now);
					$difference = date_diff($timeInDetails1, $timeInDetails2); 
					//$difference->h;
					$minutes = $difference->days * 24 * 60;
					$minutes += $difference->h * 60;
					$minutes += $difference->i;
					$late = intdiv($minutes, 60).':'. ($minutes % 60);
				}
				$sql = "INSERT INTO attendance (employee_id, date, clocked, status, shift, late, remarks) 
						VALUES ('$employee_id', '$date_now', '$time_now', '$status', '$shift', '$late', '$remarks')";
				$conn->query($sql);
				$output['message'] = '<b>You have time in successfully</b>';
				//$output['message'] = $sched_clock_InGrace;

				
			} else {
				$chk_logs = "SELECT * FROM attendance WHERE employee_id = '$employee_id' AND 
							date = '$date_now' AND status = 'in' AND shift = '$shift'";			
				$qry_logs = $conn->query($chk_logs);
				$row_log = $qry_logs->fetch_assoc();
				$cnt_logs = $qry_logs->num_rows;
				$first_timeIn = $row_log['clocked'];
				
				if($cnt_logs < 1){
					$output['error'] = true;
					$output['message'] = '<b>Cannot Timeout. No time in.</b>';
				} else {
					// Ontime / Undertime - 4
					// Late / Undertime - 5 

					$chk_shift = "SELECT count(shift) as shiftCount FROM attendance WHERE employee_id = '$employee_id' AND 
								date = '$date_now'";			
					$qry_shift = $conn->query($chk_shift);
					$cnt_shift = $qry_shift->num_rows;

					$chk_sched = "SELECT time_out From schedules AS s
									LEFT JOIN employment_records AS er ON er.schedule_id = s.id
									WHERE er.employee_id = '$employee_id'";			
					$qry_sched = $conn->query($chk_sched);
					$r_sched = $qry_sched->fetch_assoc();
					$sched_timeOut = $r_sched['time_out'];

					$time_in = new DateTime($first_timeIn);
					$time_out = new DateTime($time_now);
					$interval = $time_in->diff($time_out);
					$hrs = $interval->format('%h');
					$mins = $interval->format('%i');
					$mins = $mins/60;
					$int = number_format($hrs, 2) + number_format($mins, 2);
					
					if($cnt_shift == 1 && $int >= 9){
						$int -= 1;
					}

					if($time_now < $sched_timeOut && $time_now >= '13:00:00'){
						/*
						$sched_timeOut = new DateTime($sched_timeOut);
						$time_out = new DateTime($time_now);
						$interval = $time_out->diff($sched_timeOut);
						$hrs = $interval->format('%h');
						$mins = $interval->format('%i');
						$mins = $mins/60;
						//$undertime = $mins;
						$undertime = number_format($hrs, 2) + number_format($mins, 2);
						$ut = intdiv($undertime, 60).':'. ($undertime % 60);
						*/

						$timeInDetails1 = date_create($sched_timeOut);
						$timeInDetails2 = date_create($time_now);
						$difference = date_diff($timeInDetails1, $timeInDetails2); 
						//$difference->h;
						$minutes = $difference->days * 24 * 60;
						$minutes += $difference->h * 60;
						$minutes += $difference->i;
						//$undertime = intdiv($minutes, 60).':'. ($minutes % 60);
						$undertime = $minutes;
					}

					
					$sql = "INSERT INTO attendance (employee_id, date, clocked, status, shift, num_hr, undertime) 
						VALUES ('$employee_id', '$date_now', '$time_now', '$status', '$shift', '$int', '$undertime')";
					$conn->query($sql);
					$output['message'] = '<b>You have time out successfully</b>';
				}
				
			}
		}
		
		
	echo json_encode($output);
	}
?>