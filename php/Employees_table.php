<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
$res=$db->fetch("SELECT * FROM empolyees",true);

echo (json_encode($res|array(),JSON_PRETTY_PRINT));

?>
