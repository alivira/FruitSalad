<?php
session_start();

$reconnect_url = "website/reconnect.html";
$landing_page_url = "website/index.html";
if(isset($_SESSION['timestamp'])) {
    header("Location: " . $reconnect_url);
    echo "You've been here before";
    
} else {
    header("Location: " . $landing_page_url);
    echo "You're new around here";
    $_SESSION['timestamp'] = "asdf";
}
// store session data
//$_SESSION['views']=1;
?>
