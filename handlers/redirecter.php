<?php
 
if (!isset($_SESSION)) {
    session_start();
}

if (defined('ADMINS_ONLY')) {
    if (!isset($_SESSION['is_admin'])) {
        header('Location: /');
    }
} else {
    if (defined('LOGGED_IN_ONLY')) {
        if (!isset($_SESSION['email'])) {

            header('Location: /');
        }
    } else {
        if (defined('LOGGED_OUT_ONLY')) {
            if (isset($_SESSION['email'])) {

                header('Location: /');
            }
        }
    }
}





    