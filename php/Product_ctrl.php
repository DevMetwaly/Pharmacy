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
				$re["msg"]="New Product Added";
				$re["ID"]=$db->lastrow();
			}
		else	
			{
				$re["type"]="error";
				$re["msg"]="Product Already Exist";
				$re["ID"]=$db->lastrow();
			}
		echo (json_encode($re,JSON_PRETTY_PRINT));	
	break;
	


	case 'delete':
		if($db->query
			("
				DELETE FROM proudcts WHERE Product_ID='".$db->escape($_POST['Product_ID'])."'
			"))
			{
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
	
	case 'edit':
		if($db->query
			("
				UPDATE proudcts 
				SET 
					Pharmacy_ID='".$db->escape($_POST['Pharmacy'])."',
					Price='".$db->escape($_POST['Price'])."',
					Quantity='".$db->escape($_POST['Quantity'])."',
					Expire_Date='".$db->escape($_POST['ExpireDate'])."',
					Barcode='".$db->escape($_POST['Barcode'])."'
				WHERE Product_ID='".$db->escape($_POST['Product_ID'])."'
						
			"))
				{
					$re["type"]="success";
					$re["msg"]="Product Edited Successfully";
				}
		else
				{
					$re["type"]="error";
					$re["msg"]="Product Edited Unsuccessfully";
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
			$num=$db->fetch("SELECT Product_ID,Name from medicines,proudcts WHERE Name Like '%".$db->escape($_POST['q'])."%' and proudcts.Medicine_ID=medicines.Medicin_ID",true);
			echo (json_encode(($num==null)?[]:$num,JSON_PRETTY_PRINT));
		}
	break;
	
	case "number":
		if($_POST){
			$num=$db->fetch("SELECT * from  proudcts,medicines WHERE Product_ID ='".$db->escape($_POST["q"])."' and Medicin_ID=Medicine_ID",false);
			echo (json_encode($num,JSON_PRETTY_PRINT));
		}
	break;
	
	
}
?>
