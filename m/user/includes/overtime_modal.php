<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Overtime Application</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="overtime_add.php">

                <input type="hidden" class="form-control" name="employee_id" value="<?php echo $employee_id; ?>" required>
                
                <div class="form-group">
                  	<label for="date_overtime" class="col-sm-4 control-label">Date Application</label>

                  	<div class="col-sm-7">
                      <input type="date" class="form-control" name="date_overtime" id="date_overtime" required>
                  	</div>
                </div>

    
                <div class="form-group">
                  	<label for="hours" class="col-sm-4 control-label">No.of Hrs</label>

                  	<div class="col-sm-7">
                      <input type="text" class="form-control" name="hours" id="hours" required>
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
              <h4 class="modal-title"><b>Edit Leave Overtime Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="overtime_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <input type="hidden" class="form-control" name="employee_id" value="<?php echo $employee_id; ?>" required>
                
				  <div class="form-group">
                  	<label for="edit_date_overtime" class="col-sm-4 control-label">Date Application</label>

                  	<div class="col-sm-7">
                      <input type="date" class="form-control" name="date_overtime" id="edit_date_overtime" required>
                  	</div>
                </div>

    
                <div class="form-group">
                  	<label for="edit_hours" class="col-sm-4 control-label">No.of Hrs</label>

                  	<div class="col-sm-7">
                      <input type="text" class="form-control" name="hours" id="edit_hours" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_status" class="col-sm-4 control-label">Status</label>

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
            	<h4 class="modal-title"></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="overtime_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h3 id="del_deduction" class="bold"><p>You want cancel this overtime application?</p></h3>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="delete"><i class="fa fa-check"></i> Yes</button>
            	</form>
          	</div>
        </div>
    </div>
</div>