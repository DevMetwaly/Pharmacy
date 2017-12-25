<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
$res=$db->fetch
	("
		SELECT 
			m.Medicin_ID,
			m.Name as M_Name,
			m.Description,
			s.Supplier_ID,
			s.Name as S_Name
		FROM medicines m 
		JOIN suppliers s ON m.Supplier_ID=s.Supplier_ID
	",true);
echo (json_encode($res,JSON_PRETTY_PRINT));
	
?>
