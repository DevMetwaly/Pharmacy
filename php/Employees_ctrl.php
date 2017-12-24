<?

	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	
	switch($_GET['action']){
	
	$mysqltime = date ("Y-m-d H:i:s", $phptime);
	ECHO $mysqltime;
	$db->query
	("
		INSERT INTO empolyees (
						Empolyee_ID, Pharmacy_ID, FName, LName, Phone, Address, Type, User_Name, Password, Salary, Hire_Date, Shift
						) 
		VALUES 
		(
			NULL,	
			'".$db->escape($_POST['Pharmacy_ID`'])."',
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
	");
	
	
	case 'table':
		$res=$db->fetch("SELECT Empolyee_ID,FName,LName,Phone,Address,Type,User_Name,Shift,Salary,Pharmacy_Number,Hire_Date FROM empolyees,pharmacies WHERE pharmacies.Pharmacy_ID=empolyees.Pharmacy_ID",true);

		echo (json_encode($res,JSON_PRETTY_PRINT));
	break;
{
?>
