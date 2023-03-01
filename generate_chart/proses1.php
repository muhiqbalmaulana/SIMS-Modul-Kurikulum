<?php
	session_start();

	/*require_once '../models/nilai.php';
	require_once '../models/modelByCippo.php';*/	

	include('../models/load_models.php');
	include('../koneksi.php');

	$pelajaran = $_POST['pelajaran'];
	$jurusan = $_POST['jurusan'];
	$semester = $_POST['semester'];
	$tahun = $_SESSION['tahun_ajaran'];

	if($pelajaran=="Pelajaran"){
		die("pesan0006");
	}

	if ($semester == 1 or $semester == 2) {
		$tingkat = "X";	
	} elseif ($semester == 3 or $semester == 4) {
		$tingkat = "XI";
	} elseif ($semester == 5 or $semester == 6) {
		$tingkat = "XII";
	}else {
		$tingkat = "semester";
	}

	/*echo "semester = ".$semester.", jurusan = $jurusan, tingkat = $tingkat, ".
	"pelajaran = $pelajaran, tahunAjaran = $tahun";
	echo "<br><br>";*/

	$query = "SELECT 
	c.nama as jurusan, a.id, a.nama, a.tingkat, b.nis, 
	a.id as id_kelas, a.nama AS nama_kelas 
	FROM 
	jurusan c, kelas a, kelas_siswa b 
	WHERE 
	c.id = a.jurusan AND a.id=b.kelas and a.jurusan = $jurusan AND a.tingkat = '$tingkat' 
	ORDER BY a.tingkat, a.id, b.nis ASC";
	
	$jumlahrow=0;
    $proses_query = mysql_query($query);

    if ( $proses_query ) {

		while($get_n=mysql_fetch_array($proses_query)){
			$jumlahrow++;
			$data_siswa[] = $get_n;
		}

		if(is_array($data_siswa)) {
			//
			if($jumlahrow>0){
				$nis=$data_siswa[0]['nis'];
				
				/*mulai cek mapel, sesuai atau tidak */
				$query02 = "SELECT a.nis 
				FROM pel_siswa a 
				WHERE a.pelajaran=$pelajaran AND a.nis = '$nis'";

				$proses_query02 = mysql_query($query02);

				if ( $proses_query02 ) {
					while($get_n02=mysql_fetch_array($proses_query02)){
						$data02[] = $get_n02;
					}
					if(is_array($data02)) {
						if(count($data02)>0){
							$pesan="";
							foreach ($data_siswa as $key => $value) {
								$cek_nis=$value['nis'];
								$kelasnya=$value['id_kelas'];

								$nP = 0;
								$nK = 0;
								$hit = 0;

								//cek masing2, sudah tersimpan atau belum
								//---------------------------------------

								/*------------------------------------
									Proses hitung
								------------------------------------*/
								
								//ambil nilai ketrampilan
								$nK = Nilai::getNilai_Optimun($cek_nis, $pelajaran);
								if($nK =='-') $nK=0;

								//ambil nilai pengetahuan
								$p = Nilai::getRataPelajaran($cek_nis, $pelajaran);
								$p = ($p != '-') ? $hit++ : 0;

								//nilai uts
                            	$ts = Nilai::getNilaiAkhir($cek_nis, $pelajaran, 'uts'); //ok fix
                            	$ts = ($ts != '-') ? $hit++ : 0;

                            	$as = Nilai::getNilaiAkhir($cek_nis, $pelajaran, 'uas');
                            	$as = ($as != '-') ? $hit++ : 0;	

                            	//Hitung rata2 dari penjumlahan =>> nilai pengetahuan + uts + UAS
                            	$nP = ($hit > 0) ? number_format((floatval($p) + floatval($ts) + floatval($as)) / ($hit), 2) : 0;
                            	
								/*------------------------------------
									Coba simpan dulu.
								------------------------------------*/
								$query03 = "SELECT a.nis FROM generate_chart a WHERE 
								a.nis = \"$cek_nis\" AND a.kode_pelajaran=\"$pelajaran\" 
								AND a.jurusan=\"$jurusan\" AND a.semester=\"$semester\" 
								AND a.tahun_ajaran=\"$tahun\"";

								//echo "<br><br>$query03<br><br>";
								$proses_query03 = mysql_query($query03);
								if ($proses_query03) {
									while($get_n03=mysql_fetch_array($proses_query03)){
										$data03[] = $get_n03;
									}
									if( is_array($data03) and count($data03)>0) {
										/*------------------------------------
											update
										------------------------------------*/
										$query05 = "UPDATE generate_chart a ".
										"SET a.na_p = '$p', a.na_k = '$nK' WHERE ".
										"a.nis = '$cek_nis' AND a.kode_pelajaran = '$pelajaran' ".
										"AND a.jurusan = '$jurusan' ".
										"AND a.semester = '$semester' AND a.tahun_ajaran = '$tahun'";

										$proses_query05 = mysql_query($query05);
										$pesan = ($proses_query05) ? "pesan0001b" : "pesan0002b";
									} else {
										/*------------------------------------
											Insert
										------------------------------------*/
										$query04 = "INSERT INTO generate_chart ".
										"(nis,kode_pelajaran,jurusan,
										semester,tahun_ajaran,kelas,na_p,na_k) VALUES 
										('$cek_nis', '$pelajaran', '$jurusan', 
										'$semester', '$tahun', '$kelasnya','$nP','$nK')";
										$proses_query04 = mysql_query($query04);
										$pesan = ($proses_query04) ? "pesan0001a" : "pesan0002a";
									}
								}
							}
							echo "$pesan";
						} else {
							echo "mapel_tidak_sesuai";
						}
					} else {
						echo "mapel_tidak_sesuai";
					}				
				} else {
					echo "mapel_tidak_sesuai";
				}
			} else {
				echo "pesan0004";
			}
		} else {
			echo "pesan0006";
		}
	} else {
		echo "<br><br>pesan0007";
	}
?>