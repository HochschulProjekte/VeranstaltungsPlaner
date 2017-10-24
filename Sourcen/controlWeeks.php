<?php

    // includes
    include_once './administration/authenticateUser.php';
    include_once './class/userInterface.php';
    include_once './controller/projectWeeksController.php';
    include_once './class/positionMapping.php';

    // Check, if user is personnal manager
    if (!$myUser->isPersonnalManager()) {
        header('Location: ./index.php');
        exit();
    }

    // User Interface
    $userInterface = new UserInterface($myUser,'controlWeeks');
    $userInterface->addScript('controlWeeks');
    $userInterface->renderHeader();

    // ProjectWeeksController
    $myProjectWeeksController = new ProjectWeeksController($_POST);

?>

    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">
        
        <div class="row justify-content-center">

            <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">

                <?php

                    $changePhaseMessage = $myProjectWeeksController->getChangePhaseMessage();

                    if($changePhaseMessage != NULL) {

                        if($changePhaseMessage->getStatus() == true) {

                            if($changePhaseMessage->getNewPhase() == 2) {
                                echo '
                                    <div class="my-message alert alert-success" role="alert">
                                        Die Anmeldung wurde erfolgreich freigeschaltet.
                                    </div>
                                ';
                            } else {
                                echo '
                                    <div class="my-message alert alert-success" role="alert">
                                        Die Veranstaltungen wurden erfolgreich zugewiesen.
                                    </div>
                                ';
                            }

                        } else if($changePhaseMessage->getStatus() == false) {
                            echo '
                            <div class="my-message alert alert-danger" role="alert">
                                Am '.PositionMapping::map($changePhaseMessage->getPosition()).($changePhaseMessage->getMissingUsers() == 1 ? ' fehlt ':' fehlen ').$changePhaseMessage->getMissingUsers().($changePhaseMessage->getMissingUsers() == 1 ? ' Platz':' Plätze').'.
                            </div>
                        ';
                        }
                    }

                ?>

                <div class="jumbotron create-event">
                    <form id="projectWeek" action="#" method="POST"></form>
                    <form method="post" action="#">

                        <?php
                            echo '
                            <button type="button" onclick="previousWeek('.$myProjectWeeksController->getProjectWeek()->getYear().', '.$myProjectWeeksController->getProjectWeek()->getWeek().')" class="btn btn-secondary week-controls"><</button>
                            <a style="padding: 0 10px 0 10px" class="week-controls">Woche: '.$myProjectWeeksController->getProjectWeek()->getWeek().' - '.$myProjectWeeksController->getProjectWeek()->getFromDate().' - '.$myProjectWeeksController->getProjectWeek()->getUntilDate().'</a>
                            <button type="button" onclick="nextWeek('.$myProjectWeeksController->getProjectWeek()->getYear().', '.$myProjectWeeksController->getProjectWeek()->getWeek().')" class="btn btn-secondary week-controls">></button>
                            ';
                        ?>

                        <?php

                            // get current phase
                            $phase = $myProjectWeeksController->getProjectWeek()->getPhase();

                            // if phase is equal three, than don't show any button at all.
                            if($phase != 3) {

                                $nextPhase = $phase + 1;

                                echo '
                                        <input type="hidden" name="changePhase" value="'.$nextPhase.'"/>
                                        <input type="hidden" name="year" value="'.$myProjectWeeksController->getProjectWeek()->getYear().'"/>
                                        <input type="hidden" name="week" value="'.$myProjectWeeksController->getProjectWeek()->getWeek().'"/>
        
                                        <button type="submit" class="btn btn-primary week-controls">
                                            '.($phase == 1 ? 'Anmeldung freischalten' : 'Veranstaltungen zuweisen').'
                                        </button>
                                    ';

                            }

                        ?>

                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="#" method="post" id="needs-validation">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Veranstaltung hinzufügen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="input-group" style="margin-bottom: 5px">
                                            <div class="input-group-addon"><i class="fa fa-university"></i></div>
                                            <?php
                                            echo '
                                                <input type="hidden" name="add" value="X" />
                                                <input type="hidden" name="year" value="'.$myProjectWeeksController->getProjectWeek()->getYear().'" />
                                                <input type="hidden" name="week" value="'.$myProjectWeeksController->getProjectWeek()->getWeek().'" />
                                            ';
                                            ?>
                                            <select class="form-control" id="myprojectweek-position" name="position" required>
                                                <?php
                                                for($i=1;$i<=10;$i++) {
                                                    echo '<option value="'.$i.'">'.PositionMapping::map($i).'</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="input-group" style="margin-bottom: 5px">
                                            <div class="input-group-addon"><i class="fa fa-university"></i></div>
                                            <input type="text" class="form-control" id="myprojectweek-participants" name="maxParticipants" placeholder="Max. Teilnehmer" value="" required>
                                        </div>

                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Länge</th>
                                                    <th>Verantwortlicher</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $events = $myProjectWeeksController->getProjectWeek()->loadAllEvents();

                                                    foreach($events as $event) {
                                                        echo '
                                                        
                                                    <tr>
                                                        <td><input type="radio" name="eventId" value="'.$event->id.'" /></td>
                                                        <td>'.$event->name.'</td>
                                                        <td>'.$event->length.'</td>
                                                        <td>'.$event->eventManager.'</td>

                                                    </tr>
                                                        
                                                        ';
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                                        <button type="submit" class="btn btn-primary">Hinzufügen</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                            <th>Von</th>
                            <th>Bis</th>
                            <th>Name</th>
                            <th>Dozent</th>
                            <th>Max. Nutzer</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <form id="delete" action="#" method="POST"></form>
                            <?php
                                foreach ($myProjectWeeksController->getProjectWeek()->getProjectWeekEntries() as $entry) {
                                    echo '
                                    <tr>
                                        <td>'.PositionMapping::map($entry->getPosition()).'</td>
                                        <td>'.PositionMapping::mapUntil($entry->getPosition(), $entry->getEvent()->length).'</td>
                                        <td>'.$entry->getEvent()->name.'</td>
                                        <td>'.$entry->getEvent()->eventManager.'</td>
                                        <td>'.$entry->getMaxParticipants().'</td>
                                        <td><button type="button" onclick="deleteEvent('.$entry->getId().')" class="btn btn-secondary"'.($phase != 1 ? ' disabled' : '').'>X</button></td>
                                    </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                    </table>

                    <?php

                        echo '
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEventModal"'.($phase != 1 ? ' disabled' : '').'>
                                Veranstaltung hinzufügen
                            </button>   
                        ';
                    ?>

                </div>
            </div>
        </div>
    </div>

<?php
    $userInterface->renderFooter();
?>
