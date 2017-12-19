<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
//$res=$db->fetch("SELECT * FROM medicines m,suppliers where suppliers.Supplier_ID=medicines.Supplier_ID",true);
$res=$db->fetch("

	SELECT m.Medicin_ID, m.Name as M_Name, m.Description, s.Supplier_ID, s.Name as S_Name
	FROM medicines m 
	JOIN suppliers s
	ON m.Supplier_ID=s.Supplier_ID
	
	",true);
$res=isset($res)?$res:array();
$gg;
echo (json_encode($res,JSON_PRETTY_PRINT));
?>
