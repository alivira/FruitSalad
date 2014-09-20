<?php
	

$db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "");
//Get job
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$stmt = $db->query("SELECT * FROM jobs WHERE (jobstatus='INCOMPLETE') OR (jobstatus='INPROGRESS' AND NOW() - `lastsent` > 3600) LIMIT 1");


	//Send it out!
	header("Content-type: application/json");
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		//Update job's lastsent
		$db->prepare("UPDATE jobs SET lastsent=NOW() WHERE jobid=:jobid")->execute(array(":jobid" => $row['jobid']));
		echo json_encode($row);
		echo "\n";
	}
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (strlen(file_get_contents('php://input')) == 0 ||
	    !isset($_GET['jobid'])) {
	        header('HTTP/1.1 400 Bad request');
		return;
	}


	//Prepare sql statements
	$preStmt = $db->prepare("UPDATE jobs SET jobresult=:result, jobstatus='COMPLETE' WHERE jobid=:jobid", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));


	//Execute it
	$preStmt->execute(array(":result" => file_get_contents('php://input'), ":jobid" => $_GET['jobid']));
	if ($preStmt->rowCount() > 0) {
	        header('HTTP/1.1 200 OK');
	} else {
		header('HTTP/1.1 404 Not Found');
	}
}





?>

