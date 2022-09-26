<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Generate Payroll</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="payroll_add.php">
                <div class="form-group">
                  	<label for="month" class="col-sm-4 control-label">Month</label>
                    
                  	<div class="col-sm-7">
                    	<?php echo'<input type="text" class="form-control" id="month" name="month" value='.date('F').' readonly>'; ?>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="payroll_period" class="col-sm-4 control-label">Payroll Period</label>

                    <div class="col-sm-7"> 
                      <select class="form-control" name="payroll_period" id="payroll_period" required>
                        <option value="" selected>- Select -</option>
                        <option value="1st">1 to 15</option>
                        <option value="2nd">16 to 30</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  	<label class="col-sm-8 control-label">Date Cover</label>
                </div>
                <div class="form-group">
                  	<label for="date_from" class="col-sm-4 control-label">From</label>

                  	<div class="col-sm-7">
                      <input type="date" class="form-control" name="date_from" id="date_from" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="date_to" class="col-sm-4 control-label">To</label>

                  	<div class="col-sm-7">
                      <input type="date" class="form-control" name="date_to" id="date_to" required>
                  	</div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Generate</button>
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
            	<form class="form-horizontal" method="POST" action="payroll_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want delete payroll?</p></h2>
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

<!-- Delete -->
<div class="modal fade" id="approve">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Approval</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="payroll_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want to confirm this payroll?</p></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> No</button>
            	<button type="submit" class="btn btn-success btn-flat" name="approve"><i class="fa fa-check"></i> Yes</button>
            	</form>
          	</div>
        </div>
    </div>
</div>





     