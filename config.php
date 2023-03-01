<?php
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
?>
