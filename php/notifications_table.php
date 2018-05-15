<?
ob_start();
session_start();
include_once("MySQLi.php");
header('Content-Type: application/json');
if($_SESSION["user"]["Type"]!="Admin" && !in_array(fname(basename(__FILE__, '.php')),$permission[$_SESSION["user"]["Type"]])) die(json_encode(["type"=>"error","msg"=>"Permission Denied"]));
$out=array();
$num1=$db->fetch("SELECT p.Pharmacy_ID as Pharmacy_ID,
                        p.Expire_Date as Expire_Data,
                        m.Name as Name
                FROM proudcts p 
                JOIN medicines m on p.Medicine_ID=m.Medicin_ID
                where Expire_Date <= NOW() ; 
                ");
$out["expired"] =  $num1

$num2=$db->fetch("SELECT p.Pharmacy_ID as Pharmacy_ID,
                        p.Expire_Date as Expire_Data,
                        m.Name as Name
                FROM proudcts p 
                JOIN medicines m on p.Medicine_ID=m.Medicin_ID
                where Expire_Date >= (NOW() -    INTERVAL 1 MONTH ) ; 
                ");
$out["expired_soon"] =  $num2                 
$num3=$db->fetch("SELECT p.Pharmacy_ID as Pharmacy_ID, p.Quantity as Quantity, m.Name as Name 
                FROM proudcts p
                JOIN medicines m on p.Medicine_ID=m.Medicin_ID 
                where Quantity < 20 
                ");
 $out["Quantity_out"] =  $num3  
                echo (json_encode(($out==null) ?[]:$out,JSON_PRETTY_PRINT));
                                          
 ?>                                         