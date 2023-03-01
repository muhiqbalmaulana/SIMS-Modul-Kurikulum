<?php
	session_start();
	require_once '../models/modelByCippo.php';
	include('../koneksi.php');

	$pelajaran = $_POST['pelajaran'];
	$jurusan = $_POST['jurusan'];
	$semester = $_POST['semester'];
	$tahun = $_SESSION['tahun_ajaran'];

	$offsetnya = $_POST['offsetnya'];
	$maksimal_row = $_POST['maksimal_row'];	
	$halaman_saat_ini = $_POST['halaman_saat_ini'];

	// $nama_pelajaran = $_POST['nama_pelajaran'];

	$query = "SELECT a.nis, b.nama, c.nama AS nama_jurusan, a.na_p, a.na_k ".
	"FROM generate_chart a, pelajaran b, jurusan c ".
	"WHERE ".
	"a.kode_pelajaran = $pelajaran AND a.jurusan = $jurusan ".
	"AND a.semester = $semester AND a.tahun_ajaran = $tahun ".
	"AND a.kode_pelajaran = b.id AND a.jurusan = c.id ".
	"ORDER BY a.nis ".
	"limit $offsetnya,$maksimal_row";
	
	// echo "<br><br>". $query."<br><br>";

	$mysqlquery = mysql_query($query);
	if ( $mysqlquery ) {
		while($ambilhasil=mysql_fetch_array($mysqlquery)){
			$arrayhasil[] = $ambilhasil;
		}

		if( is_array($arrayhasil) and count($arrayhasil)>0) {
			/* tampilkan hasil */
			$no=0;
			?>


			<style type="text/css">
				#tabel_header th, #tabel_header td {
					border: none;
				}
				
				.namakolom {
					width: 150px;
					text-align: right;
				}
				
				.titik2 {
					width: 5px;
				}
				
				.isikolom {
					width: 200px;
				}

				.nomor_siswa {
					width: 50px;
				}

				.nis_siswa {
					width: 200px;
				}


			</style>

			<!-- <br> < ? = $query ? > <br> -->
			<table id="tabel_header" class="table ">
				<tr>
					<th class="namakolom">Mata Pelajaran</th>
					<th class="titik2">:</th>
					<th class="isikolom"><?= $arrayhasil[0]['nama']; ?></th>
					
					<th></th>

					<th class="namakolom">Semester</th>
					<th class="titik2">:</th>
					<th class="isikolom"><?= $semester; ?></th>
				</tr>

				<tr>
					<th class="namakolom">Jurusan</th>
					<th>:</th>
					<th><?= $arrayhasil[0]['nama_jurusan']; ?></th>

					<th></th>

					<th class="namakolom">Records Per Page</th>
					<th>:</th>
					<th>
						<input 
						id="idperpage" style="width: 50px;" type="text" 
						class="hanya-angka" value="<?=$maksimal_row;?>" />
					</th>
				</tr>
			</table>

			<table id="tabel_siswa" class="table">
			 	<tr>
			 		<th class="nomor_siswa">#</th>
			 		<th class="nis_siswa">NIS</th>
			 		<th class="">Nilai Pengetahuan</th>
			 		<th class="">Nilai Ketrampilan</th>
			 	</tr>
			 	<?php
			 	foreach ($arrayhasil as $key => $value) {
					$no++;
					$offsetnya++;
					$nis = $value['nis'];
					$na_p = $value['na_p'];
					$na_k = $value['na_k'];
					$kode_pelajaran = $value['kode_pelajaran'];
					$jurusan = $value['jurusan'];
					$semester = $value['semester'];
					$tahun_ajaran = $value['tahun_ajaran'];
					$kelas = $value['kelas'];
					?>

				 	<tr>
				 		<td><?=$offsetnya;?></td>
				 		<td><?=$nis;?></td>
				 		<td><?=$na_p;?></td>
				 		<td><?=$na_k;?></td>
				 	</tr>

					<?php
				}
				?>
			</table>	
			<script type="text/javascript">
				$(".hanya-angka").keypress(function (e) {
			        //if the letter is not digit then display error and don't type anything
			        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			            return false;
			        }
			    });

			    $("#idperpage").keypress(
			        function( event ) {
			            if (event.which == 13) {
			            	if( $("#input_id_input_halaman").val()==0 || $("#input_id_input_halaman").val()==""){
			            		$("#input_id_input_halaman").val(1);
			            	} 

			            	//pindahkan dulu nilainya
			            	$("#input_maksimal_baris").val( $("#idperpage").val() );

			            	//todo: klik tombol submit
			            	$("#input_maksimal_baris").click();
			            }
			        }    
			    );    
			</script>
			<?php
		}
		else {
			echo "pesan2";
		}	
	}
	else {
		echo "pesan1";
	}
?>
