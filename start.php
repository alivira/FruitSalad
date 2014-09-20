<?php
    echo "Attempting to add " . $_SERVER['REMOTE_ADDR'] . " to iptables at " . time() . ":";
    $output =  shell_exec ("sudo iptables -t nat -D PREROUTING -s " . $_SERVER['REMOTE_ADDR'] . " -p tcp -j ACCEPT");
    $output =  shell_exec ("sudo iptables -t nat -I PREROUTING -s " . $_SERVER['REMOTE_ADDR'] . " -p tcp -j ACCEPT");

    $db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "What is systems?");
    $db->prepare("INSERT INTO clients (lastheartbeat, clientip) VALUES (NOW(), :clientip)")->execute(array("clientip" => $_SERVER['REMOTE_ADDR']));

?>
