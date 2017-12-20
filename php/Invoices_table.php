<?

	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	$res=$db->fetch("Select * FROM Invoices
			
		",true);
	
	echo (json_encode($res,JSON_PRETTY_PRINT));

?>
