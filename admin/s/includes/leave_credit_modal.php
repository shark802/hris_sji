<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add Leave Credit Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="leave_credit_add.php">
                  <!-- Start -->
                  <input type="hidden" class="employee_id" name="employee_id">
                  <div class="form-group">
                    <label for="leave_type" class="col-sm-3 control-label">Leave Type</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="leave_type" name="leave_type" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $get_id = $_GET['id'];
                          $sql0 = "SELECT status FROM employment_records WHERE employee_id = '$get_id'";
                          $query0 = $conn->query($sql0);
                          $row = $query0->fetch_assoc();
                          $status = $row['status'];

                          $sql = "SELECT * FROM leave_types WHERE employment_status = '$status'";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['leave_type']."'>".$row['leave_type']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="unused_leave" class="col-sm-3 control-label">Leave Credit</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="unused_leave" id="unused_leave" required>
                  	</div>
                </div>  
                <div class="form-group">
                  	<label for="used_leave" class="col-sm-3 control-label">Used Credit</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="used_leave" id="used_leave" required>
                  	</div>
                </div>              
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Leave Credit Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="leave_credit_edit.php">
                <input type="hidden" class="id" name="id">
                <input type="hidden" class="edit_employee_id" name="employee_id">
                  <!-- Start -->
                <div class="form-group">
                  	<label for="edit_leave_type" class="col-sm-3 control-label">Leave Type</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="leave_type" id="edit_leave_type" readonly>
                  	</div>
                </div>  
                <div class="form-group">
                  	<label for="edit_unused_leave" class="col-sm-3 control-label">Leave Credit</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="unused_leave" id="edit_unused_leave" required>
                  	</div>
                </div>  
                <div class="form-group">
                  	<label for="edit_used_leave" class="col-sm-3 control-label">Used Credit</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="used_leave" id="edit_used_leave" required>
                  	</div>
                </div>              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_credit_delete.php">
            		<input type="hidden" class="id" name="id">
                <input type="hidden" class="edit_employee_id" name="employee_id">
            		<div class="text-center">
	                	
	                	<h3 id="del_deduction" class="bold"><p>You want delete this Leave Credit?</p></h3>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>





     