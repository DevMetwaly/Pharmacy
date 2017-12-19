<?

	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	$res=$db->fetch("
	
		SELECT p.Product_ID, m.Name as M_Name, p.Price, p.Quantity, p.Expire_Date, p.Barcode, x.Pharmacy_ID
		FROM proudcts p
		JOIN medicines m ON p.Medicine_ID=m.Medicin_ID 
		JOIN pharmacies x ON p.pharmacy_ID=x.pharmacy_ID
		
		",true);
	
	echo (json_encode($res,JSON_PRETTY_PRINT));

?>
