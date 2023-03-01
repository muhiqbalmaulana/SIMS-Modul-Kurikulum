<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
 <?php
include('../koneksi.php');
$result = mysql_query("		
				SELECT log_record.nip, guru.nama, log_record.lastlogin 
				FROM log_record, guru where log_record.nip = guru.nip
				AND DATE(log_record.lastlogin) = DATE(NOW()); 
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
		<div class="box-body table-responsive"> 
		  <table class="table table-bordered table-hover" style="border-collapse:collapse;">
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
                <tr data-toggle="collapse" data-target="#accordion<?= $data['nip'];?>" class="accordion-toggle">
                  <td><button data-skin="skin-green-light" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></button></td>
				  <td> <?= $data['nip'];?></td>
				  <td> <?= $data['nama'];?></td>
				  <td> <?= $data['lastlogin'];?></td>
				  <td>activities </td>
				  <td>Session Timeout </td>
                </tr>
				<tr>
				  <td colspan="4" class="hiddenRow">
					<div id="accordion<?= $data['nip']?>" class="accordion-body collapse">
					<table class="table table-hover table-striped" id="hiden">
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
							<tr><td>aaa</td></tr>
						</tbody>
					</table>
					</div>
				 </td>
				</tr>
				<?php 
					}
				?>
				</tbody>
              </table>
		</div>			
	</div><!-- /.box-body -->
	</div><!-- /.box -->
	</div>
</section><!-- /.content -->
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
$(function () {
    $("#example2").DataTable();
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
  
</script>