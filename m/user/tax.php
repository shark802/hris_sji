<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tax Table
      </h1>
       <ol class="breadcrumb">
           <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
           <li class="active">Deduction</li>
        <li class="active">Tax Table</li>
      </ol>                         
          </section>                       
<section class="content">
                        <center><h1> 2018 Philippines Tax Reform Law</h1></center>
                            


  
	<form action="" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table_striped" id="example">
		<div class="pull-right">
	    
	</div>
		<thead>
                    
		<tr>
			
                    <th><strong>Annual Income</strong></th>
                    <th><strong>Monthly Income</strong></th>
                    <th><strong>Semi-Monthly Income</strong></th>
                   
                    <th><strong>Tax Rate </strong></th>
                  
                 
                    

		</tr>
		</thead>
		<tbody>
		
		<tr>
        
            <td><strong>1. &nbsp;&nbsp;P 250,000 and below</strong></td>
            <td><strong> &nbsp;P 20,833 and below</strong></td>
            <td><strong> &nbsp;P 10,417 and below</strong></td>
            <td><strong> &nbsp;None (0%)</strong></td>

		</tr>
        <tr>
        
            <td><strong>2. &nbsp;&nbsp;> P 250,000 to P 400,000</strong></td>
            <td><strong> &nbsp;P 26,667  and below</strong></td>
            <td><strong> &nbsp;P 13, 333 and below</strong></td>
            <td><strong> &nbsp;20% of excess over P 250,000</strong></td>
		</tr>
        <tr>
        
            <td><strong>3. &nbsp;&nbsp;> P 400,000 to P 800,000</strong></td>
            <td><strong> &nbsp;P 47,500 and below</strong></td>
            <td><strong> &nbsp;P 23,750 and below</strong></td>
            <td><strong> &nbsp;P 30,000 + 25% of excess over P 400,000</strong></td>

		</tr>
            <tr>
        
            <td><strong>4. &nbsp;&nbsp;> P 800,000 to P 2,000,000</strong></td>
                <td><strong> &nbsp;P 105,833 and below</strong></td>
            <td><strong> &nbsp;P 52,917 and below</strong></td>
             <td><strong> &nbsp;P 130,000 + 30% of excess over P 800,000</strong></td>

		</tr>
            <tr>
        
            <td><strong>5. &nbsp;&nbsp;> P 2,000,000 to P 8,000,000</strong></td>
                <td><strong> &nbsp;P 254,167 and below</strong></td>
            <td><strong> &nbsp;P127,083 and below</strong></td>
             <td><strong> &nbsp;P 490,000 + 32% of excess over P 2,000,000</strong></td>

		</tr>
        <tr>
        
            <td><strong>6. &nbsp;&nbsp; Above 8,000,000  </strong></td>
            <td><strong> &nbsp;Above P 254,167 </strong></td>
            <td><strong> &nbsp;Above P127,083 </strong></td>
              <td><strong> &nbsp;P 2.41 million + 35% of excess over P 8 million</strong></td>

		</tr>
            
        
	
	
		</tbody>
	</table>
	</form>

            
                        <!-- /block -->
    </section>
                    </div>
                
     <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.employee_id').html(response.employee_id);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
      $('#gender_val').val(response.gender).html(response.gender);
      $('#position_val').val(response.position_id).html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
    }
  });
}
</script>
    </body>	
</html>