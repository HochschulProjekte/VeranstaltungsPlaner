<?php

    // Includes
    include_once './administration/authenticateUser.php';
    include_once './class/userInterface.php';
    include_once './controller/myEventsController.php';


    // Controller
    $myEventsController = new MyEventsController($myUser, $_POST);

    // User Interface
    $userInterface = new UserInterface($myEventsController);

    // Seite ausgeben
    $userInterface->renderPage();
?>