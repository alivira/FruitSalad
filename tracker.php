<?php
	

//Get job
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "");
	$stmt = $db->query("SELECT * FROM jobs WHERE (jobstatus='INCOMPLETE') OR (jobstatus='INPROGRESS' AND NOW() - `lastsent` > 3600) LIMIT 1");


	//Send it out!
	header("Content-type: application/json");
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		//Update job's lastsent
		$db->exec("UPDATE jobs SET lastsent=NOW() WHERE jobid=" . $row['jobid']);
		echo json_encode($row);
		echo "\n";
	}
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
}





?>

