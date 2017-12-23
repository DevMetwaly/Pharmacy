<?

	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	if($db->query("
		INSERT INTO customers (Customer_ID, Name, Address, Phone)
		VALUES (NULL, '".$db->escape($_POST['Name'])."', '".$db->escape($_POST['Address'])."','".$db->escape($_POST['Phone'])."')
	")){
		$re["type"]="success";
		$re["msg"]="New Customer Added";
	}else{
		$re["type"]="error";
	    $re["msg"]="Customer Already Exist";
	}
	echo (json_encode($re,JSON_PRETTY_PRINT));
	

?>
