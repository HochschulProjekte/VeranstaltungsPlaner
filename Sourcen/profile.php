<?php
// Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

// Includes
include_once './administration/authenticateUser.php';
include_once './controller/profileController.php';
include_once './class/userInterface.php';

// Controller
$myProfileController = new ProfileController($_POST, $myUser);

// Userinterface
$userInterface = new UserInterface($myProfileController);
$userInterface->renderPage();
?>