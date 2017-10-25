<?php

    include_once './class/loginHandler.php';

    $loginHandler = new LoginHandler();
    $loginHandler->logout();
    $loginHandler->redirect('login.php');

?>