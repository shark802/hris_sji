<?php 
	include 'includes/session.php';
	$employee_id = $user['employee_id'];

	 $sql = "SELECT COUNT(*) AS count_row, employee_id, date, GROUP_CONCAT(clocked, '-', status, '-', shift ORDER BY clocked) AS clocked,
            	SUM(num_hr) AS totalNum_hrs, remarks
                FROM attendance WHERE employee_id = '$employee_id' GROUP BY date ORDER BY date DESC LIMIT 10;";
	$query = $conn->query($sql);
	echo '<table id="example1" class="table table-bordered">';
	echo '
		<thead>
			<th class="hidden"></th>
			<th>Date</th>
			<th></th>
			<th>Time In (AM)</th>
			<th>Time Out (AM)</th>
			<th>Time In (PM)</th>
			<th>Time Out (PM)</th>
			<th>Total Time (Hrs)</th>
	  	</thead>';
	while ($row = $query->fetch_assoc()) {
		$rdate = ($row['date']) ? date('M d, Y', strtotime($row['date'])) : '-';
        $arr_clocked = $row['clocked'];
        $clockin_am = '-';
        $clockout_am = '-';
        $clockin_pm = '-';
        $clockout_pm = '-';
        $totalNum_hrs = ($row['totalNum_hrs']) ? $row['totalNum_hrs'] : '-';
		$status = ($row['remarks'] == 1)?'<span class="label label-success pull-left">ontime</span> &nbsp;':'<span class="label label-warning pull-left">late</span>';

		// explode row time 
		$time_arr = explode (",", $arr_clocked); 

		for ($i = 0; $i < count($time_arr); $i++) {
			if(str_contains($time_arr[$i], '-in') && str_contains($time_arr[$i], '-1')){
				$temp = $time_arr[$i];
				$temp_explode = explode ("-", $temp);
				$clockin_am = date('h:i A', strtotime($temp_explode[0]));
			} 
			if(str_contains($time_arr[$i], '-out') && str_contains($time_arr[$i], '-1')){
				$temp = $time_arr[$i];
				$temp_explode = explode ("-", $temp);
				$clockout_am = date('h:i A', strtotime($temp_explode[0]));
			}
			if(str_contains($time_arr[$i], '-in') && str_contains($time_arr[$i], '-2')){
				$temp = $time_arr[$i];
				$temp_explode = explode ("-", $temp);
				$clockin_pm = date('h:i A', strtotime($temp_explode[0]));
			}
			if(str_contains($time_arr[$i], '-out') && str_contains($time_arr[$i], '-2')){
				$temp = $time_arr[$i];
				$temp_explode = explode ("-", $temp);
				$clockout_pm = date('h:i A', strtotime($temp_explode[0]));
			}
		}
		  echo "
		  <tr>
		  <td class='hidden'></td>
		  <td>".$rdate."</td>          
		  <td>".$status."</td>         
		  <td>".$clockin_am."</td>
		  <td>".$clockout_am."</td>
		  <td>".$clockin_pm."</td>
		  <td>".$clockout_pm."</td>
		  <td style='text-align: center;'>".$totalNum_hrs."</td>
		</tr>
		";

		
	}
?>