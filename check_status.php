<?php
    
    $db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "What is systems?"); // This is a really bad idea...
    $stmt = $db->query("SELECT *
                        FROM clients
                        WHERE DATE_SUB( Now( ) , INTERVAL 30 SECOND ) > lastheartbeat
                        AND active =1");
    $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
    echo json_encode($rows);

    foreach($rows as $row) {
        echo json_encode($row);

        $ip = $row["clientip"];
        $command = "sudo iptables -t nat -D PREROUTING -s " . $ip . " -p tcp -j ACCEPT";
        echo $command;
        shell_exec ($command);
        $db->exec("UPDATE clients
                   SET active=0
                   WHERE clientid=" . $row["clientid"]);
    }
?>
