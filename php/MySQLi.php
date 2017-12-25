<?php
class db {
public function __construct($user, $password, $database, $host='localhost') {
$this->user = $user;
$this->password = $password;
$this->database = $database;
$this->host = $host;
$this->db="";
}
protected function connect() {
	$this->db= new mysqli($this->host, $this->user, $this->password, $this->database);
	$this->db->set_charset('utf8');
	return $this->db;
}
public function query($query){
	$db = $this->connect();
	return $db->query($query) or trigger_error($db->error);
}
public function lastrow(){
	return $this->db->insert_id;
}

public function fetch($query,$loop=false){
	$db = $this->connect();
	$result= $db->query($query) or die($db->error);
	if(!$loop){
		return $result->fetch_array(MYSQLI_ASSOC);
	}
	else{
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$results[] = $row ;
		}
		if(isset($results))
			return $results;
		
	}
	
	return false;
}
public function num($query){
	$db = $this->connect();
	$result =$db->query($query) or trigger_error($db->error);
	return $result->num_rows;
	$db->close;
	}
	public function escape($string){
	$db = $this->connect();
	return (htmlspecialchars($db->escape_string($string)));
	$db->close;
	}
}
$permission=["Sales"=>
["pharmacies","customers","invoices","inventory","suppliers","ctrl_suppliers","ctrl_medicines","ctrl_customers"],
"Pharmacist"=>
["customers","inventory","medicines","ctrl_invoices","ctrl_customers","ctrl_medicines"]];
function fname($file){
	$name=explode("_",strtolower($file));
	if($name[1] !="table")
	return $name[1]."_".$name[0];
	return $name[0];	
	
}
$db = new db('root','','ph');

?>