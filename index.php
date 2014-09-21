<?php
session_start();

$reconnect_url = "http://10.42.0.1/website/reconnect.html";
$landing_page_url = "http://10.42.0.1/website/index.html";
if(isset($_SESSION['timestamp'])) { // TODO: Only works if user navigates back to root of same site.
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
