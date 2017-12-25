<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
switch($_GET['action']){
	
	case 'add':
		if($db->query
			("
				INSERT INTO suppliers
					(
						Supplier_ID,
						Name,
						Phone,
						Location,
						Email
					)
				VALUES 
					(
						NULL,
						'".$db->escape($_POST['Name'])."',
						'".$db->escape($_POST['Phone'])."',
						'".$db->escape($_POST['Loc'])."',
						'".$db->escape($_POST['Email'])."'
					)
			"))
				{
					$re["type"]="success";
					$re["msg"]="New Supplier Added";
					$re["ID"]=$db->lastrow();
				}
		else
				{
					$re["type"]="error";
					$re["msg"]="Supplier Already Exist";
					$re["ID"]=$db->lastrow();
				}
		echo (json_encode($re,JSON_PRETTY_PRINT));
		
	break;
	
	
	
	case 'edit':
		if($db->query
			("
				UPDATE suppliers 
				SET 
					Name='".$db->escape($_POST['Name'])."',
					Location= '".$db->escape($_POST['Loc'])."',
					Phone='".$db->escape($_POST['Phone'])."',
					Email='".$db->escape($_POST['Email'])."'
				WHERE Supplier_ID='".$db->escape($_POST['Supplier_ID'])."'
						
			"))
				{
					$re["type"]="success";
					$re["msg"]="Supplier Edited Successfully";
				}
		else
				{
					$re["type"]="error";
					$re["msg"]="Supplier Edited Unsuccessfully";
				}
		echo (json_encode($re,JSON_PRETTY_PRINT));				
	break;
	case 'delete':
		if($db->query
			("
				DELETE FROM suppliers WHERE Supplier_ID='".$db->escape($_POST['Supplier_ID'])."'
			"))
			{
				$re["type"]="success";
				$re["msg"]="Supplier Deleted Successfully";
			}
		else
			{
				$re["type"]="error";
				$re["msg"]="Supplier Deleted Unsuccessfully";
			}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	break;

	case 'comp':
		$res=$db->fetch
			("
				SELECT * FROM suppliers 
				WHERE Supplier_ID='".$db->escape($_POST['Supplier_ID'])."'
			",false);
		ECHO (json_encode($res,JSON_PRETTY_PRINT));
		
	break;
	
	
}

?>