	<?php include('dbcon.php'); ?>
	<form action="basic_table.php" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example">
		<div class="pull-right">
	
	<a href="basic_add.php" class="btn btn-inverse"><i class="icon-plus-sign icon-large"></i> Add Company Position</a>
	</div>
	<a data-toggle="modal" href="basic_table.php" id="delete"  class="btn btn-success" name=""><i class="icon-trash icon-refresh"></i> Refresh</a>
	
		<thead>
		<tr>
					<th>Position</th>
					<th>Basic Pay </th>
				
					<th>Action</th>
				
		</tr>
		</thead>
		<tbody>
		<?php

		$query = mysqli_query($connection,"select * from com_position")or die(mysql_error());
		while($row = mysqli_fetch_array($query)){
		$id = $row['position_id'];
		?>
		<tr>
            
		
		<td><?php echo $row['com_position']; ?></td> 
		<td><?php echo $row['basic_pay']; ?></td>
        
     
		<td class="empty" width="100">
		<a data-placement="left" title="Click to Edit" id="edit<?php echo $id; ?>" href="basic_edit.php<?php echo '?id='.$id; ?>" class="btn btn-success"><i class="icon-pencil icon-large"></i> &nbsp; Update </a>
			<script type="text/javascript">
			$(document).ready(function(){
				$('#edit<?php echo $id; ?>').tooltip('show');
				$('#edit<?php echo $id; ?>').tooltip('hide');
			});
			</script>
		
		</td>
		</tr>
	<?php } ?>    
	
		</tbody>
	</table>
	</form>