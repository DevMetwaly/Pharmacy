<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
$result=array();
$ph=$db->Fetch("SELECT Pharmacy_Number FROM Pharmacies ORDER BY Pharmacy_ID",true);
$ncust=$db->Fetch("SELECT COUNT(DISTINCT invoices.Customer_ID) as NewCustomer  FROM invoices JOIN customers ON  customers.Customer_ID=invoices.Customer_ID where Day(Date) >=Day(CURDATE())-7 ",false);
$ninv=$db->Fetch("SELECT COUNT(*) as NewInvoice  FROM invoices where Day(Date) >=Day(CURDATE())-7 ",false);
$rest=$db->Fetch("SELECT COUNT(*) as ReStock FROM proudcts WHERE Quantity <= 50",false);
$expi=$db->Fetch("SELECT COUNT(*) as ExpireSoon FROM proudcts WHERE (Expire_Date - INTERVAL 3 MONTH ) <= NOW() and  Expire_Date > NOW()",false);
$solditems=$db->Fetch("SELECT SUM(soldproudcts.Quantity) Sold,Pharmacy_Number FROM soldproudcts JOIN proudcts ON  proudcts.Product_ID=soldproudcts.Product_ID JOIN Pharmacies ON proudcts.Pharmacy_ID=Pharmacies.Pharmacy_ID GROUP BY proudcts.Pharmacy_ID",true);
$sold=array();
for($i=0;$i<count($ph); $i++){
 $sold[$ph[$i]["Pharmacy_Number"]]["label"]="Pharmacy ".$ph[$i]["Pharmacy_Number"]." Sold Product";
 $sold[$ph[$i]["Pharmacy_Number"]]["value"]=0;
}
foreach ($solditems as $item){
	$sold[$item["Pharmacy_Number"]]["value"]=$item["Sold"];
}
$result["sold_statstics"]=$sold;
$short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
$inv=$db->fetch("SELECT Sum(Totoal) As Total,Pharmacy_Number,Month(Date) as Month From Invoices 
JOIN Empolyees ON Empolyees.Empolyee_ID=Invoices.Empolyee_ID
JOIN Pharmacies ON Pharmacies.Pharmacy_ID=Empolyees.Pharmacy_ID
WHERE 
 YEAR(Date) = YEAR(CURDATE())
 GROUP BY Month(Date),Pharmacy_Number ORDER BY Month(Date)",true);
// statstics
$statstics=array();
$result["Pharmacies"]=$ph;
for($i=0;$i<12;$i++){
$statstics[]= element($i,$ph,$short);
}
function element($m,$ph,$short){
	 $r= array("Month" => $short[$m]);
	 foreach ($ph as $p)
	 {
		 $r[$p["Pharmacy_Number"]]=0;
	 }
	 return $r;
 }
foreach($inv as $in){
	$statstics[$in["Month"]-1][$in["Pharmacy_Number"]]=$in["Total"];
}
// statstics
$result["statstics"]=$statstics;
$result["information"][0]=$ncust;$result["information"][1]=$ninv;$result["information"][2]=$expi;$result["information"][3]=$rest;
 echo (json_encode(($result==null) ?[]:$result,JSON_PRETTY_PRINT));