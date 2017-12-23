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
	return $db->query($query);
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
$db = new db('root','','ph');

?>