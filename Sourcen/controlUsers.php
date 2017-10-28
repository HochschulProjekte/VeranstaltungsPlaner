<?php
    // Authoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen

    // Authenticate user
    include_once './administration/authenticateUser.php';
    include_once './class/userInterface.php';
    include_once  './controller/userController.php';

    // Controller
    $userController = new UserController($myUser);

    // User Interface
    $userInterface = new UserInterface($userController);

    // Seite ausgeben
    $userInterface->renderPage();
?>