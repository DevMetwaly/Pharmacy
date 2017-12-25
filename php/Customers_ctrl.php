<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
switch($_GET['action']){
	
	
	case "add":
		if($db->query
			("
				INSERT INTO customers 
					(
						Customer_ID,
						Name,
						Address,
						Phone
					)
				VALUES 
					(
						NULL,
						'".$db->escape($_POST['Name'])."',
						'".$db->escape($_POST['Address'])."',
						'".$db->escape($_POST['Phone'])."'
					)
			"))
				{
					$re["type"]="success";
					$re["msg"]="New Customer Added";
				}
		else
			{
				$re["type"]="error";
				$re["msg"]="Customer Already Exist";
			}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
	
	
	case "edit":
		if($db->query
			("
				UPDATE customers 
				SET Name='".$db->escape($_POST['Name'])."',
					Address= '".$db->escape($_POST['Address'])."',
					Phone='".$db->escape($_POST['Phone'])."'
				WHERE Phone='".$db->escape($_POST['SPhone'])."'
			"))
				{
					$re["type"]="success";
					$re["msg"]="Customer Edited Successfully";
				}
			else
				{
				$re["type"]="error";
				$re["msg"]="Customer Edited Unsuccessfully";
				}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
	
	case "delete":
		if($db->query("
				DELETE FROM customers WHERE Phone='".$db->escape($_POST['SPhone'])."'
			")){
				$re["type"]="success";
				$re["msg"]="Customer Deleted Successfully";
			}else{
				$re["type"]="error";
				$re["msg"]="Customer Deleted Unsuccessfully";
		}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
	
	case "auto":
		if($_POST){
			$num=$db->fetch("SELECT Customer_ID,Phone from  customers WHERE Phone Like '%".$db->escape($_POST["q"])."%'",true);
			echo (json_encode(($num==null) ?[]:$num,JSON_PRETTY_PRINT));
		}
	break;
	
	case "number":
		if($_POST){
			$num=$db->fetch("SELECT * from  customers WHERE Customer_ID ='".$db->escape($_POST["q"])."'",false);
			echo (json_encode($num,JSON_PRETTY_PRINT));
		}
	break;
}


?>
