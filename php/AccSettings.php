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
		include_once("../vendor/uploader/uploader.php");
		$handle = new upload($_FILES['Pic']);
		if ($handle->uploaded) {
		  $handle->file_new_name_body   = $db->escape((($_POST['User_Name']!="")?$_POST['User_Name']:$_SESSION["user"]["User_Name"]));
		  $handle->image_convert = 'png';
		  $handle->file_overwrite = true;
		  $handle->process('../image/');
		  if ($handle->processed) {
			$handle->clean();
		  } else {
			$re["type"]="Fail";
			$re["msg"]="Error Uploading Image";
			die((json_encode($re,JSON_PRETTY_PRINT)));
		  }
		}
		if(
			$db->fetch
			("
				SELECT * 
				FROM empolyees
				WHERE Empolyee_ID = '".$db->escape($_SESSION["user"]["Empolyee_ID"])."' and Password = '".md5($db->escape($_POST["CrrPass"]))."';
			")
			&&
			$db->query("
						UPDATE empolyees
						SET FName 	= '".$db->escape((($_POST['FName']!="")?$_POST['FName']:$_SESSION["user"]["FName"]))."',
							LName 	= '".$db->escape((($_POST['LName']!="")?$_POST['LName']:$_SESSION["user"]["LName"]))."',
							Address = '".$db->escape((($_POST['Address']!="")?$_POST['Address']:$_SESSION["user"]["Address"]))."',
							Phone 	= '".$db->escape((($_POST['Phone']!="")?$_POST['Phone']:$_SESSION["user"]["Phone"]))."',
							User_Name= '".$db->escape((($_POST['User_Name']!="")?$_POST['User_Name']:$_SESSION["user"]["User_Name"]))."',
							Password= '".$db->escape((($_POST['NewPass'] !="")? (($_POST['ConfPass'] !="") ? (($_POST['ConfPass'] == $_POST['NewPass'])? md5($_POST['NewPass']):$_SESSION["user"]["Password"]):$_SESSION["user"]["Password"]):$_SESSION["user"]["Password"]) )."',
							Image ='./image/".$db->escape((($_POST['User_Name']!="")?$_POST['User_Name']:$_SESSION["user"]["User_Name"])).".png'
						WHERE
							Empolyee_ID = '".$db->escape($_SESSION["user"]["Empolyee_ID"])."' AND Password='".md5($db->escape($_POST['CrrPass']))."';

					")
		){
			$_SESSION["user"]=$db->Fetch
				("
					SELECT * 
					FROM empolyees 
					WHERE Empolyee_ID='".$db->escape($_SESSION["user"]["Empolyee_ID"])."'
				");
				
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



?>


