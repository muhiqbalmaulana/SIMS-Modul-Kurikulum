<?php
$host="localhost";
$user="root";
$pass="";
$db="dbms_sgs1";
$koneksi=@mysql_connect($host,$user,$pass) or die ("gagal koneksi");
$database=@mysql_select_db($koneksi,$db) or die ("db tak bisa dipilih");
?>