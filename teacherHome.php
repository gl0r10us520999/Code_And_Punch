<?php 
    session_start();
    if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
        echo "Hello ". $_SESSION['username']. " you are a teacher";
    }
?>