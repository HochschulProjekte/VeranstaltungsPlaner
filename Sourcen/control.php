<?php
    // Authenticate user
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/authenticateUser.php';

    // Check, if user is personnal manager
    if (!$myUser->isPersonnalManager()) {
        header('Location: https://' . $_SERVER['HTTP_HOST'] . '/vstp/index.php');
        exit();
    }

    // User Interface
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/userInterface.php';
    $userInterface = new UserInterface('controlWeeks');
    $userInterface->renderHeader();
?>


    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">
        
        <div class="list-group">
            <a href="controlUsers.php" class="list-group-item list-group-item-action">Benutzer bearbeiten</a>
            <a href="controlWeeks.php" class="list-group-item list-group-item-action">Projektwochen bearbeiten</a>
            <a href="controlEvents.php" class="list-group-item list-group-item-action">Veranstaltungen bearbeiten</a>
        </div>

    </div>

<?php
    $userInterface->renderFooter();
?>