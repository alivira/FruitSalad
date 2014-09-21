<?php


$db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "What is systems?");

//Get job
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $ip = $_SERVER['REMOTE_ADDR'];
        $clientid = $db->query("SELECT clientid
                                FROM clients
                                WHERE clientip ='" . $ip . "'
                                LIMIT 1")->fetch(PDO::FETCH_ASSOC)['clientid'];
        $globalJobsCompleted = $db->query("SELECT COUNT(jobid)
                                           FROM jobs
                                           WHERE jobstatus = 'COMPLETE'")->fetch(PDO::FETCH_ASSOC)['COUNT(jobid)'];
        $globalJobsTotal = $db->query("SELECT COUNT(*)
                                       FROM jobs")->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
        $individualJobsCompleted = $db->query("SELECT COUNT(jobid)
                                               FROM jobs
                                               WHERE jobstatus = 'COMPLETE' AND
                                                     clientid =" . $clientid)->fetch(PDO::FETCH_ASSOC)['COUNT(jobid)'];
        $clientJobCompletion = $db->query("SELECT clientid, COUNT( * )
                                           FROM jobs
                                           WHERE jobstatus = 'COMPLETE'
                                           GROUP BY clientid")->fetch(PDO::FETCH_ASSOC);
        $globalTimeElapsed = $db->query("SELECT NOW() - MIN(lastsent)
                                         FROM jobs")->fetch(PDO::FETCH_ASSOC)["NOW() - MIN(lastsent)"];
        $individualTimeElapsed = $db->query("SELECT NOW() - MIN(lastsent)
                                             FROM jobs
                                             WHERE clientid=" . $clientid)->fetch(PDO::FETCH_ASSOC)["NOW() - MIN(lastsent)"];

        $rank = 1;
        foreach($clientJobCompletion as $row) {
            if($row['COUNT(*)'] >  $individualJobsCompleted) { $rank++; }
        }

        header("Content-type: application/json");

        $returnVal = array(
            "globalJobsTotal" => $globalJobsTotal,
            "globalJobsCompleted" => $globalJobsCompleted,
            "globalCompletionPercentage" => $globalJobsCompleted/$globalJobsTotal,
            "globalTimeElapsed" => $globalTimeElapsed,
            "individualJobsCompleted" => $individualJobsCompleted,
            "individualRank" => $rank,
            "individualTimeElapsed" => $individualTimeElapsed,
            "clientid" => $clientid,
        );

        echo json_encode($returnVal);
    }
?>



