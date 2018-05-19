<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');



switch($_GET['action']){
	case 'info':
		ECHO (json_encode($_SESSION["user"],JSON_PRETTY_PRINT));
	break;

	case 'check':
		$res = $db->fetch
			("
				SELECT * 
				FROM empolyees
				WHERE Empolyee_ID = '".$db->escape($_SESSION["user"]["Empolyee_ID"])."' and Password = '".md5($db->escape($_POST["CrrPass"]))."';
			");
		if(count($res)){
			$re["type"]="Success";
			$re["msg"]="Password Correct";
		}else{
			$re["type"]="Fail";
			$re["msg"]="Password Wrong";
		}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
	case 'update':
		if($db->query("
						UPDATE empolyees
						SET FName 	= '".$db->escape($_POST['Fname'])."',
							LName 	= '".$db->escape($_POST['LName'])."',
							Address = '".$db->escape($_POST['Address'])."',
							Phone 	= '".$db->escape($_POST['Phone'])."',
							User_Name= '".$db->escape($_POST['UserName'])."',
							Password= '".md5($db->escape($_POST['NewPass']))."'
						WHERE
							Empolyee_ID = '".$db->escape($_SESSION["user"]["Empolyee_ID"])."';

					")
		){
			$re["type"]="Success";
			$re["msg"]="Data Updated Successfully";

		}
		else{
			$re["type"]="Fail";
			$re["msg"]="Data Updated Unsuccessfully";

		}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
}


/*$user=$db->Fetch
				("
					SELECT * 
					FROM empolyees 
					WHERE Empolyee_ID='".$db->escape($_POST["Empolyee_ID"])."';
				");

*/
?>


