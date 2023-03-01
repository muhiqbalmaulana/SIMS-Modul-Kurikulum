<!-- Content Header (Page header) -->
<section class="content-header">
                    <h1>
                        Data Tables
                        <small><? $a = $_POST['jur']; $nama_jur =implode(",",$a); echo $nama_jur;?></small>
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
                                    <table class="table table-condensed" style="border-collapse:collapse;">
                                        <thead>
                                            <tr>
												<th>Nis</th>
                                                <th>Nama</th>
                                                <th>Jenis_Kelamin</th>
                                                <th>Alamat</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											//-------------------------------------------
											require '../classdatabase.php';
											$classdatabaseku = new classdatabasenya();
											$classdatabaseku->koneksidatabase();
											//-------------------------------------------
										$query_jurusan = mysql_query("select jurusan.id from jurusan where nama LIKE '%%$nama_jur%%' AND jurusan.tahun_ajaran='$_SESSION[tahun_ajaran]' ORDER BY tahun_ajaran ASC;");
										//die('a');
									while ($row = mysql_fetch_array($query_jurusan))
									{			
										$rows	= $row['id'];											
										$query_kelas = mysql_query("SELECT * from kelas WHERE kelas.jurusan= $rows");										
										while ($id_kelas = mysql_fetch_array($query_kelas))
										{
											$kelas = $id_kelas['id'];
											$query_select = "select siswa.nis, siswa.nama, siswa.jenis_kelamin,siswa.alamat from kelas_siswa, siswa WHERE kelas_siswa.kelas= $kelas AND siswa.nis = kelas_siswa.nis;";
											$result = mysql_query($query_select) or die(mysql_error());
											$records = array();
											$data = array();
											while ($record =  mysql_fetch_assoc($result))
											{
												$records[] = $record;
											}
											foreach ($records as $data)
											{
										?>
                                            <tr data-toggle="collapse" data-target="#accordion" class="accordion-toggle">
												<td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
												<td><?php echo $data['nis']; ?></td>
                                                <td><?php echo $data['nama']; ?></td>
												<td><?php echo $data['jenis_kelamin']; ?></td>
												<td><?php echo $data['alamat']; ?></td>                                               
                                            </tr> 
											<tr>
												<td colspan="4" class="hiddenRow">
													<div id="accordion" class="accordion-body collapse">
														<table class="table table-striped">
															  <thead>																
																<tr>
																	<th>Access Key</th>
																	<th>Secret Key</th>
																	<th>Status </th>
																	<th> Created</th>
																	<th> Expires</th>
																	<th>Actions</th>
																</tr>
															  </thead>
															  <tbody>
																<tr>
																	<td>access-key-1</td>
																	<td>secretKey-1</td>
																	<td>Status</td>
																	<td>some date</td>
																	<td>some date</td>
																	<td><a href="#" class="btn btn-default btn-sm">
																	<i class="glyphicon glyphicon-cog"></i></a></td>
																</tr>															
															  </tbody>
														</table>				
													
													</div>
												</td>
											</tr>                                          
											<?php
											}
										}
									}
											?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>Nis</th>
                                                <th>Nama</th>
                                                <th>Jenis_Kelamin</th>
                                                <th>Alamat</th>                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data Table With Full Features</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Nis</th>
                                                <th>Nama</th>
                                                <th>Jenis_Kelamin</th>
                                                <th>Alamat</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											//-------------------------------------------
											//require '../classdatabase.php';
											//$classdatabaseku = new classdatabasenya();
											$classdatabaseku->koneksidatabase();
											//-------------------------------------------
										$query_jurusan = mysql_query("select jurusan.id from jurusan where nama LIKE '%%$nama_jur%%' AND jurusan.tahun_ajaran='$_SESSION[tahun_ajaran]' ORDER BY tahun_ajaran ASC;");
										die('a');
									while ($row = mysql_fetch_array($query_jurusan))
									{			
										$rows	= $row['id'];											
										$query_kelas = mysql_query("SELECT * from kelas WHERE kelas.jurusan= $rows");										
										while ($id_kelas = mysql_fetch_array($query_kelas))
										{
											$kelas = $id_kelas['id'];
											$query_select = "select siswa.nis, siswa.nama, siswa.jenis_kelamin,siswa.alamat from kelas_siswa, siswa WHERE kelas_siswa.kelas= $kelas AND siswa.nis = kelas_siswa.nis;";
											$result = mysql_query($query_select) or die(mysql_error());
											$records = array();
											$data = array();
											while ($record =  mysql_fetch_assoc($result))
											{
												$records[] = $record;
											}
											foreach ($records as $data)
											{
										?>
                                            <tr data-toggle="collapse" data-target="#accordion" class="accordion-toggle">
												<td><?php echo $data['nis']; ?></td>
                                                <td><?php echo $data['nama']; ?></td>
												<td><?php echo $data['jenis_kelamin']; ?></td>
												<td><?php echo $data['alamat']; ?></td>                                               
                                            </tr> 
											<tr>
												<td colspan="4" class="hiddenRow">
													<div id="accordion" class="accordion-body collapse">Hidden by default</div>
												</td>
											</tr>
											<?php
											}
										}
									}
											?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>Nis</th>
                                                <th>Nama</th>
                                                <th>Jenis_Kelamin</th>
                                                <th>Alamat</th>                                                
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