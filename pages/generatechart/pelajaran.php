<?php

session_start ();

include('../../koneksi.php');
if($_POST['id'])
{
 $id=$_POST['id'];
     /*if ($_SESSION['smt']=='1')
     {
      if($_POST['id']=='X')
      		 $sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester = '1'");
      		 while($data3=mysql_fetch_array($sql))
 				{
  					echo '<option value="'.$data3['nama'].'">'.$data3['nama'].'</option>';
 				}
  	  else if($_POST['id']=='XI')
      		 $sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester = '3'");
      		 while($data3=mysql_fetch_array($sql))
 				{
  					echo '<option value="'.$data3['nama'].'">'.$data3['nama'].'</option>';
 				}
 	  else
      		 $sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester = '5'");
      		 while($data3=mysql_fetch_array($sql))
 				{
  					echo '<option value="'.$data3['nama'].'">'.$data3['nama'].'</option>';
 				}
 	 }
  	else 
  		{
      if($_POST['id']=='X')
      		 $sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester = '2'");
      		 while($data3=mysql_fetch_array($sql))
 				{
  					echo '<option value="'.$data3['nama'].'">'.$data3['nama'].'</option>';
 				}
  	  else if($_POST['id']=='XI')
      		 $sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester = '4'");
      		 while($data3=mysql_fetch_array($sql))
 				{
  					echo '<option value="'.$data3['nama'].'">'.$data3['nama'].'</option>';
 				}
 	  else
      		 $sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester = '6'");
      		 while($data3=mysql_fetch_array($sql))
 				{
  					echo '<option value="'.$data3['nama'].'">'.$data3['nama'].'</option>';
 				}
  		}*/

  		
/*require 'isi.php';
if ($_SESSION['smt']=='1')
	{
  		$sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester%2='1' GROUP BY nama");

 		while($data3=mysql_fetch_array($sql))
 		{
  		echo '<option value="'.$data3['nama'].'">'.$data3['semester'].''.$data3['nama'].'</option>';
 		}
 	}
 else
 	{
  		$sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester%2='0' GROUP BY nama");

 		while($data3=mysql_fetch_array($sql))
 		{
  		echo '<option value="'.$data3['nama'].'">'.$data3['semester'].''.$data3['nama'].'</option>';
 		}
 	}

}*/

$sql=mysql_query("SELECT * FROM pelajaran WHERE semester='$id' GROUP BY nama");

$sesi = $_SESSION[tahun_ajaran];
$sql=mysql_query("SELECT a.*, b.nama, b.kode_pelajaran, b.id 
from pel_siswa a,pelajaran b 
where 
a.pelajaran=b.id AND a.semester = $id AND a.tahun_ajaran = ".$_SESSION[tahun_ajaran]." GROUP BY a.pelajaran
ORDER BY b.nama ASC");


echo '<option selected="selected">Pelajaran</option>';
 		while($data3=mysql_fetch_array($sql))
 		{
  		echo '<option value="'.$data3['id'].'">'.$data3['nama'].' - '.$data3['kode_pelajaran'].'</option>';
 		}
}
?>