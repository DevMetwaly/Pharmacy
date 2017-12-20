<?

	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	$res=$db->fetch("
			SELECT sp.Invoice_ID, cu.Name as CU_NAME, emp.FName, emp.LName, med.Name as MED_NAME,i.Totoal,i.Date,ph.Pharmacy_ID FROM soldproudcts sp
			JOIN invoices i ON i.Invoice_ID=sp.Invoice_ID 
			JOIN proudcts p ON p.Product_ID=sp.Product_ID
			JOIN empolyees emp ON emp.Empolyee_ID=i.Empolyee_ID 
			JOIN medicines med ON med.Medicin_ID=p.Medicine_ID
			JOIN customers cu ON cu.Customer_ID=i.Customer_ID
			JOIN pharmacies ph ON ph.Pharmacy_ID=p.Pharmacy_ID
			ORDER by i.Invoice_ID
		",true);
	
	echo (json_encode($res,JSON_PRETTY_PRINT));

?>
