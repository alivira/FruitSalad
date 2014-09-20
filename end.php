<?php
    $ip = $_SERVER['REMOTE_ADDR'];
    $cmd = "sudo iptables -t nat -D PREROUTING -s " . $ip . " -p tcp -j ACCEPT";
    echo $cmd;
    shell_exec ($cmd);
    $db = new PDO("mysql:host=localhost;dbname=basket;charset=utf8", "root", "What is systems?"); // This is a really bad idea...
    $query = "UPDATE clients
               SET active=0
               WHERE clientip=" . $ip; 
    $db->exec($query);

?>
