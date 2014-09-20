<?php
    echo "Attempting to add " . $_SERVER['REMOTE_ADDR'] . " to iptables at " . time() . ":";
    $output =  shell_exec ("sudo iptables -t nat -D PREROUTING -s " . $_SERVER['REMOTE_ADDR'] . " -p tcp -j ACCEPT");
    $output =  shell_exec ("sudo iptables -t nat -I PREROUTING -s " . $_SERVER['REMOTE_ADDR'] . " -p tcp -j ACCEPT");
?>
