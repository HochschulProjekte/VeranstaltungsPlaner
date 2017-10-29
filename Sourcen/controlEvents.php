<?php
// Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

// Includes
include_once './administration/authenticateUser.php';
include_once './controller/controlEventsController.php';
include_once './class/userInterface.php';

// Controller
$eventsController = new ControlEventsController($_POST, $_FILES, $myUser);

// User Interface
$userInterface = new UserInterface($eventsController);

// Seite ausgeben
$userInterface->renderPage();
?>

