<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Loan</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="loans_add.php">
          		  <div class="form-group">
                    <label for="employee_id" class="col-sm-4 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="employee_id" name="employee_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees WHERE account_info = 'Active' ORDER by lastname";
                          $query = $conn->query($sql);
                          while($erow = $query->fetch_assoc()){
                            echo "
                              <option value='".$erow['id']."'>".$erow['lastname'].' - '.$erow['firstname']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="loan_type" class="col-sm-4 control-label">Loan Type</label>
                    <?php 
                      $loan_type_id = $_GET['id'];
                      $sql = "SELECT * FROM loan_type WHERE id = '$loan_type_id'";
                      $query = $conn->query($sql);
                      $row = $query->fetch_assoc();
                      $loan_type = $row['loan_type'];
                      echo '
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="'.$loan_type.'" readonly>
                          <input type="hidden" class="form-control" id="loan_type" name="loan_type" value="'.$loan_type_id.'" readonly>
                        </div>
                      ';
                    ?>       
                   
                </div>
                <div class="form-group">
                    <label for="date_loan" class="col-sm-4 control-label">Loan Date</label>

                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="date_loan" name="date_loan" required>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="loan_amount" class="col-sm-4 control-label">Loan Amount</label>

                    <div class="col-sm-7">
                      <input type="number" step="0.01" class="form-control" id="loan_amount" name="loan_amount" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="payment_term" class="col-sm-4 control-label">Payment Term (months)</label>

                    <div class="col-sm-7">
                      <input type="number" class="form-control" id="payment_term" name="payment_term" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="obligation" class="col-sm-4 control-label">Obligation</label>

                    <div class="col-sm-7">
                      <input type="text" step="0.01" class="form-control"  id="obligation" name="obligation" required>
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
            	<h4 class="modal-title"><b><span class="date"></span> Edit Loan Details <span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="loans_edit.php">
            		<input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="edit_employee_id" class="col-sm-4 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_employee_id" name="employee_id" disabled>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees";
                          $query = $conn->query($sql);
                          while($erow = $query->fetch_assoc()){
                            echo "
                              <option value='".$erow['id']."'>".$erow['lastname'].' - '.$erow['firstname']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_loan_type" class="col-sm-4 control-label">Loan Type</label>
                    <?php 
                      $loan_type_id = $_GET['id'];
                      $sql = "SELECT * FROM loan_type WHERE id = '$loan_type_id'";
                      $query = $conn->query($sql);
                      $row = $query->fetch_assoc();
                      $loan_type = $row['loan_type'];
                      echo '
                        <div class="col-sm-7">
                          <input type="text" class="form-control" value="'.$loan_type.'" readonly>
                          <input type="hidden" class="form-control" id="edit_loan_type" name="loan_type" value="'.$loan_type_id.'" readonly>
                        </div>
                      ';
                    ?>       
                   
                </div>
                <div class="form-group">
                    <label for="edit_date_loan" class="col-sm-4 control-label">Loan Date</label>

                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="edit_date_loan" name="date_loan" required>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="edit_loan_amount" class="col-sm-4 control-label">Loan Amount</label>

                    <div class="col-sm-7">
                      <input type="number" class="form-control" id="edit_loan_amount" name="loan_amount" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_payment_term" class="col-sm-4 control-label">Payment Term (months)</label>

                    <div class="col-sm-7">
                      <input type="number" class="form-control" id="edit_payment_term" name="payment_term" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_balance" class="col-sm-4 control-label">Balance</label>

                    <div class="col-sm-7">
                      <input type="number" class="form-control" id="edit_balance" name="balance" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_obligation" class="col-sm-4 control-label">Obligation</label>

                    <div class="col-sm-7">
                      <input type="number" class="form-control" id="edit_obligation" name="obligation" required>
                    </div>
                </div>
              
                <div class="form-group">
                    <label for="edit_status" class="col-sm-4 control-label">Status</label>

                    <div class="col-sm-7"> 
                      <select class="form-control" name="status" id="edit_status" required>
                        <option value="" selected>- Select -</option>
                        <option value="Active">Active Paying</option>
                        <option value="Paid">Paid</option>
                      </select>
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
            	<h4 class="modal-title"><b><span class="date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="loans_delete.php">
            		<input type="hidden" class="id" name="id">

            		<div class="text-center">
	                	
	                	<h3><p>Delete this loan record?</p></h3>
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


     