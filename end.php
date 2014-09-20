<?php
    $output =  shell_exec ("sudo iptables -t nat -D PREROUTING -s " . $_SERVER['REMOTE_ADDR'] . " -p tcp -j ACCEPT");
?>
