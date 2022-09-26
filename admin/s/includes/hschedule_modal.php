<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Holiday Schedule</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="hschedule_add.php">
          		  <div class="form-group">
                    <label for="holiday_type" class="col-sm-3 control-label">Holiday Type</label>
                    <div class="col-sm-9"> 
                      <select class="form-control" name="holiday_type" id="holiday_type" required>
                        <option value="" selected>- Select -</option>
                        <option value="Legal">Legal Holiday</option>
                        <option value="Special Working">Special Working Holiday</option>
                        <option value="Special Non-Working">Special Non-Working Holiday</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="description" class="col-sm-3 control-label">Description</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="description" id="description"></textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="date" class="col-sm-3 control-label">Date</label>

                  	<div class="col-sm-9"> 
                      <div class="date">
                        <input type="date" class="form-control" id="date" name="date">
                      </div>
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
            	<h4 class="modal-title"><b>Update Holiday Schedule</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="hschedule_edit.php">
            		<input type="hidden" id="timeid" name="id">
               <div class="form-group">
                    <label for="edit_holiday_type" class="col-sm-3 control-label">Holiday Type</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="holiday_type" id="edit_holiday_type">
                        <option selected id="holiday_type"></option>
                        <option value="Legal">Legal Holiday</option>
                        <option value="Special Working">Special Working Holiday</option>
                        <option value="Special Non-Working">Special Non-Working Holiday</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control" id="edit_description" name="description">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_date" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="date" class="form-control" id="edit_date" name="date">
                      </div>
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
            	<form class="form-horizontal" method="POST" action="hschedule_delete.php">
            		<input type="hidden" id="del_timeid" name="id">
            		<div class="text-center">
	                	<p>DELETE SCHEDULE</p>
	                	<h2 id="del_schedule" class="bold"></h2>
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



     