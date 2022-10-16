<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Employee Record</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="record_add.php">
                  
              <div class="form-group">
                    <label for="employee_id" class="col-sm-3 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="employee_id" name="employee_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees";
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
                  	<label for="ss_num" class="col-sm-3 control-label">SS No.</label>

                  	<div class="col-sm-7">
                    	<input type="text" class="form-control" id="ss_num" name="ss_num" required>
                  	</div>
                </div>
                
                <div class="form-group">
                  	<label for="ph_num" class="col-sm-3 control-label">PhilHealth No.</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="ph_num" id="ph_num">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="hdmf_num" class="col-sm-3 control-label">Pagibig No.</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="hdmf_num" id="hdmf_num">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="tin_num" class="col-sm-3 control-label">TIN No.</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="tin_num" id="tin_num">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="start_date" class="col-sm-3 control-label">Start Date</label>

                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="status" name="status" required>
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
                    <label for="department_id" class="col-sm-3 control-label">Department</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="department_id" name="department_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM departments ORDER BY departments";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            $level = $row['level'];
                            if($level == 0){
                              $level = 'Admin/Staff';
                            } else  if($level == 6){
                              $level = 'Student Services';
                            } else  if($level == 7){
                              $level = 'Support Services';
                            }else if($level == 5){
                              $level = 'Preschool';
                            }
                            echo "
                              <option value='".$row['id']."'>".$row['departments'].' Level : ' .$level."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="position_id" class="col-sm-3 control-label">Position</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="position_id" name="position_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="schedule_id" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="schedule_id" name="schedule_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['time_in']." - ".$row['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
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
              <h4 class="modal-title"><b>Edit Employee Record Details</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="record_edit.php">
                <input type="hidden" class="id" name="id">
                <input type="hidden" class="mandatory_id" name="mandatory_id">
                  <!-- Start -->
                  
                  <div class="form-group">
                    <label for="edit_employee_id" class="col-sm-3 control-label">Employee Name</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_employee_id" name="employee_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM employees";
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
                  	<label for="edit_ss_num" class="col-sm-3 control-label">SS No.</label>

                  	<div class="col-sm-7">
                    	<input type="text" class="form-control" id="edit_ss_num" name="ss_num" required>
                  	</div>
                </div>
                
                <div class="form-group">
                  	<label for="edit_ph_num" class="col-sm-3 control-label">PhilHealth No.</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="ph_num" id="edit_ph_num">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_hdmf_num" class="col-sm-3 control-label">Pagibig No.</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="hdmf_num" id="edit_hdmf_num">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_tin_num" class="col-sm-3 control-label">TIN No.</label>

                  	<div class="col-sm-7">
                      <input class="form-control" name="tin_num" id="edit_tin_num">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="edit_start_date" class="col-sm-3 control-label">Start Date</label>

                    <div class="col-sm-7">
                      <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_status" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_status" name="status" required>
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
                    <label for="edit_department_id" class="col-sm-3 control-label">Department</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_department_id" name="department_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                           $sql = "SELECT * FROM departments ORDER BY departments";
                           $query = $conn->query($sql);
                           while($row = $query->fetch_assoc()){
                            $level = $row['level'];
                            if($level == 0){
                              $level = 'Admin/Staff';
                            } else  if($level == 6){
                              $level = 'Student Services';
                            } else  if($level == 7){
                              $level = 'Support Services';
                            }else if($level == 5){
                              $level = 'Preschool';
                            }
                             echo "
                               <option value='".$row['id']."'>".$row['departments'].' Level : ' .$level."</option>
                             ";
                           }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_position_id" class="col-sm-3 control-label">Position</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_position_id" name="position_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_schedule_id" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-7">
                      <select class="form-control" id="edit_schedule_id" name="schedule_id" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($row = $query->fetch_assoc()){
                            echo "
                              <option value='".$row['id']."'>".$row['time_in']." - ".$row['time_out']."</option>
                            ";
                          }
                        ?>
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
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="record_delete.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	
	                	<h2 id="del_deduction" class="bold"><p>You want delete this record?</p></h2>
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





     