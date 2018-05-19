<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');

$arr=array();
switch($_GET['action']){
	case 'info':
		ECHO (json_encode($_SESSION["user"],JSON_PRETTY_PRINT));
	break;
	

}


?>