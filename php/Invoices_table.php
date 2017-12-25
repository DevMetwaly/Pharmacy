<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
$res=$db->fetch("
		SELECT sp.Invoice_ID, cu.Name as CU_NAME, emp.FName, emp.LName, med.Name as MED_NAME,i.Totoal,i.Date as Datee,ph.Pharmacy_ID FROM soldproudcts sp
		JOIN invoices i ON i.Invoice_ID=sp.Invoice_ID 
		JOIN proudcts p ON p.Product_ID=sp.Product_ID
		JOIN empolyees emp ON emp.Empolyee_ID=i.Empolyee_ID 
		JOIN medicines med ON med.Medicin_ID=p.Medicine_ID
		JOIN customers cu ON cu.Customer_ID=i.Customer_ID
		JOIN pharmacies ph ON ph.Pharmacy_ID=p.Pharmacy_ID
		ORDER by i.Invoice_ID
	",true);
$arr=array();
$last=0;
for($i=0; $i<count($res);$i++){
	if($res[$i]["Invoice_ID"]!=$last){
		$arr[]=$res[$i];
		$last=$res[$i]["Invoice_ID"];
	}else{
		$arr[count($arr)-1]["MED_NAME"].=("<br>".$res[$i]["MED_NAME"]);
	}
	
}

echo (json_encode($arr,JSON_PRETTY_PRINT));

?>
