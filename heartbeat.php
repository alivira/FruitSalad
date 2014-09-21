<?php
$db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "What is systems?");

$preStmt = $db->prepare("SELECT * FROM clients WHERE clientip=:ip LIMIT 1");

$preStmt->execute(array("ip" => $_SERVER["REMOTE_ADDR"]));
$row = $preStmt->fetch(PDO::FETCH_ASSOC);
echo print_r($row);
if ($row) {
	$db->prepare("UPDATE clients SET lastheartbeat=NOW(), active=TRUE WHERE clientid=:id")->execute(array("id" => $row['clientid']));
} else {
	$db->prepare("INSERT INTO clients (lastheartbeat, clientip, active) VALUES (NOW(), :clientip, TRUE)")->execute(array("clientip" => $_SERVER['REMOTE_ADDR']));
}


?>
