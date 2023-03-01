<?php	
 include ('koneksi.php');
	if($_SESSION['superad'] == 'y'){
	$sql = "SELECT nama FROM jurusan 
			WHERE nama LIKE '%".$_GET['query']."%' AND jurusan.tahun_ajaran='$_SESSION[tahun_ajaran]'
			GROUP BY jurusan.nama";
	$result = mysql_query($sql);
	}else{
	$sql = "SELECT nama FROM jurusan 
			WHERE nama LIKE '%".$_GET['query']."%' AND jurusan.tahun_ajaran='$_SESSION[tahun_ajaran]' AND jurusan.nama ='$_SESSION[kapro]'
			GROUP BY jurusan.nama"; //echo$sql;die();
	$result = mysql_query($sql);	
	}
	$json = array();
	while($row = mysql_fetch_assoc($result)){
		/* if($_SESSION['kapro']!=''){
			if($row['nama'] == $_SESSION['kapro']){
				$json[] = $row['nama'];
			}else{
				$json[] ='';
			}
		} */
	     $json[] = $row['nama'];
	}

	echo json_encode($json);
?>