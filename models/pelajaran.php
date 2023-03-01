<?php
class Pelajaran {
    static function getDetail($id) {
        
        $exe = mysql_query("select a.*,b.tahun,c.nama as nama_tipe from ".
        	"pelajaran a,tahun_ajaran b,tipe_pelajaran c where a.id='$id' ".
        	"and b.id=a.tahun_ajaran and a.tipe=c.id");
/*
return "<br>select a.*,b.tahun,c.nama as nama_tipe from ".
        	"pelajaran a,tahun_ajaran b,tipe_pelajaran c where a.id='$id' ".
        	"and b.id=a.tahun_ajaran and a.tipe=c.id";*/

        return mysql_fetch_assoc($exe);
    }
}

?>