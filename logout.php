<?php
    session_start();
    session_destroy();
    
    header("location: trans_logout.php");
    
?>
