<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Leave Application</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="application_leave_add.php">
                  
              <div class="form-group">
                    <label for="employee_id" class="col-sm-3 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="employee_id" name="employee_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees ORDER BY lastname";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['lastname'].', '.$row['firstname']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
          
                <div class="form-group">
                  	<label for="date_from" class="col-sm-3 control-label">Date From</label>

                  	<div class="col-sm-7">
                      <input type="date" class="form-control" name="date_from" id="date_from" required>
                  	</div>
                </div>

                <div class="form-group">
                  	<label for="date_to" class="col-sm-3 control-label">Date To</label>

                  	<div class="col-sm-7">
                      <input type="date" class="form-control" name="date_to" id="date_to" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="leave_type" class="col-sm-3 control-label">Leave Type</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="leave_type" name="leave_type" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM leave_types GROUP BY leave_type";
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
                  	<label for="reason" class="col-sm-3 control-label">Reason</label>

                  	<div class="col-sm-7">
                      <textarea type="text" class="form-control" name="reason" id="reason" required></textarea>
                  	</div>
                </div>

                <div class="form-group">
                    <label for="hr_approval" class="col-sm-3 control-label">HR Approval</label>
                    <div class="col-sm-7"> 
                      <select class="form-control" name="hr_approval" id="hr_approval" required>
                        <option selected></option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="supervisor_approval" class="col-sm-3 control-label">Supervisor Approval</label>
                    <div class="col-sm-7"> 
                      <select class="form-control" name="supervisor_approval" id="supervisor_approval">
                        <option selected></option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="principal_approval" class="col-sm-3 control-label">Principal Approval</label>
                    <div class="col-sm-7"> 
                      <select class="form-control" name="principal_approval" id="principal_approval">
                        <option selected></option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                      </select>
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
              <h4 class="modal-title"><b>Edit Leave Application Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="application_leave_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <div class="form-group">
                    <label for="edit_employee_id" class="col-sm-3 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_employee_id" name="employee_id" readonly>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees ORDER BY lastname";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['lastname'].', '.$row['firstname']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
          
                <div class="form-group">
                  	<label for="edit_date_from" class="col-sm-3 control-label">Date From</label>

                  	<div class="col-sm-7">
                      <input type="date" class="form-control" name="date_from" id="edit_date_from" required>
                  	</div>
                </div>

                <div class="form-group">
                  	<label for="edit_date_to" class="col-sm-3 control-label">Date To</label>

                  	<div class="col-sm-7">
                      <input type="date" class="form-control" name="date_to" id="edit_date_to" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="edit_leave_type" class="col-sm-3 control-label">Leave Type</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_leave_type" name="leave_type" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM leave_types GROUP BY leave_type";
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
                  	<label for="edit_reason" class="col-sm-3 control-label">Reason</label>

                  	<div class="col-sm-7">
                      <textarea type="text" class="form-control" name="reason" id="edit_reason" required></textarea>
                  	</div>
                </div>

                <div class="form-group">
                    <label for="edit_hr_approval" class="col-sm-3 control-label">HR Approval</label>
                    <div class="col-sm-7"> 
                      <select class="form-control" name="hr_approval" id="edit_hr_approval" required>
                        <option selected></option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_supervisor_approval" class="col-sm-3 control-label">Supervisor Approval</label>
                    <div class="col-sm-7"> 
                      <select class="form-control" name="supervisor_approval" id="edit_supervisor_approval">
                        <option selected></option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_principal_approval" class="col-sm-3 control-label">Principal Approval</label>
                    <div class="col-sm-7"> 
                      <select class="form-control" name="principal_approval" id="edit_principal_approval">
                        <option selected></option>
                        <option value=1>Yes</option>
                        <option value=0>No</option>
                      </select>
                    </div>
                </div>

                <div class="form-group">
                  	<label for="edit_status" class="col-sm-3 control-label">Status</label>

                  	<div class="col-sm-7">
                      <input type="text" class="form-control" name="status" id="edit_status" readonly>
                  	</div>
                </div>
                
                  <!-- End -->
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
            	<form class="form-horizontal" method="POST" action="application_leave_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h3 id="del_deduction" class="bold"><p>You want delete this leave application?</p></h3>
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





     