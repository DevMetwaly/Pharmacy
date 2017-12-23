<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
switch($_GET['action']){
case "search":
if($_POST){
	$inv=$db->fetch("SELECT Product_ID,Name FROM medicines,proudcts WHERE Name LIKE '%".$db->escape($_POST["q"])."%' AND proudcts.Medicine_ID=medicines.Medicin_ID AND Quantity >0 AND Expire_Date > '".date('Y-m-d')."' LIMIT 10",true);
	echo (json_encode(($inv==null) ?[]:$inv,JSON_PRETTY_PRINT));
}
break;
case "get":
if($_POST){
	$inv=$db->fetch("SELECT Product_ID,Name,Barcode,Expire_Date,Quantity,Price FROM medicines,proudcts WHERE Product_ID='".$db->escape($_POST["q"])."' AND proudcts.Medicine_ID=medicines.Medicin_ID AND Quantity >0 AND Expire_Date > '".date('Y-m-d')."'",false);
	echo (json_encode($inv,JSON_PRETTY_PRINT));
}
break;
case "getnumber":
if($_POST){
	$num=$db->fetch("SELECT Customer_ID,Phone from  customers WHERE Phone Like '%".$db->escape($_POST["q"])."%'",true);
	echo (json_encode(($num==null) ?[]:$num,JSON_PRETTY_PRINT));
}
break;
case "number":
if($_POST){
	$num=$db->fetch("SELECT * from  customers WHERE Customer_ID ='".$db->escape($_POST["q"])."'",false);
	echo (json_encode($num,JSON_PRETTY_PRINT));
}
break;
case "invoice":
$customer=$db->fetch("SELECT Customer_ID from customers WHERE Phone='".$db->escape($_POST["Phone"])."'",false);
$customer_id=($_POST["Phone"]!="")? ($customer==null) ? -1:$customer["Customer_ID"]:0;
if($customer_id == -1){
$customer_id=$db->query("INSERT INTO customers (Customer_ID, Name, Address, Phone)
		VALUES (NULL, '".$db->escape($_POST['Name'])."', '".$db->escape($_POST['Address'])."','".$db->escape($_POST['Phone'])."')");
	echo json_encode($db->lastrow());
}

break;
}

