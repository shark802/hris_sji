	<?php include('includes/conn.php'); ?>
	<form action="meb_table.php" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="example">
		<div class="pull-right">
	 
	
	</div>
	<a data-toggle="modal" href="#employee_delete" id="delete"  class="btn btn-success" name=""><i class="icon-trash icon-refresh"></i> Refresh</a>
	
		<thead>
		<tr>
					<th>DETAILS</th>
					<th>ACTION</th>
		
		</tr>
		</thead>
		<tbody>
		
		<tr>
		<td>Basic Wages</td> 
            <td width="150">
		<a data-placement="top" title="Click to View all Details" href="basic.php" class="btn btn-success"><i class="icon-inbox icon-large"></i> &nbsp; Open</a>
			<script type="text/javascript">
			$(document).ready(function(){
				$('#view<?php echo $id; ?>').tooltip('show');
				$('#view<?php echo $id; ?>').tooltip('hide');
			});
			</script>
		</td>
        </tr>
        
        <tr>
		<td>OverTime Rate</td> 
            <td width="150">
		<a data-placement="top" title="Click to View all Details" href="otrate.php" class="btn btn-success"><i class="icon-inbox icon-large"></i> &nbsp; Open</a>
			<script type="text/javascript">
			$(document).ready(function(){
				$('#view<?php echo $id; ?>').tooltip('show');
				$('#view<?php echo $id; ?>').tooltip('hide');
			});
			</script>
		</td>
        </tr>
        
        <tr>
		<td>Benefits and Contribution</td> 
            <td width="150">
		<a data-placement="top" title="Click to View all Details" href="benefits.php" class="btn btn-success"><i class="icon-inbox icon-large"></i> &nbsp; Open</a>
			<script type="text/javascript">
			$(document).ready(function(){
				$('#view<?php echo $id; ?>').tooltip('show');
				$('#view<?php echo $id; ?>').tooltip('hide');
			});
			</script>
		</td>
        </tr>
            
        <tr>
		<td>Loans</td> 
            <td width="150">
		<a data-placement="top" title="Click to View all Details" href="loan.php" class="btn btn-success"><i class="icon-inbox icon-large"></i> &nbsp; Open</a>
			<script type="text/javascript">
			$(document).ready(function(){
				$('#view<?php echo $id; ?>').tooltip('show');
				$('#view<?php echo $id; ?>').tooltip('hide');
			});
			</script>
		</td>
        </tr>
            
        <tr>
		<td>Tax Table</td> 
            <td width="150">
		<a data-placement="top" title="Click to View all Details" href="tax.php" class="btn btn-success"><i class="icon-inbox icon-large"></i> &nbsp; Open</a>
			<script type="text/javascript">
			$(document).ready(function(){
				$('#view<?php echo $id; ?>').tooltip('show');
				$('#view<?php echo $id; ?>').tooltip('hide');
			});
			</script>
		</td>
        </tr>
		
		</tbody>
	</table>
	</form>