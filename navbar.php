<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    include 'navbar_logged_out.php';
}
else{
    include 'navbar_logged_in.php';
}
