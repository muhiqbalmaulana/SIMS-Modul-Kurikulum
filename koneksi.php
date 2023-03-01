<?php
session_start ();
@ini_set('magic_quotes_gpc', false);
@ini_set('magic_quotes_runtime', false);
@ini_set('magic_quotes_sybase', false);
@ini_set('max_execution_time','150000');
@ini_set('display_errors', false);
//error_reporting(E_ERROR | E_WARNING);

$konek = @mysql_connect('localhost','root','');
if (!$konek) die ('gagal mengkoneksikan ke database server');
$db = @mysql_select_db('dbms_smkn1singosari');
if (!$db) die('gagal konek ke database');

		



		/*$tampilmaxi=mysql_query("SELECT MAX(UAS) FROM nilai_akhir,pelajaran WHERE pelajaran.semester='5' AND nilai_akhir.kode_pelajaran=pelajaran.id;");
		$empat=mysql_result($tampilmaxi,0);

		$tampilmini=mysql_query("SELECT MIN(UAS) FROM nilai_akhir,pelajaran WHERE pelajaran.semester='5' AND nilai_akhir.kode_pelajaran=pelajaran.id;");
		$lima=mysql_result($tampilmini,0);

		$tampilavgi=mysql_query("SELECT AVG(UAS) FROM nilai_akhir,pelajaran WHERE pelajaran.semester='5' AND nilai_akhir.kode_pelajaran=pelajaran.id ;");
		$enam=mysql_result($tampilavgi,0); */



		$tampilmaxa=mysql_query("SELECT MAX(UAS) FROM nilai_akhir,pelajaran WHERE pelajaran.semester='3' AND nilai_akhir.kode_pelajaran=pelajaran.id;");
		$tujuh=mysql_result($tampilmaxa,0);

		$tampilmina=mysql_query("SELECT MIN(UAS) FROM nilai_akhir,pelajaran WHERE pelajaran.semester='3' AND nilai_akhir.kode_pelajaran=pelajaran.id;");
		$delapan=mysql_result($tampilmina,0);

		$tampilavga=mysql_query("SELECT AVG(UAS) FROM nilai_akhir,pelajaran WHERE pelajaran.semester='3' AND nilai_akhir.kode_pelajaran=pelajaran.id ;");
		$sembilan=mysql_result($tampilavga,0);

		
?>
