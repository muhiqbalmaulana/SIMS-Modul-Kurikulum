<?php

$do = $_REQUEST ['do'];
switch ($do) {
   
    default :
        $tahun = $_SESSION['tahun_ajaran'];
        $detailTahun = TahunAjaran::detail($tahun);
        $nama = $_REQUEST['nama'];
        $data = Jurusan::getDataAll($nama, $tahun);
        $display = 'jurusan/list.php';
        break;
}
?>