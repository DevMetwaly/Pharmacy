<?
	ob_start();
	session_start();
	include_once("MySQLi.php");
	header('Content-Type: application/json');
	$Phones 	= 	json_decode(stripslashes($_POST['Phones']));
	
	$db->query("
		INSERT INTO pharmacies 
			(
				Pharmacy_ID,
				Pharmacy_Number,
				Location
			) 
		VALUES 
			(
				NULL,
				'".$db->escape($_POST['PhNum'])."',
				'".$db->escape($_POST['PhAdd'])."'
			);
	");
	$res=$db->fetch("
		SELECT Pharmacy_ID FROM pharmacies 
		Where 1 ORDER by Pharmacy_ID DESC limit 1
	",false);
	$ID=$res['Pharmacy_ID'];
	for ($i=0;$i<count($Phones);$i++){
		
		$db->query("
			INSERT INTO phones 
				(
					phone,
					Pharmacy_ID
				) 
			VALUES 
				(
					'".$db->escape($Phones[$i])."',
					'".$ID."'
				);
		");
	}
	



?>