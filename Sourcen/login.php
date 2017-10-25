<?php

    // Includes
    include_once './administration/authenticateUser.php';
    include_once './controller/loginController.php';
    include_once './class/userInterface.php';

    // Controller
    $loginController = new LoginController($_POST);

    // User Interface
    $userInterface = new UserInterface($loginController);

    // Seite ausgeben
    $userInterface->renderContent();

?>

