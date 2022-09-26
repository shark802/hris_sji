<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Fee</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="fee_add.php">
                  
                <div class="form-group">
                  	<label for="fee" class="col-sm-3 control-label">Additional Fee</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="fee" name="fee" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="status" id="status" required>
                        <option value="" selected>- Select -</option>
                        <option value="Fixed">Fixed</option>
                        <option value="UserDefine">User Define</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="amount" class="col-sm-3 control-label">Amount</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="amount" name="amount">
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
              <h4 class="modal-title"><b>Edit Benefit Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="fee_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <div class="form-group">
                  	<label for="edit_fee" class="col-sm-3 control-label">Additional Fee</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_fee" name="fee" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="edit_status" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="status" id="edit_status" required>
                        <option value="" selected>- Select -</option>
                        <option value="Fixed">Fixed</option>
                        <option value="UserDefine">User Define</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_amount" class="col-sm-3 control-label">Amount</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_amount" name="amount">
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
            	<form class="form-horizontal" method="POST" action="fee_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want delete this fee?</p></h2>
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





     