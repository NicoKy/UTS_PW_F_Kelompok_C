<?php
    session_start();
    if($_SESSION['status_login'] == true)
    {
        include_once 'headerLoggedIn.php';
    }
    else
    {
        include_once 'header.php';
    }

    include_once 'home.php';

    include_once 'footer.php';
?>