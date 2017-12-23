<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');


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
					$re["msg"]="New Customer Added";
				}
		else
				{
					$re["type"]="error";
					$re["msg"]="Customer Already Exist";
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
					$re["msg"]="Customer Edited Unsuccessfully";
				}
		echo (json_encode($re,JSON_PRETTY_PRINT));				
	break;

	
	case 'table':
		$res=$db->fetch("SELECT * FROM suppliers",true);
		echo (json_encode($res,JSON_PRETTY_PRINT));
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