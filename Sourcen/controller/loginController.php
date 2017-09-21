<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/loginHandler.php';

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
    header('Location: https://' . $_SERVER['HTTP_HOST'] . '/vstp/index.php');
}

?>