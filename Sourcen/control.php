<?php
    // Authenticate user
    include_once './administration/authenticateUser.php';

    // Check, if user is personnal manager
    if (!$myUser->isPersonnalManager()) {

        header('Location: ./index.php');
        exit();
    }

    // User Interface
    include_once './class/userInterface.php';
    $userInterface = new UserInterface($myUser,'control');
    $userInterface->renderHeader();

    echo $_SERVER['REQUEST_URI'];
?>


    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">

        <div class="list-group">
            <a href="controlUsers.php" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Benutzer</h5>
                </div>
                <small>Benutzer anlegen, bearbeiten und löschen.</small>
            </a>

            <a href="controlWeeks.php" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Projektwochen</h5>
                </div>
                <small>Projektwochen anlegen und Veranstaltungen zur Projektwoche hinzufügen.</small>
            </a>

            <a href="controlEvents.php" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Veranstaltungen</h5>
                </div>
                <small>Veranstaltungen anlegen, bearbeiten und löschen.</small>
            </a>
        </div>

    </div>

<?php
    $userInterface->renderFooter();
?>