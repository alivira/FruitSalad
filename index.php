<?php
session_start();

$reconnect_url = "website/reconnect.html";
$landing_page_url = "website/index.html";
if(isset($_SESSION['timestamp'])) {
    header("Location: " . $reconnect_url);
    echo "You've been here before";
    
} else {
    header("Location: " . $landing_page__url);
    echo "You're new around here";
}
// store session data
//$_SESSION['views']=1;
?>
