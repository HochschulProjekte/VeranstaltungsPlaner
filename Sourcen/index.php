<?php
// Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

// Includes
include_once './administration/authenticateUser.php';
include_once './class/userInterface.php';
include_once './controller/eventsController.php';

// Controller
$myEventsController = new EventsController($myUser, $_POST);

// User Interface
$userInterface = new UserInterface($myEventsController);

// Seite ausgeben
$userInterface->renderPage();
?>