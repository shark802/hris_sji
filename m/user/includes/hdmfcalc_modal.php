<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>---&nbsp;&nbsp;<span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="hdmfcalc_edit.php">
            		<input type="hidden" class="loanid" name="id">
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Amount</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_amount" name="loan_amount" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="edit_obligation" class="col-sm-3 control-label">Obligation</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_obligation" name="obligation" readonly>
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="edit_balance" class="col-sm-3 control-label">Balance</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_balance" name="balance" readonly>
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