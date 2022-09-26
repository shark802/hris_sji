<?php
	session_start();
       
	include 'includes/conn.php';

        if(!isset($_SESSION['employee']) || trim($_SESSION['employee']) == ''){
            header('location: index.php');
        }

        $sql = "SELECT *, employment_records.position_id, 
                        employees.employee_id AS username, 
                        employees.id AS eid 
                FROM employees 
                LEFT JOIN employment_records ON employees.id = employment_records.employee_id 
                LEFT JOIN mandatory_contribution_record ON employees.id = mandatory_contribution_record.employee_id 
                LEFT JOIN departments ON departments.id = employment_records.department_id 
                LEFT JOIN position ON position.id = employment_records.position_id 
                LEFT JOIN status ON status.id = employment_records.status 
                WHERE employees.id = '".$_SESSION['employee']."'";
        $query = $conn->query($sql);
        $user = $query->fetch_assoc();

        function getPublicIP(){
        
                $file = file_get_contents('http://ip6.me/');

                // Trim IP based on HTML formatting
                $pos = strpos( $file, '+3' ) + 3;
                $ip = substr( $file, $pos, strlen( $file ) );

                // Trim IP based on HTML formatting
                $pos = strpos( $ip, '</' );
                $ip = substr( $ip, 0, $pos );

                // Output the IP address of your box
                return $ip;
            }

            $getIp = getPublicIP();

                $ip_sql = "SELECT count(ip_address) AS ips FROM ip_address WHERE ip_address = '$getIp'";
                $ip_query = $conn->query($ip_sql);
                $user_ipRow = $ip_query->fetch_assoc();
                $user_ip = $user_ipRow['ips'];


                $ip_restrictSql = "SELECT status FROM ip_restrict";
                $ip_restrictQuery = $conn->query($ip_restrictSql);
                $ip_restrictRow = $ip_restrictQuery->fetch_assoc();
                $ip_restrict = $ip_restrictRow['status'];


?>