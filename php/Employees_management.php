<?

	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	$db->query("INSERT INTO `empolyees` (`Empolyee_ID`, `Pharmacy_ID`, `FName`, `LName`, `Phone`, `Address`,
	`Type`, `User_Name`, `Password`, `Salary`, `Hire_Date`, `Shift`) 
	VALUES (NULL,	
	'".$db->escape($_POST['Pharmacy_ID`'])."',
	'".$db->escape($_POST['FName'])."' ,
	'".$db->escape($_POST['LName'])."', 
	'".$db->escape($_POST['Phone'])."',
	'".$db->escape($_POST['Address'])."',
	'".$db->escape($_POST['Type'])."' 
	, '".$db->escape($_POST['User_Name'])."', 
	'".$db->escape($_POST['Password'])."',
	'".$db->escape($_POST['Salary'])."', 
	'".$db->escape($_POST['Hire_Date'])."', 
	'".$db->escape($_POST['Shift'])."'");

?>
