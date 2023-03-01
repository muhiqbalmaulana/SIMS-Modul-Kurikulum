<?php
/* include ('koneksi.php');
$tampil = "SELECT * FROM pelajaran WHERE pelajaran.tahun_ajaran='$_POST[id]' AND pelajaran.semester%2='$_POST[sem]'";
$ajaran = mysql_query($tampil);
/* while($data = mysql_fetch_array($ajaran)){
    echo "<option value=$data[id]>$data[nama]</option>";
} */
//$_SESSION['tahun_ajaran'] = $_POST['id'];
//echo json_encode($_POST['id']); */
$_SESSION['tahun_ajaran'] = $_POST['id'];
?>