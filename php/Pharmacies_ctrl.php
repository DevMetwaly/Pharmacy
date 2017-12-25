<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));

switch ($_GET['action']){
	case "add":
	$Phones 	= 	json_decode(stripslashes($_POST['Phones']));
		$q=$db->query("
		INSERT INTO pharmacies 
			(
				Pharmacy_ID,
				Pharmacy_Number,
				Location
			) 
		VALUES 
			(
				NULL,
				'".$db->escape($_POST['PhNum'])."',
				'".$db->escape($_POST['PhAdd'])."'
			);
		");
		$ID=$db->lastrow();
		if($q){
		for ($i=0;$i<count($Phones);$i++){

		$db->query("
			INSERT INTO phones 
				(
					phone,
					Pharmacy_ID
				) 
			VALUES 
				(
					'".$db->escape($Phones[$i])."',
					'".$ID."'
				);
		");
		
		}}
		if($q){
				$re["type"]="success";
				$re["msg"]="Pharmacy Added Successfully";
			}
		else
			{
				$re["type"]="error";
				$re["msg"]="Pharmacy Added Unsuccessfully";
			}
			echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
	case "edit":
	$Phones 	= 	json_decode(stripslashes($_POST['Phones']));
		$q=$db->query("
		UPDATE pharmacies SET
				Location='".$db->escape($_POST['PhAdd'])."',
				Pharmacy_Admin='".$db->escape($_POST['Admin'])."'
		WHERE
				Pharmacy_ID='".$db->escape($_POST['PhId'])."'
				
		");
		$ID=$db->escape($_POST['PhId']);
		if($q){
		$db->query("DELETE FROM phones WHERE Pharmacy_ID='".$ID."'");
		for ($i=0;$i<count($Phones);$i++){

		$db->query("
			INSERT INTO phones 
				(
					phone,
					Pharmacy_ID
				) 
			VALUES 
				(
					'".$db->escape($Phones[$i])."',
					'".$ID."'
				);
		");
		
		}}
		if($q){
				$re["type"]="success";
				$re["msg"]="Pharmacy Edited Successfully";
			}
		else
			{
				$re["type"]="error";
				$re["msg"]="Pharmacy Edited Unsuccessfully";
			}
			echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
	case "delete":
		if($db->query
			("
				DELETE FROM pharmacies WHERE Pharmacy_ID='".$db->escape($_POST['Pharmacy_ID'])."'
			"))
			{
				$re["type"]="success";
				$re["msg"]="Pharmacy Deleted Successfully";
			}
		else
			{
				$re["type"]="error";
				$re["msg"]="Pharmacy Deleted Unsuccessfully";
			}
		echo (json_encode($re,JSON_PRETTY_PRINT));
	break;
	case "comp":
		$res=$db->fetch("SELECT * FROM pharmacies WHERE Pharmacy_ID='".$db->escape($_POST["Pharmacy_ID"])."'",false);
		$x=$db->fetch
			("
				SELECT Phone FROM phones 
				WHERE Pharmacy_ID='".$db->escape($res["Pharmacy_ID"])."'
			",true);
		
		$res["phones"] = ($x) ? $x : array(array('Phone'  => ' '));
		echo (json_encode($res,JSON_PRETTY_PRINT));
	break;
	
}
?>