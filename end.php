<?php
    $ip = $_SERVER['REMOTE_ADDR'];
    $cmd = "sudo iptables -t nat -D PREROUTING -s " . $ip . " -p tcp -j ACCEPT";
    shell_exec ($cmd);
    $db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "What is systems?"); // This is a really bad idea...
    $query = "UPDATE clients
               SET active=0
               WHERE clientip='" . $ip . "'";
    $db->exec($query);

    $query = "UPDATE jobs INNER JOIN clients
                  ON  clients.clientid = jobs.clientid     
              SET jobs.jobstatus = 'INCOMPLETE', jobs.clientid=0
              WHERE clients.clientip = :ip AND
                  jobs.jobstatus != 'COMPLETE'";
    $preStmt = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $preStmt->execute(array(":ip" => $ip));
?>
