<?php
	session_start();
	require_once '../../models/modelByCippo.php';
	include('../../koneksi.php');

	$pelajaran = $_POST['pelajaran'];
	$jurusan = $_POST['jurusan'];
	$semester = $_POST['semester'];
	$tahun = $_SESSION['tahun_ajaran'];

	$query = "SELECT COUNT(*) AS jumlahnya ".
	"FROM generate_chart a, pelajaran b, jurusan c ".
	"WHERE ".
	"a.kode_pelajaran = $pelajaran AND a.jurusan = $jurusan ".
	"AND a.semester = $semester AND a.tahun_ajaran = $tahun ".
	"AND a.kode_pelajaran = b.id AND a.jurusan = c.id ";

	$mysqlquery = mysql_query($query);
	if ( $mysqlquery ) {
		while($ambilhasil=mysql_fetch_array($mysqlquery)){
			$arrayhasil[] = $ambilhasil;
		}

		if( is_array($arrayhasil) and count($arrayhasil)>0) {
			echo $arrayhasil[0]['jumlahnya']."\n \n";
		}
	}

?>