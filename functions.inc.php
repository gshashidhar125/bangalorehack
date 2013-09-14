<?php

function redirect($page) {

    header('Location: ' . $page);
    exit();
}
/*
function check_login_status() {

    if (isset($_SESSION['logged_in'])) {

        return $_SESSION['logged_in'];
    }
    return false;
}*/

function check_login_status() {

    if (!isset($_SESSION['logged_in'])) {

        return false;
    }
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        return false;
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    return true;
}
?>
