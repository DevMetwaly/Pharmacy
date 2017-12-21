<?

	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	echo $_POST['Name'];
	echo $_POST['Address'];
	echo $_POST['Phone'];
	$db->query("
		INSERT INTO customers (Customer_ID, Name, Address, Phone)
		VALUES (NULL, '".$db->escape($_POST['Name'])."', '".$db->escape($_POST['Address'])."','".$db->escape($_POST['Phone'])."')
	");

?>
