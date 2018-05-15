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

				insert into proudcts 
					(
						Product_ID,
						Pharmacy_ID,
						Price,
						Quantity,
						Expire_Date,
						Barcode,
						Medicine_ID
					)
				values 
					(
						NULL,
						'".$db->escape($_POST['Pharmacy'])."',
						'".$db->escape($_POST['Price'])."',
						'".$db->escape($_POST['Quantity'])."',
						'".$db->escape($_POST['ExpireDate'])."',
						'".$db->escape($_POST['Barcode'])."',
						'".$db->escape($_POST['Medicin_ID'])."'		
					)
			"))
			
			{
				$re["type"]="success";
				$re["msg"]="New Medicine Added";
				$re["ID"]=$db->lastrow();
			}
		else	
			{
				$re["type"]="error";
				$re["msg"]="Medicine Already Exist";
				$re["ID"]=$db->lastrow();
			}
		echo (json_encode($re,JSON_PRETTY_PRINT));	
	break;
	


	case 'delete':
		if($db->query
			("
				DELETE FROM medicines WHERE Medicin_ID='".$db->escape($_POST['Medicin_ID'])."'
			"))
			{
				$re["type"]="success";
				$re["msg"]="Medicine Deleted Successfully";
			}
		else
			{
				$re["type"]="error";
				$re["msg"]="Medicine Deleted Unsuccessfully";
			}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	
	break;
	
	case 'edit':
		if($db->query
			("
				UPDATE medicines 
				SET 
					Name='".$db->escape($_POST['Name'])."',
					Description= '".$db->escape($_POST['Description'])."',
					Supplier_ID='".$db->escape($_POST['Supplier_ID'])."'
				WHERE Medicin_ID='".$db->escape($_POST['Medicin_ID'])."'
						
			"))
				{
					$re["type"]="success";
					$re["msg"]="Medicine Edited Successfully";
				}
		else
				{
					$re["type"]="error";
					$re["msg"]="Medicine Edited Unsuccessfully";
				}
		echo (json_encode($re,JSON_PRETTY_PRINT));		
	break;
	
	
	/*case 'comp':
		$res=$db->fetch
			("
				SELECT * FROM medicines 
				WHERE Medicin_ID='".$db->escape($_POST['Medicin_ID'])."'
			",false);
		ECHO (json_encode($res,JSON_PRETTY_PRINT));
		
	break;*/
	
	case "auto":
		if($_POST){
			$num=$db->fetch("SELECT Medicin_ID,Name from medicines WHERE Name Like '%".$db->escape($_POST['q'])."%'",true);
			echo (json_encode(($num==null)?[]:$num,JSON_PRETTY_PRINT));
		}
	break;
	
	case "number":
		if($_POST){
			$num=$db->fetch("SELECT * from  medicines WHERE Medicin_ID ='".$db->escape($_POST["q"])."'",false);
			echo (json_encode($num,JSON_PRETTY_PRINT));
		}
	break;
	
	case 'delete':
		if($db->query
			("
				DELETE FROM medicines WHERE Medicin_ID='".$db->escape($_POST['Medicin_ID'])."'
			"))
			{
				$re["type"]="success";
				$re["msg"]="Medicine Deleted Successfully";
			}
		else
			{
				$re["type"]="error";
				$re["msg"]="Medicine Deleted Unsuccessfully";
			}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
	
		
	
}
?>
