<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
$short = array(
  'Jan', 
  'Feb', 
  'Mar', 
  'Apr', 
  'May', 
  'Jun', 
  'Jul', 
  'Aug', 
  'Sep', 
  'Oct', 
  'Nov', 
  'Dec'
);
$inv=$db->fetch("SELECT Sum(Totoal) As Total,Pharmacy_Number,Month(Date) as Month From Invoices 
JOIN Empolyees ON Empolyees.Empolyee_ID=Invoices.Empolyee_ID
JOIN Pharmacies ON Pharmacies.Pharmacy_ID=Empolyees.Pharmacy_ID
WHERE 
 YEAR(Date) = YEAR(CURDATE())
 GROUP BY Month(Date),Pharmacy_Number ORDER BY Month(Date)",true);
$result=array();
// statstics
 $statstics=array();
$ph=$db->Fetch("SELECT Pharmacy_Number FROM Pharmacies ORDER BY Pharmacy_ID",true);
$result["Pharmacies"]=($ph);
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
 echo (json_encode(($result==null) ?[]:$result,JSON_PRETTY_PRINT));