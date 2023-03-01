<?php
    session_start();
	$_SESSION ['logged'] = false;
    session_destroy();
	unset($_SESSION['nip']);
    unset($_SESSION['kurikulum']); 
	unset($_SESSION['tahun_ajaran']);
	unset($_SESSION['smt']);
	unset($_SESSION['kapro']);
	unset($_SESSION['nama']);
	unset($_SESSION['superad']);
    header('location: index.php');
?>
