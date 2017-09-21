<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/loginHandler.php';

$loginHandler = new LoginHandler();
$loginHandler->logout();
$loginHandler->redirect('vstp/login.php');

?>