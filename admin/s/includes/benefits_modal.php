<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Benefits</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="benefits_add.php">
                  
                   		  <div class="form-group">
                  	<label for="deduction" class="col-sm-3 control-label">Deductions</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="deduction" name="deduction" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="scheme" class="col-sm-3 control-label">Scheme</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="scheme" id="scheme" required>
                        <option value="" selected>- Select -</option>
                        <option value="Fixed">Fixed</option>
                        <option value="Percentage">Percentage</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="amount" class="col-sm-3 control-label">Amount</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="amount" id="amount"></textarea>
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
              <form class="form-horizontal" method="POST" action="benefits_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
             	<div class="form-group">
                    <label for="edit_deduction" class="col-sm-3 control-label">Deduction</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_deduction" name="deduction" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_scheme" class="col-sm-3 control-label">Scheme</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="scheme" id="edit_scheme" required>
                        <option value="" selected>- Select -</option>
                        <option value="Fixed">Fixed</option>
                        <option value="Percentage">Percentage</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Amount</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_amount" name="amount">
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
            	<form class="form-horizontal" method="POST" action="benefits_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want delete benefit?</p></h2>
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





     