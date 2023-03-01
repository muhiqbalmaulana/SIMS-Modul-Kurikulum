<?php

class StandarKompetensi {

    static function getKI_Pengetahuan($pelajaran = null) {
        $sql = "select * from standar_kompetensi a ";
        if ($pelajaran or $tipene) {
            $sql .= " where a.pelajaran = '$pelajaran' and a.kompetensi = 'pengetahuan'";
            $sql .= " order by a.kode";
        }

        $exe = mysql_query($sql);
        while ($record = mysql_fetch_assoc($exe))
            $data[] = $record;
        return $data;
        
    }

    static function getKI_Ketrampilan($pelajaran = null) {
        $sql = "select * from standar_kompetensi a ";
        if ($pelajaran or $tipene) {
            $sql .= " where a.pelajaran = '$pelajaran' and a.kompetensi = 'keterampilan'";
            $sql .= " order by a.kode";
        }

        $exe = mysql_query($sql);
        while ($record = mysql_fetch_assoc($exe))
            $data[] = $record;
        return $data;
    }   

    static function getAllData($pelajaran = null) {
        $sql = "select * from standar_kompetensi a ";
        // return "static function getAllData($pelajaran)";

        $sql = "select * from standar_kompetensi a ";
        if ($pelajaran or $tipene) {
            $sql .= " where a.pelajaran = '$pelajaran'";
            $sql .= " order by a.kode";
        }
        $exe = mysql_query($sql);
        while ($record = mysql_fetch_assoc($exe))
            $data[] = $record;
        return $data;
        
    }


}

?>