<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
switch($_GET['action']){
	case 'add':
		$mysqltime = date ("Y-m-d H:i:s");
			if($db->query
				("
					INSERT INTO empolyees (
									Empolyee_ID, Pharmacy_ID, FName, LName, Phone, Address, Type, User_Name, Password, Salary, Hire_Date, Shift
									) 
					VALUES 
					(
						NULL,	
						'".$db->escape($_POST['Pharmacy_ID'])."',
						'".$db->escape($_POST['FName'])."' ,
						'".$db->escape($_POST['LName'])."', 
						'".$db->escape($_POST['Phone'])."',
						'".$db->escape($_POST['Address'])."',
						'".$db->escape($_POST['Type'])."',
						'".$db->escape($_POST['User_Name'])."', 
						'".md5($db->escape($_POST['Password']))."',
						'".$db->escape($_POST['Salary'])."', 
						'$mysqltime', 
						'".$db->escape($_POST['Shift'])."'
					)
				"))
				{
					$re["type"]="success";
					$re["msg"]="New Empolyee Added";
					$re["ID"]=$db->lastrow();
				}
			else
				{
					$re["type"]="success";
					$re["msg"]="New Empolyee Added";
					$re["ID"]=$db->lastrow();
				}
				
		ECHO (json_encode($re,JSON_PRETTY_PRINT));
	break;
	
	
	
	case 'table':
		$res=$db->fetch
			("
				SELECT 
					Empolyee_ID,
					FName,
					LName,
					Phone,
					Address,
					Type,
					User_Name,
					Shift,
					Salary,
					Pharmacy_Number,
					Hire_Date
				FROM 
					empolyees,
					pharmacies 
				WHERE pharmacies.Pharmacy_ID=empolyees.Pharmacy_ID
			",true);
			
		ECHO (json_encode($res,JSON_PRETTY_PRINT));
	break;
	
	
	
	case 'delete':
		if($db->query
			("
				DELETE FROM empolyees WHERE Empolyee_ID='".$db->escape($_POST['Empolyee_ID'])."'
			"))
			{
				$re["type"]="success";
				$re["msg"]="Employee Deleted Successfully";
			}
		else
			{
				$re["type"]="error";
				$re["msg"]="Employee Deleted Unsuccessfully";
			}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	
	break;
	
	case "auto":
		if($_POST){
			$num=$db->fetch("SELECT Empolyee_ID,User_Name from empolyees WHERE User_Name Like '%".$db->escape($_POST['q'])."%'",true);
			echo (json_encode(($num==null)?[]:$num,JSON_PRETTY_PRINT));
		}
	break;
	
	case "number":
		if($_POST){
			$num=$db->fetch("SELECT * from  empolyees WHERE Empolyee_ID ='".$db->escape($_POST["q"])."'",false);
			echo (json_encode($num,JSON_PRETTY_PRINT));
		}
	break;
	
	
	
	case 'edit':
		if($db->query
			("
				UPDATE empolyees 
				SET 
					FName='".$db->escape($_POST['FName'])."',
					LName= '".$db->escape($_POST['LName'])."',
					Pharmacy_ID= '".$db->escape($_POST['Pharmacy_ID'])."',
					Phone= '".$db->escape($_POST['Phone'])."',
					Address= '".$db->escape($_POST['Address'])."',
					Type= '".$db->escape($_POST['Type'])."',

					".(($_POST['Password'] !="") ?"Password= '".md5($db->escape($_POST['Password']))."',":"")."
					Salary= '".$db->escape($_POST['Salary'])."',
					Hire_Date= '".$db->escape($_POST['Hire_Date'])."',
					Shift= '".$db->escape($_POST['Shift'])."'
				WHERE User_Name='".$db->escape($_POST['User_Name'])."'
						
			"))
				{
					$re["type"]="success";
					$re["msg"]="Employee Edited Successfully";
				}
		else
				{
					$re["type"]="error";
					$re["msg"]="Employee Edited Unsuccessfully";
				}
		echo (json_encode($re,JSON_PRETTY_PRINT));		
	break;
	
}
?>
