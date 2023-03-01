<?php
$data = $_POST['Rangkin'];
$json=array();
	/* $server = "localhost:3307";
        $user   = "root";
        $pass   = "";
        $dbnya  = "dbms_smkn6";

        mysql_connect($server,$user,$pass) or die("Maaf, koneksi gagal !");
        mysql_select_db($dbnya) or die("Database tidak dapat dibuka, Nama database salah !");
 */
	include ('koneksi.php');
	if($_SESSION['superad'] == 'y'){
	$sql = "SELECT nama FROM jurusan 
			WHERE nama LIKE '%".$data."%' AND jurusan.tahun_ajaran='$_SESSION[tahun_ajaran]' GROUP BY nama;
			"; 
	$result = mysql_query($sql);
	}else{
	$sql = "SELECT nama FROM jurusan 
			WHERE nama LIKE '%".$data."%' AND jurusan.tahun_ajaran='$_SESSION[tahun_ajaran]' AND jurusan.nama ='$_SESSION[kapro]'
			GROUP BY jurusan.nama";
	$result = mysql_query($sql);	
	}
	$json = array();
	while($row = mysql_fetch_assoc($result)){
	     $json[] = $row['nama'];
	}

	echo json_encode($json); 
?>