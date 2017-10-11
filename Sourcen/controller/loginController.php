<?php

include_once __DIR__.'/../class/loginHandler.php';

// Check, if inputs are filled
if (isset($_POST['login-username']) && isset($_POST['login-password'])) {
    // Create LoginHandler
    $loginHandler = new LoginHandler();

    // Try to login user with form inputs
    $ret = $loginHandler->login($_POST['login-username'], $_POST['login-password']);
    
    // Check, if login was successful
    if ($ret['err'] == true) {
        // => error occured -> set alert
        $alert = array();
        $alert['type'] = $ret['type'];
        $alert['msg'] = $ret['msg'];
    } else {
        // => login successful -> redirect user
        $loginHandler->redirect('vstp/index.php');
    }
} else {
    $alert = array();
    $alert['type'] = 'info';
    $alert['msg'] = 'Bitte geben Sie ihren Benutzernamen und ihr Passwort ein.';
}

?>