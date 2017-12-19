<?

	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	$db->query("DELETE FROM proudcts WHERE Product_ID='".$db->escape($_POST['id'])."'");

?>
