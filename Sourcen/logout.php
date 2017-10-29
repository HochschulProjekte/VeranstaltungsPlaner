<?php
// Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

include_once './class/loginHandler.php';

$loginHandler = new LoginHandler();
$loginHandler->logout();
$loginHandler->redirect('login.php');

?>