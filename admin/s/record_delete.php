<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$selected_item;
		$sql0 = "SELECT * FROM employment_records WHERE id = '$id'";
		$query = $conn->query($sql0);
        while($row = $query->fetch_assoc()){
			$selected_item = $row['mandatory_government'];
		}

		$sql_delete_mandatory = "DELETE FROM mandatory_contribution_record WHERE id = '$selected_item'";
		$conn->query($sql_delete_mandatory);
		
		$sql_delete_er = "DELETE FROM employment_records WHERE id = '$id'";
		if($conn->query($sql_delete_er)){
			$_SESSION['success'] = 'Employment record deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: record.php');
	
?>