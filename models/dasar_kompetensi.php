<?php

class KompetensiDasar {
    static function getAllData($sk = null) {
        $sql = "select * from kompetensi_dasar ";
        if($sk) $sql .= "where standar_kompetensi = '". $sk ."'";

        $sql .= " order by kode";
        $exe = mysql_query($sql);

        while ($record = mysql_fetch_assoc($exe))
            $data [] = $record;
        return $data;
    }    
}

?>