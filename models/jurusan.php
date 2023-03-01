<?
class Jurusan {

    static function getAllData() {
    	$tahun = $_SESSION['tahun_ajaran'];
		$tampil = "SELECT id,nama from jurusan where tahun_ajaran='1'";
        $ajaran = mysql_query($tampil);
		while($data = mysql_fetch_array($ajaran))
            $data[] = $row;
        return $data;
    }
 }

?>





