<?php
session_start ();
$do = $_REQUEST['do'];
switch ($do) {
    case 'set':		
		$_SESSION['tahun_ajaran'] = $_POST['tahun'];
		echo json_encode($_SESSION['tahun_ajaran']);
        die();
        break;
	case 'set_smt':
        $_SESSION['smt'] = $_POST['smt'];
		echo json_encode($_SESSION['smt']);
        die();
        break; 
	default:
		break;
}
?>
