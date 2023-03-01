<?php
class TesN {	
    function getRataPelajaran($nis, $pelajaran,$tipe) {
        //return "ini class Nilai, static function getRataPelajaran";	
        $nis = mysql_real_escape_string($nis);
        //return "nis = $nis, pelajaran = $pelajaran";
        
        $dataSK = StandarKompetensi::getKI_Pengetahuan($pelajaran); //oke Fix

        if (is_array($dataSK)) {
            foreach ($dataSK as $SK) {
                $data = self::getRataSK($SK['id'], $nis,$tipe);              
                $rataSK = $data['avg'];     
            }           
        }       
        $rataRata = ($rataSK !='-')? $rataSK : '-';     
        return $rataRata;
    }

    function getRataKD($kd, $nis, $tipe, $array = true) {
        $nis        = mysql_real_escape_string($nis);
        $status     = ($tipe == '') ? $_SESSION['tipe_nilai'] : $tipe;
        $query  = "Select 
            SUM(g.tot_tgs) as total_tgs, sum(g.jml_tgs) as jml_tgs, SUM(g.tot_ujian) as total_ujian, SUM(g.jml_ujian) as jml_ujian,
            (SUM(g.tot_tgs) + SUM(g.tot_ujian))/(SUM(g.jml_tgs) + SUM(g.jml_ujian)) as avg
        from (
            Select nis,kd, sum(nilai) as tot_tgs, count(nilai) as jml_tgs, 0 as tot_ujian, 0 as jml_ujian  from nilai_tugas
            where nis = '$nis' and kd=$kd and `status` like '$status' group by nis
            union
            Select nis,kd, 0 as tot_tgs, 0 as jml_tgs, sum(nilai) as tot_ujian, count(nilai) as jml_ujian from nilai_ulangan
            where nis = '$nis' and kd=$kd and `status` like '$status' group by nis
        ) as g
        group by g.nis"; 
        $exe = mysql_query($query);
        if ($exe) {
            $hasil = mysql_fetch_assoc($exe);
            return ($array) ? $hasil : $hasil;
        } else {
            return false;
        }  
    }

    function getRataSK($id, $nis, $tipe,  $array = true) {
        
        $nis = mysql_real_escape_string($nis);
        $dataKD = KompetensiDasar::getAllData($id); //ok fix
        $jumlahKD = 0;
        $avg_total = 0;
        if (is_array($dataKD)) {
            foreach ($dataKD as $KD) {
                $data = self::getRataKD($KD [id], $nis, $tipe); //ok fix
                
                $datat_tgs = $data[total_tgs];
                $datat_ujian = $data[total_ujian];
                $datajml_tgs = $data[jml_tgs];
                $datajml_ujian = $data[jml_ujian];

                if(($datajml_tgs > 0) and ($datajml_ujian > 0)){
                     $result = number_format((($datat_tgs/$datajml_tgs) 
                     + ($datat_ujian / $datajml_ujian))/2,2);
                 }elseif(($datajml_tgs == 0) and ($datajml_ujian > 0)){
                     $result = number_format(($datat_ujian / $datajml_ujian),2);
                 }elseif(($datajml_tgs > 0) and ($datajml_ujian == 0)){
                     $result = number_format(($datat_tgs/$datajml_tgs),2);
                 }
                 
                if (($datajml_tgs + $datajml_ujian) > 0){
                    $jumlahKD++;
                    $avg_total += $result;
                }
            }
        }  

        $data2['avg'] = ($jumlahKD > 0) ? number_format($avg_total / $jumlahKD, 2) : '-';       
        return ($array) ? $data2 : $data2['avg'];  


        /*
        $jumlahKD = 0;
        $avg_total = 0;
        if (is_array($dataKD)) {
            foreach ($dataKD as $KD) {
                $data = self::getRataKD($KD [id], $nis, $tipe);
                $datat_tgs = $data[total_tgs];
                $datat_ujian = $data[total_ujian];
                $datajml_tgs = $data[jml_tgs];
                $datajml_ujian = $data[jml_ujian];
                if(($datajml_tgs > 0) and ($datajml_ujian > 0)){
                     $result = number_format((($datat_tgs/$datajml_tgs) 
                     + ($datat_ujian / $datajml_ujian))/2,2);
                 }elseif(($datajml_tgs == 0) and ($datajml_ujian > 0)){
                     $result = number_format(($datat_ujian / $datajml_ujian),2);
                 }elseif(($datajml_tgs > 0) and ($datajml_ujian == 0)){
                     $result = number_format(($datat_tgs/$datajml_tgs),2);
                 }
                 
                if (($datajml_tgs + $datajml_ujian) > 0){
                    $jumlahKD++;
                    $avg_total += $result;
                }
            }           
        }       
        $data2['avg'] = ($jumlahKD > 0) ? number_format($avg_total / $jumlahKD, 2) : '-';       
        return ($array) ? $data2 : $data2['avg'];
        */

    } 

