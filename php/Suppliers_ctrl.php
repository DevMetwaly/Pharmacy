<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
$db->query
	("
		INSERT INTO suppliers
			(
				Supplier_ID,
				Name,
				Phone,
				Location,
				Email
			)
		VALUES 
			(
				NULL,
				'".$db->escape($_POST['Name'])."',
				'".$db->escape($_POST['Phone'])."',
				'".$db->escape($_POST['Loc'])."',
				'".$db->escape($_POST['Email'])."'
			)
	");

?>