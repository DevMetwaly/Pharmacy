<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
$res=$db->fetch("SELECT pharmacies.Pharmacy_ID	,Pharmacy_Number,Location,FName,LName,Phone FROM pharmacies JOIN empolyees ON Empolyee_ID=Pharmacy_Admin",true);
for($i=0; $i<count($res);$i++){
	$x=$db->fetch
		("
			SELECT Phone FROM phones 
			WHERE Pharmacy_ID='".$db->escape($res[$i]["Pharmacy_ID"])."'
		",true);
	
	$res[$i]["phones"] = ($x) ? $x : array(array('Phone'  => ' '));
	
}
echo (json_encode($res,JSON_PRETTY_PRINT));

?>