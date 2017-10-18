<?php

    // Authenticate user
    include_once './administration/authenticateUser.php';
    include_once './class/positionMapping.php';

    // User Interface
    include_once './class/userInterface.php';
    $userInterface = new UserInterface($myUser,'myEvents');
    $userInterface->addScript('myEvents');

    $userInterface->renderHeader();

    // MyEventsController
    include_once './controller/myEventsController.php';

    $myEventsController = new MyEventsController($_POST);

?>
    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">

        <div class="row">
            
            <!-- Tabs -->
            <ul class="nav nav-tabs" id="view-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="calender-tab" data-toggle="tab" href="#calender" role="tab" aria-controls="calender" aria-expanded="true">Kalender</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="table-tab" data-toggle="tab" href="#table" role="tab" aria-controls="table">Tabelle</a>
                </li>
            </ul>

            <!-- Time  period and control -->
            <div class="period-control">
                <?php
                    echo '
                    <button type="button" onclick="previousWeek('.$myEventsController->getYear().', '.$myEventsController->getWeek().')" class="btn btn-secondary btn-control projectweek-nav"><</button>
                    <a class="projectweek-text">'.$myEventsController->getWeekStartDate().' - '.$myEventsController->getWeekEndDate().'</a>
                    <button type="button" onclick="nextWeek('.$myEventsController->getYear().', '.$myEventsController->getWeek().')" class="btn btn-secondary btn-control projectweek-nav">></button>
                    ';
                ?>

                <!-- Event regristration modal -->
                <?php
                    $registrationAllowed = $myEventsController->isRegistrationAllowed();

                    echo '
                        <button type="button" class="btn btn-secondary btn-control projectweek-nav" data-toggle="modal" data-target="#regrisModal"'.($registrationAllowed ? '' : ' disabled').'>
                            Anmeldung
                        </button>
                    ';
                ?>


            </div>
            <form id="projectWeek" method="POST" action="#"></form>

            <!-- Modal event regristration-->
            <div class="modal fade" id="regrisModal" tabindex="-1" role="dialog" aria-labelledby="regrisModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form id="registration" method="POST" action="#">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Veranstaltungsanmeldung</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="registration" value="X" />

                        <div class="form-group" class="priority-label">
                            <label for="priority">Priorität</label>
                            <select class="form-control" id="priority" name="priority">
                                <?php
                                    for($i=1;$i<=10;$i++) {
                                        echo '<option>'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <table class="table table-sm">
                            <thead><tr>
                                    <th>#</th>
                                    <th>Von</th>
                                    <th>Bis</th>
                                    <th>Name</th>
                            </tr></thead>
                            <tbody>
                        <?php
                            $events = $myEventsController->getWeekEntries();

                            foreach($events as $event) {
                                echo '
                            <tr>
                                <td><input type="radio" name="projectWeekEntryId" value="'.$event->getId().'" text="" /></td>
                                <td>'.PositionMapping::map($event->getPosition()).'</td>
                                <td>'.PositionMapping::mapUntil($event->getPosition(), $event->getEvent()->length).'</td>
                                <td>'.$event->getEvent()->name.'</td>
                            </tr>
                                
                                ';
                            }
                        ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                        <button type="submit" class="btn btn-primary">Anmelden</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                
                <!-- Calender -->
                <div class="tab-pane fade show active" id="calender" role="tabpanel" aria-labelledby="calender-tab">
                    
                    <div class="row justify-content-center">

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 tab-col">

                            <table class="table table-responsive" id="calender-table">

                                <thead>
                                    <tr style="background-color: #FFF;">
                                        <th style="text-align: center;border: 3px solid #EEE;"></th>
                                        <?php

                                            $weekDays = $myEventsController->getWeekDays();

                                            foreach($weekDays as $weekday) {
                                                echo '
                                                    <th style="text-align: center;border: 3px solid #EEE;">'.$weekday.'</th>
                                                ';
                                            }

                                        ?>
                                    </tr>
                                </thead>

                                <tbody>
                                        <?php

                                            $html_first_row = '
                                                <tr style="background-color: #FFF;">
                                                    <td style="vertical-align: middle; text-align: center;border: 3px solid #EEE;">1. Halbtag<br>(08:00 Uhr - 12:00 Uhr)</td>
                                            ';

                                            $html_second_row = '
                                                <tr style="background-color: #FFF;">
                                                    <td style="vertical-align: middle; text-align: center;border: 3px solid #EEE;">2. Halbtag<br>(12:00 Uhr - 16:00 Uhr)</td>
                                            ';

                                            for($i = 1; $i <= 10; $i++) {
                                                $eventRepresentation = $myEventsController->getEventRegistrationRepresentationAtPosition($i);

                                                if($i % 2 == 1) {
                                                    if($eventRepresentation == NULL) {
                                                        $html_first_row .= '<td style="border: 3px solid #EEE;">
                                                            <center>
                                                                <div class="calender-event" 
                                                                     data-toggle="tooltip" 
                                                                     data-placement="auto" 
                                                                     data-html="true">-</div>
                                                            </center>
                                                          </td>';
                                                    } else {

                                                        $nextEventRepresentation = $myEventsController->getEventRegistrationRepresentationAtPosition($i+1);

                                                        if($nextEventRepresentation != NULL
                                                                && $nextEventRepresentation->getRegistrationId() == $eventRepresentation->getRegistrationId()) {

                                                            $html_first_row .= $eventRepresentation->getHTML(true);
                                                            $i++;

                                                        } else {
                                                            $html_first_row .= $eventRepresentation->getHTML(false);
                                                        }

                                                    }

                                                } else {
                                                    if($eventRepresentation == NULL) {
                                                        $html_second_row .= '<td style="border: 3px solid #EEE;">
                                                            <center>
                                                                <div class="calender-event" 
                                                                     data-toggle="tooltip" 
                                                                     data-placement="auto" 
                                                                     data-html="true">-</div>
                                                            </center>
                                                          </td>';
                                                    } else {

                                                        $html_second_row .= $eventRepresentation->getHTML(false);
                                                    }
                                                }
                                            }

                                            echo $html_first_row.'</tr>';
                                            echo $html_second_row.'</tr>';
                                        ?>

                                </tbody>

                            </table>

                        </div>       

                    </div>

                </div>

                <!-- Table -->
                <div class="tab-pane fade" id="table" role="tabpanel" aria-labelledby="table-tab">
                    
                    <div class="row justify-content-center">

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 tab-col">

                            <table class="table table-striped table-responsive" id="table-table">

                                <thead>
                                    <tr style="background-color: #FFF; border-bottom: 3px solid #333;">
                                        <th>Von</th>
                                        <th>Bis</th>
                                        <th>Veranstaltung</th>
                                        <th>Verantwortlicher</th>
                                        <th>Priorität</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                        $eventRegistrationColleciton = $myEventsController->getEventRegistrationCollection();

                                        foreach($eventRegistrationColleciton->getEventRegistrations() as $index => $eventRegistration) {

                                            echo '
                                            <tr style="background-color: '.($index % 2 == 0 ? "#EEE" : "#FFF").';">
                                                
                                                <td>'.PositionMapping::map($eventRegistration->getProjectWeekEntry()->getPosition()).'</td>
                                                <td>'.PositionMapping::mapUntil($eventRegistration->getProjectWeekEntry()->getPosition(), $eventRegistration->getProjectWeekEntry()->getEvent()->length).'</td>
                                                <td>'.$eventRegistration->getProjectWeekEntry()->getEvent()->name.'</td>
                                                <td>'.$eventRegistration->getProjectWeekEntry()->getEvent()->eventManager.'</td>
                                                <td>'.$eventRegistration->getPriority().'</td>
                                            
                                            </tr>

                                            ';
                                        }

                                    ?>
                                </tbody>

                            </table>

                        </div>        

                    </div>

                </div>
            </div>

        </div>

    </div>

<?php
    $userInterface->renderFooter();
?>