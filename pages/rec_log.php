<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> 
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css"> 
<!-- daterange picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <?php
include('../koneksi.php');
$result = mysql_query("		
				SELECT log_record.id_record,log_record.nip, guru.nama, log_record.lastlogin, log_record.session_off 
				FROM log_record, guru where log_record.nip = guru.nip
				AND DATE(log_record.lastlogin) = DATE(NOW()) ORDER BY id_record DESC; 
				");
$records = array();
$data = array();	
 while ($log_user = mysql_fetch_assoc($result))
		{
			$records[] = $log_user;
		}
 ?>
<!-- Content Header (Page header) -->
<section class="content-header">
                    <h1>
                        Data Tables
                        <small>advanced tables</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
</section>

<!-- Main content -->
 <section class="content">
    <div class="row">
    <div class="col-xs-12">                                               
    <div class="box">
    <div class="box-header">
    <h3 class="box-title">Data Table With Full Features</h3>                                    
    </div><!-- /.box-header -->
	
	  <div class="form-group">
        <label>Date:</label>
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right" id="tanggal">
        
		</div>
		<div class="form-group"> <!-- Submit button -->
       
      </div>
           <!-- /.input group -->
      </div>
		<div class="box-body table-responsive"> 
		  <table class="table table-condensed table-hover" style="border-collapse:collapse;">
                <thead>				
				<tr>
				  <th>&nbsp;</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Last Login</th>
                  <th>Activities</th>
                  <th>Session Timeout</th>
                </tr>				
                </thead>
                <tbody>
				<?php
                foreach ($records as $data)
					{
				?>
                <tr data-toggle="collapse" data-target="#accordion<?= $data['id_record'];?>" class="accordion-toggle">
                  <td><button data-skin="skin-green-light" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></button></td>
				  <td> <?= $data['nip'];?></td>
				  <td> <?= $data['nama'];?></td>
				  <td> <?= $data['lastlogin'];?></td>
				  <td> <? if(!isset($data['session_off'])){?><span class="label label-success">Active</span><? }else{?> <span class="label label-danger">Denied</span><?}?></td>
				  <td> <?= $data['session_off'];?> </td>
                </tr>
				<tr>
					<td <td colspan="4" class="hiddenRow">
						<div id="accordion<?= $data['id_record']?>" class="accordion-body collapse">
							
							<div class="box-body no-padding">
							  <table class="table table-hover table-striped" id="hiden">
								<tr>
								  <th style="width: 10px">#</th>
								  <th>Task</th>
								  <th>Progress</th>
								  <th style="width: 40px">Label</th>
								</tr>
								<tr>
								  <td>1.</td>
								  <td>Update prosess</td>
								  <td>
									<div class="progress progress-xs progress-striped active">
									  <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
									</div>
								  </td>
								  <td><span class="badge bg-red">55%</span></td>
								</tr>
								<tr>
								  <td>2.</td>
								  <td>Insert prosess</td>
								  <td>
									<div class="progress progress-xs progress-striped active">
									  <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
									</div>
								  </td>
								  <td><span class="badge bg-yellow">70%</span></td>
								</tr>
								<tr>
								  <td>3.</td>
								  <td>Delete prosess</td>
								  <td>
									<div class="progress progress-xs progress-striped active">
									  <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
									</div>
								  </td>
								  <td><span class="badge bg-light-blue">30%</span></td>
								</tr>								
							  </table>
							</div>
							<!-- /.box-body -->							
						</div>
					</td>
				</tr>
				<?php 
					}
				?>
                
          </table>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
 </div>
</div>
</section><!-- /.content -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
$(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
 $('#tanggal').datepicker({
      autoclose: true
    });

    $(document).ready(function() {
    $('#tanggal').datepicker({
        onchange:function(dateText,instance){
            alert(dateText); //Latest selected date will give the alert.
            $.post("test.php", {
            date:dateText // now you will get the selected date to `date` in your post
            },
            function(data){$('#testdiv').html('');$('#testdiv').html(data);
            });
        }
    });
});

</script>