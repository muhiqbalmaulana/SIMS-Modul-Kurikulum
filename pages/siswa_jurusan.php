<!-- Content Header (Page header) -->
<?php
if(empty($_POST['jur'])){
	$nama_jur='';
}else{
	$a = $_POST['jur'];
	$nama_jur =implode(",",$a); 
}
include('../koneksi.php');
require '../models/standar_kompetensi.php';
require '../models/dasar_kompetensi.php';
require '../models/pelajaran.php';
require '../models/nilai.php';
//include('../models/load_models_dkn.php');	
//require_once '../models/load_models_dkn.php';
?>
<section class="content-header">
                    <h1>
                        Data Tables
                        <small><?= $nama_jur;?></small>
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
                                    <table class="table table-condensed table-hover" style="border-collapse:collapse;">
                                        <thead>
                                            <tr>
												<th>&nbsp;</th>
												<th>Nama Kelas</th>
                                                <th>Tingkat</th>
                                                <th>Wali Kelas Ganjil</th> 
												<th>Wali Kelas Genap</th>
												<th>Download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											//-------------------------------------------
											require '../classdatabase.php';
											$classdatabaseku = new classdatabasenya();
											$classdatabaseku->koneksidatabase();												
											//-------------------------------------------
										$query_jurusan = mysql_query("select jurusan.id from jurusan where nama ='$nama_jur' AND jurusan.tahun_ajaran='$_SESSION[tahun_ajaran]' ORDER BY tahun_ajaran ASC;");
										//echo $query_jurusan; die('a');
									while ($row = mysql_fetch_array($query_jurusan))
									{			
										$rows	= $row['id'];											
										$query_kelas = mysql_query("SELECT * from kelas WHERE kelas.jurusan= $rows");	
										$records = array();
										$data = array();
										$id_dwl = 1;
											while ($record =  mysql_fetch_assoc($query_kelas))
											{
												$records[] = $record;
											}
											foreach ($records as $data)
											{
										?>
                                            <tr data-toggle="collapse" data-target="#accordion<?= $data['id'];?>" class="accordion-toggle">
												<td><button data-skin="skin-green-light" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></button></td>
												<td><?php echo $data['nama']; ?></td>
                                                <td><?php echo $data['tingkat']; ?></td>
												<td><?php echo $data['wali_kelas_ganjil']; ?></td>
												<td><?php echo $data['wali_kelas_genap']; ?></td> 
												<td><a href="#" id="downloadLink<?= $id_dwl;?>" onClick="reply_click(this.id)" class="btn btn-default btn-sm">
													<i class="glyphicon glyphicon-cog"></i></a></td>
                                            
                                            </tr> 
											<tr>
												<td colspan="4" class="hiddenRow">
													<div id="accordion<?= $data['id']?>" class="accordion-body collapse">
													<div id="dwld<?= $id_dwl;?>">
													<table class="table table-hover table-striped" id="hiden">
															   <?
																$semester = $_SESSION['smt'];
																if($data['tingkat'] == 'X'and $semester=='1'){
																	$smt = '1';
																}elseif($data['tingkat'] == 'X'and $semester=='0'){
																	$smt = '2';
																}elseif($data['tingkat'] == 'XI'and $semester=='1'){
																	$smt= '3';
																}elseif($data['tingkat'] == 'XI'and $semester=='0'){
																	$smt='4';
																}elseif($data['tingkat'] == 'XII'and $semester=='1'){
																	$smt= '5';
																}elseif($data['tingkat'] == 'XII'and $semester=='0'){
																	$smt = '6';
																}else{}
																//require '../models/pelajaran.php';
																//$pelajaran = new Pelajaran();
																//$pelajaran->getPerKelas($data['id'], $smt, $_SESSION['tahun_ajaran']);
																 $query = sprintf("select
																					a.id,
																					a.kode_pelajaran as kode,
																					a.nama,
																					c.nama as tipe
																				  from
																					pelajaran a,
																					pel_siswa b,
																					tipe_pelajaran c,
																					kelas_siswa d
																				  where
																					d.kelas = %d and
																					a.tipe = c.id and
																					a.id = b.pelajaran and
																					b.semester = %d and
																					b.tahun_ajaran = %d and
																					b.nis = d.nis
																				  group by a.id
																				  order by a.tipe,a.urutan asc", $data['id'], $smt, $_SESSION['tahun_ajaran']
																			); 
																			$exe = mysql_query($query);
																			$mata_pel=array();
																			$pel= array();
																	while ($rec = mysql_fetch_assoc($exe)) {
																		 $query = sprintf("select 
																								b.nama,
																								b.nip 
																							  from 
																								pelajaran_guru a,
																								guru b 
																							  where 
																								a.kode_pelajaran=%d and 
																								kelas=%d and 
																								a.nip=b.nip", $rec['id'], $data['id']);
																			$exe1 = mysql_query($query);
																			$rows_g=array();
																			//$rec[guru]=array();
																			while ($row1 = mysql_fetch_assoc($exe1)){
																				$rows_g[] = $row1;
																			}
																	
																		$rec['guru'] = $rows_g;
																		
																		/* $rec[sk] = StandarKompetensi::getAllData($rec[id]);
																		for ($i = 0; $i < count($rec[sk]); $i++) {
																			$kd = KompetensiDasar::cekKDnull($rec[sk][$i][id]);
																			if ($kd === false)
																				$rec[sk][$i][kd] = KompetensiDasar::getDataAll($rec[sk][$i][id]);
																		} */
																		$mata_pel[] = $rec;
																	}
																	//print_r($mata_pel);
																?>
															  <thead>																
																<tr id="myTooltips">
																	<th>NIS</th>
																	<th>Nama</th>
																	<?php
																	$i=1;
																	foreach ($mata_pel as $pel){
																	echo '<th data-toggle="tooltip" title="'.$pel['nama'].' Guru '.$pel['guru'][0]['nama'].'";align="center" valign="middle">' . $pel['kode'] .'<input id="chk1" type="checkbox" /></th>';	
																	$i++;
																	}
																	?>
																	<th>&nbsp;</th>																	
																</tr>
															  </thead>
															  <tbody>
																<!--daftar siswanya -->
																<?php
																
																	$kelas = $data['id'];
																	$query_select = "select siswa.nis, siswa.nama, siswa.jenis_kelamin,siswa.alamat from kelas_siswa, siswa WHERE kelas_siswa.kelas= $kelas AND siswa.nis = kelas_siswa.nis;";
																	$result = mysql_query($query_select) or die(mysql_error()); 
																	$records_s = array();
																	$data_s = array();
																	while ($siswa = mysql_fetch_assoc($result))
																		{
																		 $records_s[] = $siswa;
																		}
																		
																	foreach ($records_s as $data_s)
																	{
																?>
																		<tr>
																			<td ><?= $data_s['nis'];?></td>
																			<td><?= $data_s['nama'];?></td>	
																			<?php
																			foreach ($mata_pel as $pel){
																			$hit_nilai = new Nilai ();
																			$P = $hit_nilai->getRataPelajaran($data_s['nis'], $pel['id'],$tipe='%');
																			$K = $hit_nilai->getNilai_Optimun($data_s['nis'], $pel['id'],$tipe='%');//getNilaiAkhir																	
																			
																			
																			echo '<td align="center" valign="middle">' . $P.'#'.$K.'</td>';	
																			}
																			?>
																			<td><a href="#" class="btn btn-default btn-sm">
																			<i class="glyphicon glyphicon-cog"></i></a></td>
																		</tr>	
																<?php }	?>																	
															  </tbody>
														</table>				
													
													</div>
												</td>
											</tr>                                          
											<?php
											$id_dwl++;
											}
										//}
									}
											?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>&nbsp;</th>
												<th>Nama Kelas</th>
                                                <th>Tingkat</th>
                                                <th>Wali Kelas Ganjil</th> 
												<th>Wali Kelas Genap</th>
												<th>Download</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->						
                        </div>
                    </div>
                </section><!-- /.content -->
				
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<!--script>$("#example1").dataTable({ "bSort": false });</script-->
<script type="text/javascript">            
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": true,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true
                });					
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#myTooltips a").tooltip({
        title: 'It works in absence of title attribute.'
    });	
});

 $(function() {
    $("#hiden input[type=checkbox]").on("change", function(e) {
        var id = $(this).parent().index()+1,
            col = $("table tr th:nth-child("+id+"), table tr td:nth-child("+id+")");
        $(this).is(":checked") ? col.show() : col.hide();
    }).prop("checked", true).change();
    
    $("button").on("click", function(e) {
        $("input[type=checkbox]").prop("checked", true).change();
    });
});


function reply_click(clicked_id)
{
    /* alert(clicked_id);*/
	if(clicked_id == 'downloadLink1') {
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld1');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink2'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld2');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		e.preventDefault();
		//});

	} else if (clicked_id == 'downloadLink3'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld3');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink4'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld4');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink5'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld5');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink6'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld6');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink7'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld7');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink8'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld8');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink9'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld9');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink10'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld10');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink11'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld11');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink12'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld12');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink13'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld13');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink14'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld14');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink15'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld15');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	} else if (clicked_id == 'downloadLink16'){
		//$("#downloadLink2").click(function(e) {	
		var a = document.createElement('a');
		//getting data from our div that contains the HTML table
		var data_type = 'data:application/vnd.ms-excel';
		var table_div = document.getElementById('dwld16');
		var table_html = table_div.outerHTML.replace(/ /g, '%20');
		a.href = data_type + ', ' + table_html;
		//setting the file name
		a.download = 'download.xls';
		//triggering the function
		a.click();
		//just in case, prevent default behaviour
		//e.preventDefault();
		//});
	}
	
}
</script>