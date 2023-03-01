<?php
class Raport {

	static function get_kkm_pel($nis,$pel){
		//$tipe 		= $_SESSION['tipe_nilai'];
		/*$sql = "SELECT avg(g.kkm) as rt2_kkm from (
			SELECT no_tugas as nomor, nilai, status, sk.* from nilai_tugas nt join 
				kompetensi_dasar kd on nt.kd=kd.id JOIN 
				standar_kompetensi sk on kd.standar_kompetensi=sk.id
				WHERE nis='$nis' and sk.pelajaran=$pel and status like '$tipe'
				union all
			SELECT no_ulangan as nomor, nilai, status, sk.* from nilai_ulangan nt join 
				kompetensi_dasar kd on nt.kd=kd.id JOIN 
				standar_kompetensi sk on kd.standar_kompetensi=sk.id
				WHERE nis='$nis' and sk.pelajaran=$pel and status like '$tipe'
		) as g GROUP BY g.pelajaran";*/
		//perhitungan KKM tanpa $tipe 		= $_SESSION['tipe_nilai'];
		$sql = "SELECT avg(g.kkm) as rt2_kkm from (
			SELECT no_tugas as nomor, nilai, status, sk.* from nilai_tugas nt join 
				kompetensi_dasar kd on nt.kd=kd.id JOIN 
				standar_kompetensi sk on kd.standar_kompetensi=sk.id
				WHERE nis='$nis' and sk.pelajaran=$pel
				union  all
			SELECT no_ulangan as nomor, nilai, status, sk.* from nilai_ulangan nu join 
				kompetensi_dasar kd on nu.kd=kd.id JOIN 
				standar_kompetensi sk on kd.standar_kompetensi=sk.id
				WHERE nis='$nis' and sk.pelajaran=$pel
		) as g GROUP BY g.pelajaran";
		$exe 	= mysql_query($sql);
		$data	= mysql_fetch_assoc($exe);
		return ($data['rt2_kkm'] <=0) ? '-' : number_format($data['rt2_kkm'],2);
	}

    static function setKehadiran($status, $semester, $value, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        if (is_array($value))
            foreach ($value as $key => $value) {
                $detail = self::getDetailRaport($key, $semester, $tahun_ajaran);
                if (is_array($detail))
                    $query = sprintf("update raport set %s=%f where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $status, $value, $semester, $tahun_ajaran, mysql_real_escape_string($key),$tipe);
                else
                    $query = sprintf("insert into raport (nis,tahun_ajaran,semester,%s,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,%d,'%s','%s','%s')", $status, mysql_real_escape_string($key), $tahun_ajaran, $semester, $value, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
                mysql_query($query);
            }
    }
	
	 static function setSikap($status, $semester, $value, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        if (is_array($value))
            foreach ($value as $key => $value) {
                $detail = self::getDetailRaport($key, $semester, $tahun_ajaran);
                if (is_array($detail))
                    $query = sprintf("update raport set %s=%f where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $status, $value, $semester, $tahun_ajaran, mysql_real_escape_string($key),$tipe);
                else
                    $query = sprintf("insert into raport (nis,tahun_ajaran,semester,%s,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,%d,'%s','%s','%s')", $status, mysql_real_escape_string($key), $tahun_ajaran, $semester, $value, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);				
			   mysql_query($query);
            }
    }

    static function ubahBK($nis, $sakit, $ijin, $alpha, $sosial, $semester, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
        if (is_array($detail))
            $query = sprintf("update raport set sakit=%d,ijin=%d,alpa=%d,sosial=%d where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $sakit, $ijin, $alpha, $sosial, $semester, $tahun_ajaran, mysql_real_escape_string($nis),$tipe);
        else
            $query = sprintf("insert into raport (nis,tahun_ajaran,semester,sakit,ijin,alpa, sosial, nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,%d,%d,%d,%d,'%s','%s','%s')", mysql_real_escape_string($nis), $tahun_ajaran, $semester, $sakit, $ijin, $alpha, $sosial, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
        $exe = mysql_query($query);
        return $exe;
    }
	
	 static function ubahSikap($nis, $sosial, $semester, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
        if (is_array($detail))
            $query = sprintf("update raport set sosial=%f where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $sosial, $semester, $tahun_ajaran, mysql_real_escape_string($nis),$tipe);
        else
            $query = sprintf("insert into raport (nis,tahun_ajaran,semester,sosial,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,%d,'%s','%s','%s')", mysql_real_escape_string($nis), $tahun_ajaran, $semester, $sosial, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
        $exe = mysql_query($query);
        return $exe;
    }
	
	 static function ubahSikapSpiritual($nis, $spiritual, $semester, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
        if (is_array($detail))
            $query = sprintf("update raport set spiritual=%f where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $spiritual, $semester, $tahun_ajaran, mysql_real_escape_string($nis),$tipe);
        else
            $query = sprintf("insert into raport (nis,tahun_ajaran,semester,spiritual,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,%d,'%s','%s','%s')", mysql_real_escape_string($nis), $tahun_ajaran, $semester, $spiritual, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
        $exe = mysql_query($query);
        return $exe;
    }
	
	 static function ubahSikapSosial($nis, $sosial, $semester, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
        if (is_array($detail))
            $query = sprintf("update raport set sosial_pkn=%f where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $sosial, $semester, $tahun_ajaran, mysql_real_escape_string($nis),$tipe);
        else
            $query = sprintf("insert into raport (nis,tahun_ajaran,semester,sosial_pkn,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,%d,'%s','%s','%s')", mysql_real_escape_string($nis), $tahun_ajaran, $semester, $sosial, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
        echo $query; die(); //$exe = mysql_query($query);
        return $exe;
    }

    static function resetBK($nis, $semester, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
        if (is_array($detail))
            $query = sprintf("update raport set sakit=0,ijin=0,alpa=0,sosial=0 where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $semester, $tahun_ajaran, mysql_real_escape_string($nis),$tipe);
        mysql_query($query);
    }
    //start hery's code
    // Kepribadian
       static function ubahPB($nis,$kepedulian,$kebangsaan,$ketaatan,$akhlak, $semester, $tahun_ajaran) {
    		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
            $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
            if (is_array($detail))
                $query = sprintf("update raport set kepedulian='%s',kebangsaan='%s',ketaatan='%s',akhlak='%s' where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'",$kepedulian,$kebangsaan,$ketaatan,$akhlak,$semester, $tahun_ajaran, mysql_real_escape_string($nis),$tipe);
            else
                $query = sprintf("insert into raport (nis,tahun_ajaran,semester,kepedulian,kebangsaan,ketaatan,akhlak,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,'%s','%s','%s','%s','%s','%s','%s')", mysql_real_escape_string($nis), $tahun_ajaran, $semester,$kepedulian,$kebangsaan,$ketaatan,$akhlak, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
           // echo $query;
           $exe = mysql_query($query);
         return $exe;
        }
        
        static function setPB($status, $semester, $value, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        if (is_array($value))
            foreach ($value as $key => $value) {
                $detail = self::getDetailRaport($key, $semester, $tahun_ajaran);
                if (is_array($detail))
                    $query = sprintf("update raport set %s='%s' where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $status, $value, $semester, $tahun_ajaran, mysql_real_escape_string($key),$tipe);
                else
                    $query = sprintf("insert into raport (nis,tahun_ajaran,semester,%s,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,'%s','%s','%s','%s')", $status, mysql_real_escape_string($key), $tahun_ajaran, $semester, $value, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
                  mysql_query($query);
            }
        }
        
        static function resetPB($nis, $semester, $tahun_ajaran) {
    		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
            $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
            if (is_array($detail))
                $query = sprintf("update raport set kepedulian='',kebangsaan='',ketaatan='',akhlak='' where semester=%d and tahun_ajaran=%d and nis='%s' and tipe='%s'", $semester, $tahun_ajaran, mysql_real_escape_string($nis),$tipe);
            mysql_query($query);
        }
        
        static function getDetailRaportWithEkstra($nis, $semester, $tahun_ajaran) {
    		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
            $nis = mysql_real_escape_string($nis);
            $exe = mysql_query("select 
                                    a.*,
                                    b.tahun,                                   
                                    (select count(id) from prestasi_ekstrakulikuler d where d.raport=a.id) ekstrak                                   
                                from 
                                    raport a,
                                    tahun_ajaran b                              
                                where 
                                    nis = '$nis' and 
                                    semester = '$semester' and 
    								tipe = '$tipe' and 
                                    tahun_ajaran='$tahun_ajaran'"); 
            return mysql_fetch_assoc($exe);
            }
			  //$nis, $ekstrak_nama, $predikat, $ekstrak_des, $semester,$_SESSION[tahun_ajaran])
      static function ubahEkstra($niss, $ekstrak, $predikat, $organ, $semester, $tahun_ajaran) {
    		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts'; 
			
           foreach($niss as $nis){			  
             $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
              $rpt=$detail['id'];
             if (!is_array($detail))
             {				
                $query = sprintf("insert into raport (nis,tahun_ajaran,semester,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,'%s','%s','%s')", mysql_real_escape_string($nis), $tahun_ajaran, $semester, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
				mysql_query($query);
                $detail = self::getDetailRaport($nis, $semester, $tahun_ajaran);
                 $rpt=$detail['id'];
             }               
               //echo $rpt.'sdf';die();
                foreach($ekstrak[$nis] as $ind=>$eks){
                    $kegiatan[$ind]['predikate']=$predikat[$nis][$ind];   
                    $kegiatan[$ind]['nama']=$eks; 
					$kegiatan[$ind]['keterangan']=$organ[$nis][$ind];  
                    $kegiatan[$ind]['raport']=$rpt;   
                       
                    //$pre_ekstrak[$ind]['nama']=$ekstrak[$nis][$ind];   
                    //$pre_ekstrak[$ind]['raport']=$rpt;   
               
                   // $pre_organ[$ind]['nama']=$organ[$nis][$ind];   
                    //$pre_organ[$ind]['raport']=$rpt;  
                     
                }
				//print_r($kegiatan); die('stop');
                semua::delete('kegiatan',"raport='$rpt'");
                semua::delete('prestasi_ekstrakulikuler',"raport='$rpt'");
                semua::delete('prestasi_organisasi',"raport='$rpt'");
                //semua::multiInsert($kegiatan,'kegiatan');
                //semua::multiInsert($pre_ekstrak,'prestasi_ekstrakulikuler');
				semua::multiInsert($kegiatan,'prestasi_ekstrakulikuler');
                //semua::multiInsert($pre_organ,'prestasi_organisasi');
                semua::delete('kegiatan',"nama='' and predikat=''");
                semua::delete('prestasi_ekstrakulikuler',"nama=''");
                semua::delete('prestasi_organisasi',"nama=''");

            
            }
                               
        //   $exe = mysql_query($query);
            return true;
      }        
               

    //end hery's code
    static function getNextPrevious($kelas, $nis) {
        $siswa = Siswa::getSiswaPerKelas($kelas);
        $posisi = '';
        for ($i = 0; $i < count($siswa); $i++) {
            if ($siswa[$i][nis] == $nis) {
                $posisi = $i;
                break;
            }
        }
        if ((count($siswa) - 1) !== $posisi)
            $array[next] = $siswa[($posisi + 1)][nis];
        if ($posisi !== 0)
            $array[prev] = $siswa[($posisi - 1)][nis];
        return $array;
    }

    static function setTahunAjaran($tahun, $tgl, $semester, $kelas) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $tgl = substr($tgl, 6, 4) . '-' . substr($tgl, 3, 2) . '-' . substr($tgl, 0, 2);
        $dataSiswa = Siswa::getSiswaPerKelas($kelas);
        if (is_array($dataSiswa))
            foreach ($dataSiswa as $siswa) {
                $data = self::getDetailRaport($siswa[nis], $semester, $tahun);
                if (is_array($data))
                    $query = sprintf("update raport set tanggal = '%s', tahun_ajaran = '%d' where id='%d' ", mysql_real_escape_string($tgl), $tahun, $data[id]);
                else
                    $query = sprintf("insert into raport (nis,semester,tahun_ajaran,tanggal,nip_kepsek,nama_kepsek,tipe) values('%s','%d','%s','%s','%s','%s','%s')", mysql_real_escape_string($siswa[nis]), $semester, mysql_real_escape_string($tahun), mysql_real_escape_string($tgl), mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
                mysql_query($query);
            }
    }

//==================set kepsek===============
	static function setKepsek($tahun, $kepsek, $semester, $kelas, $nipkepsek) {	
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts'; 		
        $dataSiswa = Siswa::getSiswaPerKelas($kelas);
        if (is_array($dataSiswa))
            foreach ($dataSiswa as $siswa) {
                $data = self::getDetailRaport($siswa[nis], $semester, $tahun);
                if (is_array($data)) {				
                    $query = sprintf("update raport set nama_kepsek = '%s', nip_kepsek = '%s' where id='%d' ", mysql_real_escape_string($kepsek), mysql_real_escape_string($nipkepsek), $data[id]);
					mysql_query($query);
                } else {
                    $query = sprintf("insert into raport (nis,semester,tahun_ajaran,nip_kepsek,nama_kepsek,tipe) values('%s','%d','%s','%s','%s','%s')", mysql_real_escape_string($siswa[nis]), $semester, mysql_real_escape_string($tahun), mysql_real_escape_string($nipkepsek), mysql_real_escape_string($kepsek),$tipe);
                mysql_query($query);
				}
            }
    }
//===========================================

    static function getPengaturanUmum($kelas, $semester, $tahun_ajaran) {
        $dataSiswa = Siswa::getSiswaPerKelas($kelas);
        $ada = false;
        if (is_array($dataSiswa))
            foreach ($dataSiswa as $siswa) {
                $data = self::getDetailRaport($siswa[nis], $semester, $tahun_ajaran);
				if (is_array($data)){
                    $ada = true;
					break;
				}
            }
        if ($ada) {
            //mysql : 2011-12-25 => indonesian : 25-12-2011
            $data[tanggal] = substr($data[tanggal], 8, 2) . '-' . substr($data[tanggal], 5, 2) . '-' . substr($data[tanggal], 0, 4);
            return array(tanggal => $data[tanggal]);
        }else
            return array(tanggal => '');
    }

//========pengaturan nama kepsek==================
	static function getPengaturanKepsek($kelas, $semester, $tahun_ajaran) {
        $dataSiswa = Siswa::getSiswaPerKelas($kelas);
        $ada = false;
        if (is_array($dataSiswa))
            foreach ($dataSiswa as $siswa) {
                $data = self::getDetailRaport($siswa[nis], $semester, $tahun_ajaran);
				if (is_array($data)){
                    $ada = true;
					break;
				}
            }
        if ($ada) {
            //mysql : 2011-12-25 => indonesian : 25-12-2011
            //$data[tanggal] = substr($data[tanggal], 8, 2) . '-' . substr($data[tanggal], 5, 2) . '-' . substr($data[tanggal], 0, 4);
            $data[nama_kepsek]=$data[nama_kepsek];
			return array(kepsek => $data[nama_kepsek]);
        }else
            return array(kepsek => '');
    }

	//set rank
    static function setRanking($kelas, $semester, $tahun) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $dataSiswa = Siswa::getSiswaPerKelas($kelas);
        if (is_array($dataSiswa))
            foreach ($dataSiswa as $siswa) {
				$totalPerSiswa[$siswa[nis]] = 0;
				$totalP = 0;
				$totalK = 0;
                $pelajaran = Pelajaran::getPelSiswa($siswa[nis], $semester, $tahun);
					if (is_array($pelajaran))
                    foreach ($pelajaran as $pel) {						   
						   $devP = 0;
						   $devK = 0;
						   $nP = 0;
						   $nK = 0;
						   $hit	= 0;						
                            //ambil nilai ketrampilan  
							$nK		= Nilai::getNilai_Optimun($siswa[nis], $pel[id]);	

                            //ambil nilai pengetahuan 								
							$p		= Nilai::getRataPelajaran($siswa[nis], $pel[id]);					
							
                            // jika nilai 
                            if ($p != '-') $hit++;
							
                            //nilai uts
                            $ts = Nilai::getNilaiAkhir($siswa[nis], $pel[id], 'uts');
							
                            if ($ts != '-')
								$hit++;
							$as = ($_SESSION['tipe_nilai'] == 'ts1') ? '-' : Nilai::getNilaiAkhir($siswa[nis], $pel[id], 'uas');
							if ($as != '-')
								$hit++;					
							$nP = ($hit > 0) ? number_format((floatval($p) + floatval($ts) + floatval($as)) / ($hit), 2) : '-';                
							
						if($nP !='-'){
							$devP++;
							}
						 if($nK !='-'){
							$devK++;
							}
						$ntotalP += $nP;				
						$ntotalK += $nK;
						$devTotK += $devK;
						$devTotP += $devP;				
						$totalP += $nP;
						$totalK += $nK;					
						
                    }
				$totalPerSiswa[$siswa[nis]] += ($totalP + $totalK);
            }
        if (is_array($totalPerSiswa))
            arsort($totalPerSiswa);
        $jml = count($totalPerSiswa);//jml=sum-siswa = field total -- i = field rank -- val = field nilai_kelas
        $i = 1;
		$temp = 0;
        if (is_array($totalPerSiswa))
            foreach ($totalPerSiswa as $nis => $val) {                
                $detail = self::getDetailRaport($nis, $semester, $tahun);							
                if (is_array($detail)) {
					if($i == '1') {
					$query = sprintf("update raport set rank=%d,total=%d,nilai_kelas=%f where id=%d", $i, $jml, $val, $detail[id]);	
					$i++;
					}elseif($val == $temp){					
					$query = sprintf("update raport set rank=%d,total=%d,nilai_kelas=%f where id=%d", ($i-1), $jml, $val, $detail[id]);					
					}else {
                    $query = sprintf("update raport set rank=%d,total=%d,nilai_kelas=%f where id=%d", $i, $jml, $val, $detail[id]);
					$i++;
					}
				}else {				
                    $query = sprintf("insert into raport (nis,tahun_ajaran,semester,rank,total,nilai_kelas,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,%d,%d,%f,'%s','%s','%s')", mysql_real_escape_string($nis), $tahun, $semester, $i, $jml, $val, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
                }
				$exe = mysql_query($query);
                //$i++;
				$temp = $val;	
            }
    }
	
	// set rank_jur
	static function setRanking_jur($jur,$tingkat, $semester, $tahun) {
		$tipe	=  'as' ;
		$sql		= "SELECT k.nama from kelas_siswa ks
			JOIN siswa s on ks.nis=s.nis
			LEFT JOIN kelas k on k.id=ks.kelas
			LEFT JOIN raport r on r.nis=ks.nis and r.semester=$semester and r.tahun_ajaran = $tahun and r.tipe='as'
			WHERE k.jurusan=$jur and k.tingkat = '$tingkat' and r.rank = '' and (r.nilai_kelas = '' or ISNULL(r.nilai_kelas)) and s.aktif='y'
			GROUP BY k.id ORDER BY k.nama;";
			//echo $sql;die();
		$ada 	= semua::custom($sql);
		if (is_array($ada)){
			foreach ($ada as $kls){
				$kelas .= ' - '.$kls['nama'].'<br>';
			}
			$data['status'] = 'error';
			$data['kelas']	= '<div style="margin-left:150px">$kelas</div>';
			echo json_encode($data);
			die();
		}
		/*$sql   	= "Select ks.nis,r.nilai_kelas from kelas_siswa ks  
			JOIN kelas k on ks.kelas=k.id	
			left Join raport r on r.nis=ks.nis and r.semester=$semester and r.tahun_ajaran=$tahun and r.tipe='as'
			where k.jurusan=$jur and k.tingkat='$tingkat' group by ks.nis ORDER BY r.nilai_kelas desc";*/
	
		$sql	= "select j.nis , j.nilai_kelas from (Select ks.nis,r.nilai_kelas from kelas_siswa ks  
			JOIN kelas k on ks.kelas=k.id	
			left Join raport r on r.nis=ks.nis and r.semester=$semester and r.tahun_ajaran=$tahun and r.tipe='as'
			where k.jurusan=$jur and k.tingkat='$tingkat' group by ks.nis ORDER BY r.nilai_kelas desc) as j, siswa s where s.nis = j.nis and s.aktif='y' ";
	
        $dataSiswa = semua::custom($sql);
		$jml				= count($dataSiswa);
        if (is_array($dataSiswa)){
            foreach ($dataSiswa as $rank => $data) {
				$i		= $rank+1;
                $det	= self::getDetailRaport($data['nis'], $semester, $tahun);
                if (is_array($det))
                    $query = sprintf("update raport set rank_jur=%d,total_jur=%d where id=%d", $i, $jml, $det[id]);
                else
                    $query = sprintf("insert into raport (nis,tahun_ajaran,semester,rank_jur,total_jur,nip_kepsek,nama_kepsek,tipe) values ('%s',%d,%d,%d,%d,'%s','%s','%s')", mysql_real_escape_string($nis), $tahun, $semester, $i, $jml, mysql_real_escape_string(NIP_KEPSEK), mysql_real_escape_string(NAMA_KEPSEK),$tipe);
                $exe = mysql_query($query);
            }
		}
    }

	//cek wis di generate opo durung
	static function cek_Ranking($kelas, $semester, $tahun) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $dataSiswa = Siswa::getSiswaPerKelas($kelas);
        if (is_array($dataSiswa))
            foreach ($dataSiswa as $siswa) {				              
                $detail = self::getDetailRaport($siswa[nis], $semester, $tahun);
				$data[]= $detail[nilai_kelas];
            }			
			return $data;
    }
	//cek wis di generate opo durung-end
	//masngud
	static function getRankingexport($kelas, $semester, $tahun) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
		$sql	= "SELECT k.nis, s.nama, r.nilai_kelas FROM kelas_siswa k join raport r on k.nis=r.nis join	siswa s on r.nis=s.nis
					where k.kelas=$kelas and r.tahun_ajaran=$tahun and r.semester=$semester and tipe='$tipe' ORDER BY nilai_kelas desc";
		$res['data']	= semua::customZAKYFA($sql);
		$res['kelas']	= semua::get_single_dataZAKYFA('kelas',"id=$kelas");
		return $res;
    }
	//masngud-end*/

    //ini untuk detailnya
    static function getDetailRaport($nis, $semester, $tahun_ajaran) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $nis = mysql_real_escape_string($nis);
        $exe = mysql_query("select 
                                a.*,
                                b.tahun 
                            from 
                                raport a
							left join
                                tahun_ajaran b
							on
								a.tahun_ajaran = b.id
                            where 
                                nis = '$nis' and 
                                semester = '$semester' and 
								tipe = '$tipe' and 
                                tahun_ajaran='$tahun_ajaran'");
        return mysql_fetch_assoc($exe);
    }

    static function getDataPrakerin($raport) {
        $exe = mysql_query("select * from prakerin where raport = '$raport'");
        while ($record = mysql_fetch_assoc($exe))
            $data[] = $record;
        return $data;
    }

    static function getDataKegiatan($raport) {
        $exe = mysql_query("select * from kegiatan where raport = '$raport'");
        while ($record = mysql_fetch_assoc($exe))
            $data[] = $record;
        return $data;
    }

    static function getDataEkstrakulikuler($raport) {
        $exe = mysql_query("select * from prestasi_ekstrakulikuler where raport = '$raport'");
        while ($record = mysql_fetch_assoc($exe))
            $data[] = $record;
        return $data;
    }

    static function getDataOrganisasi($raport) {
        $exe = mysql_query("select * from prestasi_organisasi where raport = '$raport'");
        while ($record = mysql_fetch_assoc($exe))
            $data[] = $record;
        return $data;
    }

    //akhir dari detail
    //ubah Raport
  //$simpan = Raport::editRaport($nis, $semester, $nama_kegiatan, $predikat_kegiatan, $sakit, $ijin, $alpa, $eskul, $keter, $pred, $org, $tanggal, $naik, $catatan,$pernyataan, $_SESSION[tahun_ajaran]);
    static function editRaport($nis, $semester, $nama_kegiatan, $predikat_kegiatan, $sakit, $ijin, $alpa, $eskul, $keter, $pred, $org, $tanggal, $naik, $catatan,$pernyataan, $tahun) {
		$tipe = ($_SESSION['tipe_nilai']=='%') ? 'as' : 'ts';
        $nis = mysql_real_escape_string($nis);
        $tanggal = substr($tanggal, 6, 4) . '-' . substr($tanggal, 3, 2) . '-' . substr($tanggal, 0, 2);
        $data = self::getDetailRaport($nis, $semester, $tahun);        
        if (is_array($data)) {
            $query = sprintf("update raport set nip_kepsek='%s',nama_kepsek='%s',sakit = %d,ijin = %d,alpa = %d,tanggal = '%s',naik = '%s',catatan='%s',pernyataan='%s' where id = %d ", NIP_KEPSEK, mysql_real_escape_string(NAMA_KEPSEK), $sakit, $ijin, $alpa, $tanggal, $naik,$catatan, $pernyataan, $data[id]);           
            
			$exe = mysql_query($query);           
            $i = 0;
            //edit data kegiatan pengembangan diri
            mysql_query("delete from kegiatan where raport = '$data[id]'");
            $i = 0;
            if (is_array($nama_kegiatan))
                foreach ($nama_kegiatan as $kegiatan) {
                    if ($kegiatan && $predikat_kegiatan[$i])
                        mysql_query("insert into kegiatan values(null,'$data[id]','" . mysql_real_escape_string($kegiatan) . "','$predikat_kegiatan[$i]')");
                    $i++;
                }
            //edit data prestasi dari eskul
            mysql_query("delete from prestasi_ekstrakulikuler where raport = '$data[id]'");
            $i = 0;
            if (is_array($eskul))
                foreach ($eskul as $eskul) {
                    if ($eskul && $pred[$i] && $keter[$i])
                        mysql_query("insert into prestasi_ekstrakulikuler values(null,'$data[id]','" . mysql_real_escape_string($eskul) . "','$pred[$i]','" . mysql_real_escape_string($keter[$i]) . "')");
                    $i++;
                }
            //edit data prestasi organisasi
            mysql_query("delete from prestasi_organisasi where raport = '$data[id]'");
            $i = 0;
            if (is_array($org))
                foreach ($org as $org) {
                    if ($org)
                        mysql_query("insert into prestasi_organisasi values(null,'$data[id]','" . mysql_real_escape_string($org) . "')");
                    $i++;
                }
            return TRUE;
        }else {
            //tambah data raport
            $query = sprintf("insert into raport (nis,tahun_ajaran,semester, sakit, ijin, alpa, tanggal, naik, catatan, pernyataan, nip_kepsek, nama_kepsek, tipe) 
			values(null,'%s',%d,%d,%d,%d,%d,'%s','%s','%s','%s','%s','%s','%s')",
			mysql_real_escape_string($nis), $tahun, $semester, $sakit, $ijin, $alpa, mysql_real_escape_string($tanggal), $naik, $catatan,$pernyataan, NIP_KEPSEK, mysql_real_escape_string(NAMA_KEPSEK),$tipe);
            mysql_query($query);
            $id = mysql_insert_id();            
            $i = 0;
            if (is_array($nama_kegiatan))
                foreach ($nama_kegiatan as $kegiatan) {
                    if ($kegiatan && $predikat_kegiatan[$i])
                        mysql_query("insert into kegiatan values(null,'$id','" . mysql_real_escape_string($kegiatan) . "','$predikat_kegiatan[$i]')");
                    $i++;
                }
            //tambah data prestasi eskul
            $i = 0;
           $i = 0;
            if (is_array($eskul))
                foreach ($eskul as $eskul) {
                    if ($eskul && $pred[$i] && $keter[$i])
                        mysql_query("insert into prestasi_ekstrakulikuler values(null,'$data[id]','" . mysql_real_escape_string($eskul) . "','$pred[$i]','" . mysql_real_escape_string($keter[$i]) . "')");
                    $i++;
                }
            //tambah data prestasi organisasi
            $i = 0;
            if (is_array($org))
                foreach ($org as $org) {
                    if ($org)
                        mysql_query("insert into prestasi_organisasi values(null,'$id','" . mysql_real_escape_string($org) . "')");
                    $i++;
                }
            return true;
        }
    }

}

?>
