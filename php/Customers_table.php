<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
$res=$db->fetch("SELECT customers.Customer_ID cid, customers.Name, customers.Address, customers.Phone , SUM(invoices.Totoal) Score FROM customers LEFT JOIN invoices ON invoices.Customer_ID=customers.Customer_ID GROUP BY customers.Customer_ID",true);
echo (json_encode($res,JSON_PRETTY_PRINT));


?>
