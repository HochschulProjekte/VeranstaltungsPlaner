<?php

/**
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */

include_once __DIR__.'/../class/loginHandler.php';
include_once __DIR__.'/../class/user.php';

// Create login handler
$lh = new LoginHandler();

// Check, if user is logged in
if ($lh->isUserLoggedIn() == true) {
    // => user is already logged in
    
    // Set user variable for further actions
    $myUser = $lh->getMyUser();
    
    // Redirect user to index page if he is on login
    $actualLink = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(strpos($actualLink, 'login.php') > 0) {
        $lh->redirect('index.php');
    }
} else {
    // => user is not logged in

    // Redirect user to login page if he is not already there
    $actualLink = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(strpos($actualLink, 'login.php') == 0) {
        $lh->redirect('login.php');
    }
}



?>