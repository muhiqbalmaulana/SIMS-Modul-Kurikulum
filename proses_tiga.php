 
<?
 include('koneksi.php'); 
 if (isset($error)) {
	echo '<b>Error</b>: <br />'.implode('<br />', $error);
} else {
	/*
	
	*/

	$data = $_POST['pelajaran'];

/* $exe = mysql_query(
		"Select 
			
			g.maks,g.minus, g.rata
		from (
			Select MAX(UAS) as maks, 0 as minus, 0 as rata  from nilai_akhir
			where nilai_akhir.kode_pelajaran='4'
			union
			Select 0 as maks, MIN(UAS) as minus, 0 as rata  from nilai_akhir
			where nilai_akhir.kode_pelajaran='4'
			union
			Select 0 as maks, 0 as minus, AVG(UAS) as rata  from nilai_akhir
			where nilai_akhir.kode_pelajaran='4'
		) as g;"
);  */
$exe = mysql_query("select max(a.UAS) as makse, min(a.UAS) as minuse, avg(a.UAS) as ratae from nilai_akhir a where a.kode_pelajaran='$data'; ");
//$row = mysql_fetch_array($row1);
while ($record = mysql_fetch_assoc($exe)){
				//print_r($record);die();
				$row[] = $record;
}
 /* if (true) {
           
            $arr = array();
            $inc = 0;
            while ($row = mysql_fetch_assoc($exe)) {
                # code...
                $jsonArrayObject = (array('maks' => $row["maks"], 'minus' => $row["minus"], 'rata' => $row["rata"]));
                $arr[$inc] = $jsonArrayObject;
                $inc++;
            }
            $json_array = json_encode($arr);
            echo $json_array;
        }
        else{
            echo "0 results";
        } */

$json_data=array();  
foreach($row as $rec)  
{  
    $json_array['labele']='Statistik Nilai';  
    $json_array['maxe']=$rec['makse'];  
	$json_array['mine']=$rec['minuse'];
	$json_array['avge']=$rec['ratae'];
	$json_array['kkme']='75';
    array_push($json_data,$json_array);  
} 
echo json_encode($json_data);}
?>