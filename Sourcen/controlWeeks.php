<?php

    // includes
    include_once './administration/authenticateUser.php';
    include_once './class/userInterface.php';
    include_once './controller/projectWeeksController.php';
    include_once './class/positionMapping.php';


    // ProjectWeeksController
    $myProjectWeeksController = new ProjectWeeksController($_POST, $myUser);

    // User Interface
    $userInterface = new UserInterface($myProjectWeeksController);

    // Seite ausgeben
    $userInterface->renderPage();

?>