    function getNilai_Optimun ($nis, $pelajaran,$tipe='') {
        $nis = mysql_real_escape_string($nis);
        $dataSK = StandarKompetensi::getKI_Ketrampilan($pelajaran);
        if (is_array($dataSK)) {
            foreach ($dataSK as $SK) {
                $data = self::getRata_OptiSK($SK[id], $nis, $tipe); //ok fix 
                $result = $data;               
            }               
        }           
        return $result;
    }


    function getRata_OptiSK($id, $nis, $tipe='',  $array = true) {
        $nis = mysql_real_escape_string($nis);
        $dataKD = KompetensiDasar::getAllData($id);

        // return $dataKD;

        $dataNilai = 0;
        $jumlahKD = 0;
        $optimum_total = 0;
        if (is_array($dataKD)) {
            foreach ($dataKD as $KD) {
                $data = self::getOptimumKD($KD[id], $nis, $tipe); //ok fix
                
                if ((!empty($data)) || (is_numeric($data))) {
                    $dataNilai += $data;
                    $jumlahKD++;
                }               
            }
        }  
                  
        $result = ($jumlahKD > 0) ? number_format($dataNilai/$jumlahKD, 2) : '-';       
        return $result; //return ($array) ? $result : $result;
    }


   function getOptimumKD($kd, $nis, $tipe='', $array = true) {
        $typeK = array('projek', 'praktek', 'prtfolio');
        $divK = 0;
        $nis = mysql_real_escape_string($nis);       
        $status = ($tipe == '') ? $_SESSION['tipe_nilai'] : $tipe; 

        
        foreach ($typeK as $value) {                   
            $nilai = self::getNilai_Ketrampilan($value, $nis, $kd ,$status); //ok
            $dataNilai[] = $nilai;   
            if(!empty($nilai)){
                $divK++;
            }
        }      
        
        $optimum = array_sum($dataNilai)/$divK;  
        return ($optimum);
    } 

    function getNilai_Ketrampilan($tipe, $nis, $kd, $status) {
        $result=array();
        $nis = mysql_real_escape_string($nis);
        $status = (true) ? "and status like '$status'" : "and status like '".$_SESSION['tipe_nilai']."'"; 
		$exe = mysql_query("select nilai from nilai_$tipe where nis = '$nis' and kd = '$kd' $status");		
		

        while ($row = mysql_fetch_array($exe))
        {  

            if($tipe === 'projek'){   
                $result[]   = $row['nilai'];    
                $optimumpro_min = min($result);
                if($optimumpro_min == 0){
                    $optimum = number_format(array_sum($result) / count($result),2);
                }else{
                    $optimum = max($result);
                }
            }

            elseif($tipe === 'praktek'){
                $result[]   = $row['nilai'];    
                $optimumpra_min = min($result);
                if($optimumpra_min == 0){
                    $optimum = number_format(array_sum($result) / count($result),2);
                }else{
                    $optimum = max($result);
                }
            }

            elseif($tipe === 'prtfolio') {
                $result[]   = $row['nilai'];    
                $optimumprt_min = min($result); 
                if($optimumprt_min == 0){
                    $optimum = number_format(array_sum($result) / count($result),2);
                }else{
                    $optimum = max($result);
                }
            }      
        }
        
        return ($optimum);

    }

    function getNilaiAkhir($nis, $pelajaran, $jenis) {
        
        $nis = mysql_real_escape_string($nis);
        $detPel = Pelajaran::getDetail($pelajaran);

        $total = 0;
        $jml = 0;
        $jenis = strtoupper($jenis);

        $rata = '-';

        if ($detPel[kejuruan] == 10) {
            $sk = StandarKompetensi::getAllData($pelajaran); // ok fix
            if (is_array($sk))
                foreach ($sk as $item) {
                    $exe = mysql_query("select $jenis from nilai_akhir where ".
                        "nis='$nis' and kode_pelajaran = '$pelajaran' and sk = '$item[id]'");
                    $data = mysql_fetch_assoc($exe);
                    if (mysql_num_rows($exe) >= 1 && $data[$jenis] != null) {
                        $total += $data[$jenis];
                        $jml++;
                    }
                }
            if ($jml > 0)
                $rata = number_format($total / $jml, 2);
        }else {
            $exe = mysql_query("select $jenis from nilai_akhir where nis='$nis' ".
            "and kode_pelajaran = '$pelajaran'");
            $data = mysql_fetch_assoc($exe);
            if ($data[$jenis] != null)
            $rata = number_format($data[$jenis], 2);            
        }
        return $rata;
    }           

}

?>