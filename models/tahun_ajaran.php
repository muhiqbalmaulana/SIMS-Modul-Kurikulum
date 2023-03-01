<?php

class TahunAjaran {

    static function detail($id) {
        $query = sprintf("select * from tahun_ajaran where id=%d", $id);
        return mysql_fetch_assoc(mysql_query($query));
    }

    static function getAllData() {
        $exe = mysql_query("select * from tahun_ajaran order by tahun asc");
        while ($row = mysql_fetch_assoc($exe))
            $data[] = $row;
        return $data;
    }

}

?>