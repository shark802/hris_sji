<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Company</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="company_add.php">
                  
                <div class="form-group">
                  	<label for="company_name" class="col-sm-3 control-label">Name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="company_name" name="company_name" required>
                  	</div>
                </div>

                <div class="form-group">
                  	<label for="abbreviations" class="col-sm-3 control-label">Abbreviation</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="abbreviations" name="abbreviations" required>
                  	</div>
                </div>
                
                <div class="form-group">
                  	<label for="address" class="col-sm-3 control-label">Address</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="address" id="address"></textarea>
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
              <form class="form-horizontal" method="POST" action="company_edit.php">
                <input type="hidden" class="id" name="id">
                  <!-- Start -->
                  
             	<div class="form-group">
                    <label for="edit_company_name" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_company_name" name="company_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_abbreviations" class="col-sm-3 control-label">Abbreviation</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_abbreviations" name="abbreviations" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_address" name="address" required>
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
            	<form class="form-horizontal" method="POST" action="company_delete.php">
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

<!-- Check Now -->
<div class="modal fade" id="checkNow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Process Now ?</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="btn_add.php">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> No</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-check"></i> Yes</button>
              </form>
            </div>
        </div>
    </div>
</div>





     