<?php
//error_reporting(E_ALL);

include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/loginHandler.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/user.php';

// Create login handler
$lh = new LoginHandler();

// Check, if user is logged in
if ($lh->isUserLoggedIn() == true) {
    // => user is already logged in
    
    // Set user variable for further actions
    $myUser = $lh->getMyUser();
    
    // Redirect user to index page if he is on login
    $actualLink = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ($actualLink == 'https://' . $_SERVER['HTTP_HOST'] . '/vstp/login.php') {
        $lh->redirect('vstp/index.php');
    }
} else {
    // => user is not logged in

    // Redirect user to login page if he is not already there
    $actualLink = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ($actualLink != 'https://' . $_SERVER['HTTP_HOST'] . '/vstp/login.php') {
        $lh->redirect('vstp/login.php');
    }
}



?>