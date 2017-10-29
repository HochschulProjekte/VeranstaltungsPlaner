<?php
// Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

// Includes
include_once './administration/authenticateUser.php';
include_once './controller/controlPageController.php';

// Controller
$myControlPageController = new ControlPageController($myUser);

// User Interface
include_once './class/userInterface.php';
$userInterface = new UserInterface($myControlPageController);
$userInterface->renderPage();
?>