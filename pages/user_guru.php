<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> 
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<!-- Content Header (Page header) -->
<section class="content-header">
                    <h1>
                        Data Tables
                        <small>User</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Tables</a></li>
                        <li class="active">Data tables</li>
                    </ol>
</section>

<!-- Main content -->
<?php
include('../koneksi.php');
$result = mysql_query("		
				SELECT a.nip, a.nama, a.alamat, a.telepon, a.superad, a.kurikulum FROM guru a; 
				");
$records = array();
$data = array();	
 while ($user = mysql_fetch_assoc($result))
		{
			$records[] = $user;
		}
?>
 <section class="content">
    <div class="row">
    <div class="col-xs-12">                                               
    <div class="box">
    <div class="box-header">
    <h3 class="box-title">Data User</h3>                                    
    </div><!-- /.box-header -->
		<div class="box-body table-responsive"> 
		  <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NIP</th>
                  <th>Name</th>                 
                  <th>Phone</th>
                  <th>Level</th>
                </tr>
                </thead>
                <tbody>
				<?php
                foreach ($records as $data)
					{
				?>
                <tr>
                  <td><?= $data['nip'];?></td>
                  <td><?= $data['nama'];?></td>                 
                  <td><?= $data['telepon']?></td>
                  <td>
					<div class="btn-group" >
					<?php if($data['superad']=='y' and $data['kurikulum']=='y') { ?>
					<button type="button" class="btn btn-success">SuP</button> <button type="button" class="btn btn-success">Ad</button><button type="button" class="btn btn-success">User</button>
					<?}elseif($data['superad']!='y' and $data['kurikulum']=='y'){?>
                    <button type="button" class="btn btn-danger">SuP</button> <button type="button" class="btn btn-success">Ad</button><button type="button" class="btn btn-success">User</button>
				  	<?}else{?></div>
					<button type="button" class="btn btn-danger">SuP</button> <button type="button" class="btn btn-danger">Ad</button><button type="button" class="btn btn-success">User</button>
					<?}?>
				</td>
                </tr>
				<?php 
					}
				?>
                </tbody>
                <tfoot>
                <tr>                
                  <th>NIP</th>
                  <th>Name</th>                 
                  <th>Phone</th>
                  <th>Level</th>                
                </tr>
                </tfoot>
              </table>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
 </div>
</div>
</section><!-- /.content -->

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

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
</script>