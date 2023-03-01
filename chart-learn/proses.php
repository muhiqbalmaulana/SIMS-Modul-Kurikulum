<?
	$konek = @mysql_connect('localhost','root','');
if (!$konek) die ('gagal mengkoneksikan ke database server');
$db = @mysql_select_db('chart-learn');
if (!$db) die('gagal konek ke database');
	
	$produk =  $_POST['produk'];
	$jml = $_POST['jml'];
	
	//echo $q;exit;
	$x = 0;
 
	while ($x <= $jml) {
	
	   $q = mysql_query("insert into jml_penjualan(id_produk, item)values('$produk', '1')");
	  
	  $x++;
	   
	   if ($x==$jml) break;
	}
	
	header('location:'.$_SERVER['name'].'/chart-learn');
	
?>
