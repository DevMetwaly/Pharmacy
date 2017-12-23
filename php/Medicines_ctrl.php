<?

ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');

$db->query
	("

		insert into medicines 
			(
				Medicin_ID,
				Name,
				Description,
				Supplier_ID
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
