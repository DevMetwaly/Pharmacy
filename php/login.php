<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
$user=$db->Fetch("SELECT Empolyee_ID FROM empolyees WHERE User_Name='".$db->escape($_POST["username"])."' AND Password='".md5($db->escape($_POST["password"]))."'");
if(isset($user["Empolyee_ID"])){
	$_SESSION["user"]=$user["Empolyee_ID"];
	$re["type"]="alert-success";
	$re["msg"]="<strong>Login Success!</strong> Redirecting...";
}else{
	$re["type"]="alert-danger";
	$re["msg"]="<strong>Login Error!</strong> Invalid username or password.";
	
}
echo (json_encode($re,JSON_PRETTY_PRINT));
//echo json_encode(($_POST));

?>
