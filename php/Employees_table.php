<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
$res=$db->fetch("SELECT Empolyee_ID,FName,LName,Phone,Address,Type,User_Name,Shift,Salary,Pharmacy_Number,Hire_Date FROM empolyees,pharmacies WHERE pharmacies.Pharmacy_ID=empolyees.Pharmacy_ID",true);

echo (json_encode($res,JSON_PRETTY_PRINT));

?>
