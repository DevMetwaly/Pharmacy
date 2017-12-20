<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
switch($_GET['action']){
case "search":
$inv=$db->fetch("SELECT Product_ID,Name,Barcode,Expire_Date,Quantity FROM medicines,proudcts WHERE Name LIKE '%".$db->escape($_POST["q"])."%' AND proudcts.Medicine_ID=medicines.Medicin_ID AND Quantity >0 AND Expire_Date > '".date('Y-m-d')."'",true);
echo (json_encode($inv,JSON_PRETTY_PRINT));
break;
case "get":
$inv=$db->fetch("SELECT Product_ID,Name,Barcode,Expire_Date,Quantity FROM medicines,proudcts WHERE Product_ID='".$db->escape($_POST["q"])."' AND proudcts.Medicine_ID=medicines.Medicin_ID AND Quantity >0 AND Expire_Date > '".date('Y-m-d')."'",false);
echo (json_encode($inv,JSON_PRETTY_PRINT));
break;

}

