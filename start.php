<?php
    echo "Attempting to add " . $_SERVER['REMOTE_ADDR'] . " to iptables at " . time() . ":";
    $output =  shell_exec ("sudo iptables -t nat -D PREROUTING -s " . $_SERVER['REMOTE_ADDR'] . " -p tcp -j ACCEPT");
    $output =  shell_exec ("sudo iptables -t nat -I PREROUTING -s " . $_SERVER['REMOTE_ADDR'] . " -p tcp -j ACCEPT");

    $db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "What is systems?");
    
    $preStmt = $db->prepare("SELECT * FROM clients WHERE clientip=:ip LIMIT 1");
    
    $preStmt->execute(array("ip" => $_SERVER["REMOTE_ADDR"]));
    $row = $preStmt->fetch(PDO::FETCH_ASSOC);
    echo print_r($row);
    if ($row) {
            $db->prepare("UPDATE clients SET lastheartbeat=NOW(), active=TRUE WHERE clientip=:id")->execute(array("id" => $row['clientid']));
    } else {
            $db->prepare("INSERT INTO clients (lastheartbeat, clientip, active) VALUES (NOW(), :clientip, TRUE)")->execute(array("clientip" => $_SERVER['REMOTE_ADDR']));
    }
?>
