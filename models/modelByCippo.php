<?php
	//Tes
	class ModelByCippo {
		static function tesArray4($dataArray, $nama_variabel, $tab_induk = 0) {			
			if(is_array($dataArray)){
				
				//jumlah tab masuk
				for ($i=0; $i < $tab_induk; $i++) $tab .= "&nbsp; ";
				//if ($tab_induk==0) 
					echo "<br /> $tab --- Array untuk --- $nama_variabel --- ";

				foreach ($dataArray as $key => $value) {
					echo "<br /> $tab $key => "; 
					echo (is_array($value) ) ? "" : "$value";

					if(is_array($value)){
						$tab_anak = $tab_induk + 5;
						self::tesArray4($value, "\$key:", $tab_anak);						
					}					
				}
			}else{
				echo "<br /> $nama_variabel = $dataArray";
			}
		}


	}
?>