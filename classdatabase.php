<?php
if(!isset($_SESSION)){ session_start(); }

class classdatabasenya{
    function koneksidatabase(){
        $server = "localhost";
        $user   = "stmsgs1mlg";
        $pass   = "ArShnEfESes7J3v9";
        $dbnya  = "dbms_smkn1singosari";

        mysql_connect($server,$user,$pass) or die("Maaf, koneksi gagal !");
        mysql_select_db($dbnya) or die("Database tidak dapat dibuka, Nama database salah !");
    }
}
?>