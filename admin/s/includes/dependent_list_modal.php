<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Employee Dependent</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="dependent_add.php">
                  
              <div class="form-group">
                    <label for="employee_id" class="col-sm-4 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="employee_id" name="employee_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees WHERE account_info = 'Active' ORDER BY lastname";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['lastname'].' - '.$row['firstname']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>

                <div class="form-group">
                  	<label for="dependent_name" class="col-sm-4 control-label">Dependent Name</label>

                  	<div class="col-sm-7">
                    	<input type="text" class="form-control" id="dependent_name" name="dependent_name" required>
                  	</div>
                </div>

                <div class="form-group">
                  	<label for="amount" class="col-sm-4 control-label">Deduction Amount</label>

                  	<div class="col-sm-7">
                    	<input type="text" class="form-control" id="amount" name="amount" required>
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
              <h4 class="modal-title"><b>Edit Company Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="dependent_list_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
                  <div class="form-group">
                    <label for="edit_employee_id" class="col-sm-4 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_employee_id" name="employee_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees ORDER BY lastname";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['lastname'].' - '.$row['firstname']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>

                <div class="form-group">
                  	<label for="edit_dependent_name" class="col-sm-4 control-label">Dependent Name</label>

                  	<div class="col-sm-7">
                    	<input type="text" class="form-control" id="edit_dependent_name" name="dependent_name" required>
                  	</div>
                </div>

                <div class="form-group">
                  	<label for="edit_amount" class="col-sm-4 control-label">Deduction Amount</label>

                  	<div class="col-sm-7">
                    	<input type="text" class="form-control" id="edit_amount" name="amount" required>
                  	</div>
                </div>

                <div class="form-group">
                    <label for="edit_status" class="col-sm-4 control-label">Status</label>

                    <div class="col-sm-7"> 
                      <select class="form-control" name="status" id="edit_status" required>
                        <option value="" selected>- Select -</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
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
            	<form class="form-horizontal" method="POST" action="dependent_list_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want delete this company?</p></h2>
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





     