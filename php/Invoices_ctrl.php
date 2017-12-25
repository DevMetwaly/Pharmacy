<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
switch($_GET['action']){
	case "search":
		if($_POST){
		$inv=$db->fetch("SELECT Product_ID,Name FROM medicines,proudcts WHERE Name LIKE '%".$db->escape($_POST["q"])."%' AND Pharmacy_ID='".$_SESSION["user"]["Pharmacy_ID"]."' AND proudcts.Medicine_ID=medicines.Medicin_ID AND Quantity >0 AND Expire_Date > '".date('Y-m-d')."' LIMIT 10",true);
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
		$customer_id=($_POST["Phone"]!="")? ($customer==null) ? -1:$customer["Customer_ID"]:1;
		$invoice_id=0;
		if($customer_id == -1){
		$customer=$db->query("INSERT INTO customers (Customer_ID, Name, Address, Phone)
				VALUES (NULL, '".$db->escape($_POST['Name'])."', '".$db->escape($_POST['Address'])."','".$db->escape($_POST['Phone'])."')");
		$customer_id=$db->lastrow();
		}
		if($_POST["invoices"]!="[]"){
		$total=0;
		$items=json_decode($_POST["invoices"]);
			foreach ($items as $item){
			 $total+=$item->Price*$item->Quantity;
			}

		$invoice=$db->query("INSERT INTO invoices (Invoice_ID,Empolyee_ID,Customer_ID,Totoal,Date)
		VALUES (NULL,'".$_SESSION["user"]["Empolyee_ID"]."','".$customer_id."','".$total."',NOW())");
		$invoice_id=$db->lastrow();
		foreach ($items as $item){
		$db->query("INSERT INTO soldproudcts (Product_ID,Invoice_ID,Quantity)
		VALUES('".$item->Product_ID."','".$invoice_id."','".$item->Quantity."')");
		$db->query("UPDATE proudcts SET Quantity=Quantity - ".$item->Quantity." WHERE Product_ID='".$item->Product_ID."'");
		}
			$re["type"]="success";
			$re["msg"]="Invoice Printed Successfully";
		}else{
			$re["type"]="error";
			$re["msg"]="Invoice Printed Unsuccessfully";
		}
		echo (json_encode($re,JSON_PRETTY_PRINT));

	break;
}

