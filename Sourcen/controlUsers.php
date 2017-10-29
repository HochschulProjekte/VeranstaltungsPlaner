<?php
// Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

// Includes
include_once './administration/authenticateUser.php';
include_once './class/userInterface.php';
include_once './controller/controlUserController.php';

// Controller
$userController = new ControlUserController($myUser);

// User Interface
$userInterface = new UserInterface($userController);

// Seite ausgeben
$userInterface->renderPage();
?>