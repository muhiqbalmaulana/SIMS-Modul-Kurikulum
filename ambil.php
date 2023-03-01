<?php
include('koneksi.php');
if($_POST['id'])
{
 $id=$_POST['id'];

 		$tampilmax=mysql_query("SELECT MAX(UAS) FROM nilai_akhir WHERE kode_pelajaran='$id';");
		$max=mysql_result($tampilmax,0);

		$tampilmin=mysql_query("SELECT MIN(UAS) FROM nilai_akhir WHERE kode_pelajaran='$id';");
		$min=mysql_result($tampilmin,0);

		$tampilavg=mysql_query("SELECT AVG(UAS) FROM nilai_akhir WHERE kode_pelajaran='$id';");
		$avg=mysql_result($tampilavg,0);

	}
$_SESSION['min']=$min;
$_SESSION['max']=$max;
$_SESSION['avg']=$avg;

echo $id;
?>

