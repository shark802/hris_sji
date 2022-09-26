<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Tax</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="tax_add.php">
                  
                <div class="form-group">
                  	<label for="annual_income_from" class="col-sm-3 control-label">Annual Income Range</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="annual_income_from" name="annual_income_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="annual_income_to" name="annual_income_to" required>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="monthly_income_from" class="col-sm-3 control-label">Monthly Income Range</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="monthly_income_from" name="monthly_income_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="monthly_income_to" name="monthly_income_to" required>
                    </div>
                </div>
              
                <div class="form-group">
                  	<label for="base_tax" class="col-sm-3 control-label">Base Tax</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="base_tax" name="base_tax" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="excess_percentage" class="col-sm-3 control-label">Excess Percentage</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="excess_percentage" name="excess_percentage" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="excess_income" class="col-sm-3 control-label">Over</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="excess_income" name="excess_income" required>
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
              <form class="form-horizontal" method="POST" action="tax_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <div class="form-group">
                  	<label for="edit_annual_income_from" class="col-sm-3 control-label">Annual Income Range</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="edit_annual_income_from" name="annual_income_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="edit_annual_income_to" name="annual_income_to" required>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_monthly_income_from" class="col-sm-3 control-label">Monthly Income Range</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="edit_monthly_income_from" name="monthly_income_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="edit_monthly_income_to" name="monthly_income_to" required>
                    </div>
                </div>
              
                <div class="form-group">
                  	<label for="edit_base_tax" class="col-sm-3 control-label">Base Tax</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_base_tax" name="base_tax" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="edit_excess_percentage" class="col-sm-3 control-label">Excess Percentage</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_excess_percentage" name="excess_percentage" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="edit_excess_income" class="col-sm-3 control-label">Over</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_excess_income" name="excess_income" required>
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
            	<form class="form-horizontal" method="POST" action="tax_delete.php">
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





     