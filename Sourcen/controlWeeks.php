<?php
// Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

// Includes
include_once './administration/authenticateUser.php';
include_once './class/userInterface.php';
include_once './controller/controlProjectWeeksController.php';
include_once './class/positionMapping.php';

// ProjectWeeksController
$myProjectWeeksController = new ControlProjectWeeksController($_POST, $myUser);

// User Interface
$userInterface = new UserInterface($myProjectWeeksController);

// Seite ausgeben
$userInterface->renderPage();

?>
