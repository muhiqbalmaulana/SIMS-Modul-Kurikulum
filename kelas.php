<?php
include('koneksi.php');
if($_POST['id'])
{

 //disini bisa dilakukan aktifitas dengan database, meluai dari select, input, update hingga delete tergantung kebutuhan
 /*
 $sql=mysql_query("SELECT * FROM kelas WHERE jurusan = '$id' GROUP BY tingkat");
 while($data2=mysql_fetch_array($sql))
 {
  echo '<option value="'.$data2['kota_kabupaten'].'">'.$data2['kota_kabupaten'].'</option>';
 }
 */


  include ('setTahunSemester.php');
		if($_SESSION['smt']=='1'){
		 $sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester%2='1' GROUP BY semester");
		 	echo '<option selected="selected">Semester</option>'; 
		 while($data2=mysql_fetch_array($sql))
			 {
			  echo '<option value="'.$data2['semester'].'">'.$data2['semester'].'</option>';
			 }
		}
		else
		{	
		 $sql=mysql_query("SELECT * FROM pelajaran WHERE pelajaran.semester%2='0' GROUP BY semester");
		 echo '<option selected="selected">Semester</option>';
		 while($data2=mysql_fetch_array($sql))
			 {
			  echo '<option value="'.$data2['semester'].'">'.$data2['semester'].'</option>';
			 }
		}
}
?>