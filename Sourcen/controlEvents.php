<?php
    // Authoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

    // Authenticate user
    include_once './administration/authenticateUser.php';
    include_once './controller/eventsController.php';
    include_once './class/userInterface.php';

    // Controller
    $eventsController = new EventsController($_POST, $_FILES, $myUser);

    // User Interface
    $userInterface = new UserInterface($eventsController);

    // Seite ausgeben
    $userInterface->renderPage();
?>

