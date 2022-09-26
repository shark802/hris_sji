<!-- SSS Add -->
<div class="modal fade" id="sssTablenew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New SSS Table</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="sssTable_add.php">
                  
                <div class="form-group">
                  	<label for="range_from" class="col-sm-3 control-label">Range of Compensation</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="range_from" name="range_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="range_to" name="range_to" required>
                    </div>
                </div>
               
                <div class="form-group">
                  	<label for="monthly_salaryCredit" class="col-sm-3 control-label">Monthly Salary Credit</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="monthly_salaryCredit" name="monthly_salaryCredit" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="er" class="col-sm-3 control-label">ER</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="er" name="er" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="ee" class="col-sm-3 control-label">EE</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="ee" name="ee" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="ee" class="col-sm-3 control-label">EC</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="ec" name="ec" required>
                  	</div>
                </div> 
                <hr>
                <div class="form-group">
                  	<label class="col-sm-9 control-label">Self-Employed, Voluntary Member & Non-working Spouse</label>
                </div> 
                <div class="form-group">
                  	<label for="se_monthlyCredit" class="col-sm-3 control-label">Monthly Salary Credit</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="se_monthlyCredit" name="se_monthlyCredit" required>
                  	</div>
                </div> 

                <div class="form-group">
                  	<label for="se_ssContribution" class="col-sm-3 control-label">SS Contribution</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="se_ssContribution" name="se_ssContribution" required>
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

<!-- Pagibig Add -->
<div class="modal fade" id="pagibigTablenew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Pagibig Table</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="pagibigTable_add.php">
                  
                <div class="form-group">
                  	<label for="range_from" class="col-sm-3 control-label">Range of Compensation</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="range_from" name="range_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="range_to" name="range_to" required>
                    </div>
                </div>
               
                <div class="form-group">
                  	<label for="employerShare" class="col-sm-3 control-label">Employer Share (%)</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="employerShare" name="employerShare" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="employeeShare" class="col-sm-3 control-label">Employee Share (%)</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="employeeShare" name="employeeShare" required>
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

<!-- PH Add -->
<div class="modal fade" id="phTablenew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New PhilHealth Table</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="phTable_add.php">
                  
                <div class="form-group">
                  	<label for="range_from" class="col-sm-3 control-label">Range of Compensation</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="range_from" name="range_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="range_to" name="range_to" required>
                    </div>
                </div>
 
                <div class="form-group">
                  	<label for="employerShare" class="col-sm-3 control-label">Employer Share</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="employerShare" name="employerShare" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="employeeShare" class="col-sm-3 control-label">Employee Share</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="employeeShare" name="employeeShare" required>
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

<!-- SSS Edit -->
<div class="modal fade" id="editSSS">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit SSS Table</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="sss_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <div class="form-group">
                  	<label for="edit_range_from" class="col-sm-3 control-label">Range of Compensation</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="edit_range_from" name="range_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="edit_range_to" name="range_to" required>
                    </div>
                </div>
               
                <div class="form-group">
                  	<label for="monthly_salaryCredit" class="col-sm-3 control-label">Monthly Salary Credit</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_monthly_salaryCredit" name="monthly_salaryCredit" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="er" class="col-sm-3 control-label">ER</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_er" name="er" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="ee" class="col-sm-3 control-label">EE</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_ee" name="ee" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="ee" class="col-sm-3 control-label">EC</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_ec" name="ec" required>
                  	</div>
                </div> 
                <hr>
                <div class="form-group">
                  	<label class="col-sm-9 control-label">Self-Employed, Voluntary Member & Non-working Spouse</label>
                </div> 
                <div class="form-group">
                  	<label for="se_monthlyCredit" class="col-sm-3 control-label">Monthly Salary Credit</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_se_monthlyCredit" name="se_monthlyCredit" required>
                  	</div>
                </div> 

                <div class="form-group">
                  	<label for="se_ssContribution" class="col-sm-3 control-label">SS Contribution</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_se_ssContribution" name="se_ssContribution" required>
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

<!-- PagIbig Edit -->
<div class="modal fade" id="editPagibig">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Pag-ibig Table</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="pagibig_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <div class="form-group">
                  	<label for="edit_range_from" class="col-sm-3 control-label">Range of Compensation</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="editRange_from" name="range_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="editRange_to" name="range_to" required>
                    </div>
                </div>
               
                <div class="form-group">
                  	<label for="employerShare" class="col-sm-3 control-label">Employer Share (%)</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_employerShare" name="employerShare" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="employeeShare" class="col-sm-3 control-label">Employee Share (%)</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_employeeShare" name="employeeShare" required>
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

<!-- PH Edit -->
<div class="modal fade" id="editPh">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit PhilHealth Table</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="ph_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <div class="form-group">
                  	<label for="edit_range_from" class="col-sm-3 control-label">Range of Compensation</label>

                  	<div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="editPhRange_from" name="range_from" required>
                    </div>
                    <div class="col-sm-1">
                    	<b>to</b>
                    </div>
                    <div class="col-sm-3">
                    	<input type="number" step="0.01" class="form-control" id="editPhRange_to" name="range_to" required>
                    </div>
                </div>

                <div class="form-group">
                  	<label for="employerShare" class="col-sm-3 control-label">Employer Share</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_PhemployerShare" name="employerShare" required>
                  	</div>
                </div> 
                <div class="form-group">
                  	<label for="employeeShare" class="col-sm-3 control-label">Employee Share</label>

                  	<div class="col-sm-6">
                    	<input type="number" class="form-control" id="edit_PhemployeeShare" name="employeeShare" required>
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

<!-- SSS Delete -->
<div class="modal fade" id="deleteSSS">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="sss_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want delete this?</p></h2>
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

<!-- Pagibig Delete -->
<div class="modal fade" id="deletePagibig">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="pagibig_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want delete this?</p></h2>
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

<!-- Pagibig Delete -->
<div class="modal fade" id="deletePh">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="ph_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want delete this?</p></h2>
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





     