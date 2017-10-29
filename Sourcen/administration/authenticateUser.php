<?php

/**
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */

include_once __DIR__ . '/../class/loginHandler.php';
include_once __DIR__ . '/../class/user.php';

// LoginHandler Objekt erstellen.
$lh = new LoginHandler();

// Ueberpruefen, ob der User angemeldet ist.
if ($lh->isUserLoggedIn() == true) {

    // Userobjekt speichern.
    $myUser = $lh->getMyUser();

    // Zu der Index-Seite weiterleiten.
    $actualLink = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (strpos($actualLink, 'login.php') > 0) {
        $lh->redirect('index.php');
    }
} else {

    // Zu der Login-Seite weiterleiten.
    $actualLink = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (strpos($actualLink, 'login.php') == 0) {
        $lh->redirect('login.php');
    }
}


?>