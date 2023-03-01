<!-- Content Header (Page header) -->
<?php
if(empty($_POST['rangkin_jur'])){
	$nama_jur='';
}else{
	$a = $_POST['rangkin_jur'];
	$nama_jur =implode(",",$a); 
}
function cmp_by_optionNumber($a, $b) {
  return $a["ratingjur"] - $b["ratingjur"];
}
include('../koneksi.php');
/* require '../models/standar_kompetensi.php';
require '../models/dasar_kompetensi.php';
require '../models/pelajaran.php';
require '../models/nilai.php'; */
//include('../models/load_models_dkn.php');	
//require_once '../models/load_models_dkn.php';
?>
<section class="content-header">
                    <h1>
                        Data Tables rangkin
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
                                            </tr> 
											<tr>
												<td colspan="4" class="hiddenRow">
													<div id="accordion<?= $data['id']?>" class="accordion-body collapse">
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
																 																	
																?>
															  <thead>																
																<tr>
																	<th>NIS</th>
																	<th>Nama</th>
																	<th>Ranking Kelas</th>
																	<th>Ranking Jurusan</th>
																	<th>&nbsp;</th>																	
																</tr>
															  </thead>
															  <tbody>
																<!--daftar siswanya -->
																<?php
																
																	$kelas = $data['id'];
																	$query_select = "SELECT siswa.nama as nama , siswa.nis as nis, raport.rank_jur as ratingjur,
																					raport.rank as rank_klas
																					FROM kelas_siswa, raport, siswa 
																					WHERE kelas_siswa.kelas = '$kelas' AND kelas_siswa.tahun_ajaran ='$_SESSION[tahun_ajaran]' 
																					AND raport.nis = kelas_siswa.nis AND raport.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND raport.tipe='as' AND siswa.nis = kelas_siswa.nis 
																					GROUP BY raport.nis ORDER BY ratingjur ASC;";										
																	
																	$result = mysql_query($query_select) or die(mysql_error()); 
																	$records_s = array();
																	$data_s = array();
																	while ($siswa = mysql_fetch_assoc($result))
																		{
																		 $records_s[] = $siswa;
																		}
																	usort($records_s, "cmp_by_optionNumber");
																	foreach ($records_s as $data_s)
																	{
																?>
																		<tr>
																			<td ><?= $data_s['nis'];?></td>
																			<td><?= $data_s['nama'];?></td>	
																			<td><?= $data_s['rank_klas'];?></td>
																			<td><?= $data_s['ratingjur'];?></td>
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
											}											
											$array_tingkat = array(X, XI, XII);
											foreach ($array_tingkat as $tingkat)
											{											
											?>
											<tr data-toggle="collapse" data-target="#accordion<?= $tingkat;?>" class="accordion-toggle">
												<td><button data-skin="skin-green-light" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></button></td>
												<td><?php echo"Paralel Tingkat "; echo $tingkat; ?></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>                                                                                              
                                            </tr> 
											<tr>
												<td colspan="4" class="hiddenRow">
													<div id="accordion<?= $tingkat; ?>" class="accordion-body collapse">
														<table class="table table-hover table-striped" id="hiden">
														<thead>																
															<tr>
																<th>NIS</th>
																<th>Nama</th>
																<th>Nilai Kelas</th>
																<th>Ranking Kelas</th>
																<th>Ranking Jurusan</th>
																<th>&nbsp;</th>																	
															</tr>
														</thead>
														<tbody>
														<?php
														$jurs	= $row['id'];											
														$query_tingkat = mysql_query("SELECT * from kelas WHERE kelas.jurusan= $jurs AND kelas.tingkat = '$tingkat';");	
														$siswa_tingkat = array();
														$data_siswa = array();	
														$siswa_all = array();
														while ($record =  mysql_fetch_assoc($query_tingkat))
														{
															$siswa_tingkat[] = $record;
														}
														foreach ($siswa_tingkat as $data_siswa)
														{
															//sum rating per_jurusan
															//$siswa_all = array();
															$nis_All = array();
															$siswa_tingkat = mysql_query("
																				SELECT kelas_siswa.nis as niskelas , siswa.nama as nama, raport.nilai_kelas as total, 
																				raport.total_jur as jumlahallsiswa, 
																				raport.rank as rankkelas, raport.rank_jur as ratingjur 
																				FROM kelas_siswa, raport, siswa
																				WHERE kelas_siswa.kelas = '$data_siswa[id]' AND kelas_siswa.tahun_ajaran = '$_SESSION[tahun_ajaran]' 
																				AND raport.nis = kelas_siswa.nis AND raport.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND raport.tipe='as' AND siswa.nis = kelas_siswa.nis
																				GROUP BY raport.nis;
																			");
																			//echo$siswa_tingkat; die();
															
															while ($record_all =  mysql_fetch_assoc($siswa_tingkat))
																{
																	$siswa_all[] = $record_all;
																}											
														 
														}
															/* function cmp_by_optionNumber($a, $b) {
															  return $a["ratingjur"] - $b["ratingjur"];
															}*/
															usort($siswa_all, "cmp_by_optionNumber"); 															
															foreach($siswa_all as $nis_All)
															{
														?>
															<tr>
															  <td><?= $nis_All['niskelas'];?></td>
															  <td><?= $nis_All['nama'];?></td>	
															  <td><?= $nis_All['total'];?></td>
															  <td><?= $nis_All['rankkelas'];?></td>
															  <td><?= $nis_All['ratingjur'];?></td>
															  <td>&nbsp;</td>
															</tr>
															<?php
															}
															?>
														</tbody>
														</table>													
													</div>
												</td>
											</tr>                  
											<?php
											}
											
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
                //$("#hiden").dataTable();
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
					"ordering": false,
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
</script>