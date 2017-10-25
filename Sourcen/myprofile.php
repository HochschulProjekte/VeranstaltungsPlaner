<?php

    // Includes
    include_once './administration/authenticateUser.php';
    include_once './controller/myProfileController.php';
    include_once './class/userInterface.php';

    // Controller
    $myProfileController = new MyProfileController($_POST, $myUser);

    // Userinterface
    $userInterface = new UserInterface($myProfileController);
    $userInterface->renderPage();
?>