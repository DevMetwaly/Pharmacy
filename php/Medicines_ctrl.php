<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
//$res=$db->fetch("SELECT * FROM medicines m,suppliers where suppliers.Supplier_ID=medicines.Supplier_ID",true);
$db->query
	("

		insert into m medicines 
			(
				m.Medicine_ID,
				m.Name,
				m.Description,
				m.Supplier_IDs
			)
		values 
			(
				NULL,
				'".$db->escape($_POST['Name'])."',
				'".$db->escape($_POST['Description'])."',
				'".$db->escape($_POST['Supplier_IDs'])."'
			)
	");
?>
