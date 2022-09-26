<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Leave Type</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="leave_add.php">
                  
              <div class="form-group">
                    <label for="employment_status" class="col-sm-3 control-label">Employment Status</label>

                    <div class="col-sm-7">
                      <select class="form-control" name="employment_status" id="employment_status" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM status";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['status']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="leave_type" class="col-sm-3 control-label">Leave Type</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="leave_type" id="leave_type" required>
                  	</div>
                </div>  
                <div class="form-group">
                  	<label for="abbreviation" class="col-sm-3 control-label">Abbreviation</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="abbreviation" id="abbreviation" required>
                  	</div>
                </div>  
                <div class="form-group">
                  	<label for="total_use" class="col-sm-3 control-label">Total Usage</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="total_use" id="total_use" required>
                  	</div>
                </div>   
                <div class="form-group">
                  	<label for="monthly_accumulation" class="col-sm-3 control-label">Monthly Accumulation</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="monthly_accumulation" id="monthly_accumulation" required>
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
              <h4 class="modal-title"><b>Edit Leave Type Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="leave_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <div class="form-group">
                    <label for="edit_employment_status" class="col-sm-3 control-label">Employment Status</label>

                    <div class="col-sm-7">
                      <select class="form-control" name="employment_status" id="edit_employment_status" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM status";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['status']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_leave_type" class="col-sm-3 control-label">Leave Type</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="leave_type" id="edit_leave_type" required>
                  	</div>
                </div>  
                <div class="form-group">
                  	<label for="edit_abbreviation" class="col-sm-3 control-label">Abbreviation</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="abbreviation" id="edit_abbreviation" required>
                  	</div>
                </div>  
                <div class="form-group">
                  	<label for="edit_total_use" class="col-sm-3 control-label">Total Usage</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="total_use" id="edit_total_use" required>
                  	</div>
                </div>   
                <div class="form-group">
                  	<label for="edit_monthly_accumulation" class="col-sm-3 control-label">Monthly Accumulation</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="monthly_accumulation" id="edit_monthly_accumulation" required>
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
            	<form class="form-horizontal" method="POST" action="leave_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h3 id="del_deduction" class="bold"><p>You want delete this Leave Type?</p></h3>
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





     