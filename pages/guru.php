<?php
	include('../koneksi.php');
	include('../models/load_models_1.php');	
	$result = mysql_query("		
				SELECT pelajaran_guru.nip ,guru.nama as nama_guru
				FROM pelajaran_guru, pelajaran, guru where pelajaran_guru.kode_pelajaran=pelajaran.id 
					AND pelajaran.semester %2='$_SESSION[smt]' AND pelajaran.tahun_ajaran='$_SESSION[tahun_ajaran]'
					AND guru.nip = pelajaran_guru.nip
					GROUP BY pelajaran_guru.nip ORDER BY pelajaran.kode_pelajaran; 
				");
?>
 <!-- Content Header (Page header) -->	
	<section class="content-header">
      <h1>
        Simple Tables
        <small>preview of simple tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Simple</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content"> 
    
          <div class="box">
		  
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div id="grpChkBox">
				<a><input type="checkbox" name="nip" /><span class="btn bg-olive btn-flat margin">Nip</span></a>
				<a><input type="checkbox" name="nama" /><span class="btn bg-olive btn-flat margin"> Name</span></a>
				<a><input type="checkbox" name="kdpel" /><span class="btn bg-olive btn-flat margin">Kode Pelajaran</span></a>
				<a><input type="checkbox" name="pel" /><span class="btn bg-olive btn-flat margin"> Pelajaran</span></a>
				<a><input type="checkbox" name="kelas" /><span class="btn bg-olive btn-flat margin"> Kelas</span></a>
				<a><input type="checkbox" name="tsp" /><span class="btn bg-olive btn-flat margin"> TS-P</span></a>
				<a><input type="checkbox" name="tsk" /> <span class="btn bg-olive btn-flat margin">TS-K</span></a>
				<a><input type="checkbox" name="asp" /><span class="btn bg-olive btn-flat margin"> AS-P</span></a>
				<a><input type="checkbox" name="ask" /> <span class="btn bg-olive btn-flat margin">AS-K</span></a>
			</div>
              <table id="example1" class="table table-condensed table-hover">
                <thead>
					<tr>
					  <th class="nip">NIP </th>
					  <th class="nama">Nama</th>
					  <th class="kdpel">Kode Mapel</th>
					  <th class="pel">Pelajaran</th>
					  <th class="kelas">Kelas</th>
					  <th class="tsp">TS-P</th>
					  <th class="tsk">TS-K</th>	
					  <th class="asp">AS-P</th>
					  <th class="ask">AS-K</th>			
					</tr>
				</thead>
                <tbody>
				 <?php
				while( $row = mysql_fetch_assoc( $result ) ){					
					
					$result_p = mysql_query("SELECT 
						pelajaran.kode_pelajaran, pelajaran.nama,pelajaran_guru.kode_pelajaran as id_pel, 
						pelajaran_guru.kelas, kelas.nama as nama_kelas,kelas.id as id_kelas
						FROM pelajaran_guru, pelajaran, kelas
						where pelajaran_guru.kode_pelajaran=pelajaran.id 
						AND pelajaran.semester %2='$_SESSION[smt]' AND pelajaran.tahun_ajaran='$_SESSION[tahun_ajaran]'
						AND kelas.id = pelajaran_guru.kelas
						AND pelajaran_guru.nip='$row[nip]'");
					$rowspan = mysql_num_rows($result_p); //echo$rowspan; //die();
					$records = array();
					$data = array();	
					
					?>	
					
					<tr>
					  <td rowspan="<?= $rowspan+1;?>" class="nip"><?= $row['nip'];?></td>
					  <td rowspan="<?= $rowspan+1;?>" class="nama"><?= $row['nama_guru'];?></td>				  
					</tr>
					
					<?php
					while ($kelas_pel = mysql_fetch_assoc($result_p))
					{
						$records[] = $kelas_pel;
					}
					foreach ($records as $data)
					{
					?>
					<tr>
						<td class="kdpel"><?= $data['kode_pelajaran'];?></td>
						<td class="pel"><?= $data['nama'];?></td>	
						<td class="kelas"><?= $data['nama_kelas'];?></td>	<!---id_kelas-->
						<?php
							//cek nilai per_siswa
							$id_pel = $data['id_pel'];
							$id_kelas = $data['id_kelas'];
							$query_nis = mysql_query("SELECT nis from kelas_siswa WHERE kelas_siswa.kelas ='$id_kelas' AND kelas_siswa.tahun_ajaran='$_SESSION[tahun_ajaran]' LIMIT 10,1;");
							$recordnis = array();
							$nis = array();
							$sumP ='';
							$sumK =''; 
							while ($nis_pel = mysql_fetch_assoc($query_nis))
							{
								$recordnis[] = $nis_pel;
							}
							//print_r($recordniss);
							foreach ($recordnis as $nis)
							{
							$nis = $nis['nis'];
							//$K_ts = TesN::getNilai_Optimun($nis, $id_pel ,'ts1');		
							$aa = new TesN ();
							$P_ts = $aa->getRataPelajaran($nis, $id_pel,'ts1');
							$K_ts = $aa->getNilai_Optimun($nis, $id_pel,'ts1');
							$P_as = $aa->getRataPelajaran($nis, $id_pel,'ts2');
							$K_as = $aa->getNilai_Optimun($nis, $id_pel,'ts2');
							//$P_as = TesN::getRataPelajaran($data['nis'], $data['id_pel'],'ts2');*/
							//$sumP += $P_ts;
							//$sumK += $K_ts; 
							
							}
						?>
						
						<td class="tsp"><?if($P_ts !='-'){?><span class="label label-success">Done</span><?}else{?><span class="label label-warning">Warning</span><?}?></td>
						<td class="tsk"><?if($K_ts !='-'){?><span class="label label-success">Done</span><?}else{?><span class="label label-warning">Warning</span><?}?></td>
						<td class="asp"><?if($P_as !='-'){?><span class="label label-success">Done</span><?}else{?><span class="label label-warning">Warning</span><?}?></td>
						<td class="ask"><?if($K_as !='-'){?><span class="label label-success">Done</span><?}else{?><span class="label label-warning">Warning</span><?}?></td>
					</tr>	
					<?php 
					}					
				}
				?>                
				</tbody>
                <tfoot>
				<tr>
                <th>NIP</th>
				<th>Nama</th>
				<th>Kode Mapel</th>
				<th>Pelajaran</th>
				<th>Status</th>	
                </tr>
				 </tfoot>
              </table>
			  <button>Reset</button>
            </div>
            <!-- /.box-body -->
          </div>       
    </section>
    <!-- /.content -->
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script>
  $(function () {
    $("#example2").DataTable();
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
 
$(document).ready(function() {
   
        $(function () {
            var $chk = $("#grpChkBox input:checkbox");
            var $tbl = $("#example1");

            $chk.prop('checked', true);

            $chk.click(function () {
                var colToHide = $tbl.find("." + $(this).attr("name"));
                $(colToHide).toggle();
            });
        });
   
} );
</script>