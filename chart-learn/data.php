<?
	$konek = @mysql_connect('localhost','root','');
if (!$konek) die ('gagal mengkoneksikan ke database server');
$db = @mysql_select_db('chart-learn');
if (!$db) die('gagal konek ke database');
	
	$q = mysql_query("select * from data");
	
	while($r = mysql_fetch_array($q)){
		
		//memilih jumlah penjualan
		$q1 = mysql_query("select * from jml_penjualan left join data on jml_penjualan.id_produk = data.id where jml_penjualan.id_produk='$r[id]' ");
		$jml = mysql_num_rows($q1);
		echo "['$r[produk]',   $jml],";
		
	}
	
	
?>