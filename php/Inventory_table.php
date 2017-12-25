<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
switch ($_GET['action']){
case "":
	$res=$db->fetch("

	SELECT p.Product_ID, m.Name as M_Name, p.Price, p.Quantity, p.Expire_Date, p.Barcode, x.Pharmacy_ID
	FROM proudcts p
	JOIN medicines m ON p.Medicine_ID=m.Medicin_ID 
	JOIN pharmacies x ON p.pharmacy_ID=x.pharmacy_ID

	",true);

	echo (json_encode($res,JSON_PRETTY_PRINT));
break;
case "delete":
	if($db->query("DELETE FROM proudcts WHERE Product_ID='".$db->escape($_POST['id'])."'")){
		$re["type"]="success";
		$re["msg"]="Product Deleted Successfully";
	}
	else
	{
		$re["type"]="error";
		$re["msg"]="Product Deleted Unsuccessfully";
	}
	echo (json_encode($re,JSON_PRETTY_PRINT));
break;
}

?>
