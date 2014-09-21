<?php
	$NUM_TO_FACTOR = 1000;
	$NUM_PER_JOB = 100;
	$db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "What is systems?");
	for ($i = 0; $i < $NUM_TO_FACTOR / $NUM_PER_JOB; $i++) {
		$db->exec("INSERT INTO jobs (jobdata, jobstatus) VALUES ('" . $NUM_TO_FACTOR . "," . $i * $NUM_PER_JOB . "," . ((($i + 1) * $NUM_PER_JOB) - 1) . "', 'INCOMPLETE')");
		//echo "INSERT INTO jobs (jobdata, jobstatus) VALUES ('" . $i * $NUM_PER_JOB . "," . ((($i + 1) * $NUM_PER_JOB) - 1) . "', INCOMPLETE)";
		echo "<br />";
	}
	echo "DONE!"
?>
