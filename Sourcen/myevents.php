<?php

    // Authenticate user
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/authenticateUser.php';

    // User Interface
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/userInterface.php';
    $userInterface = new UserInterface('myEvents');
    $userInterface->addScript('myEvents');

    $userInterface->renderHeader();

    // MyEventsController
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/controller/myEventsController.php';

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
                    <a class="nav-link" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list">Liste</a>
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
                <button type="button" class="btn btn-secondary btn-control projectweek-nav" data-toggle="modal" data-target="#regrisModal">
                    Anmeldung
                </button>

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
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>

                        <table class="table table-sm">
                            <thead><tr>
                                    <th>#</th><th>Name</th>
                                    <th>Länge</th><th>Teiln.</th>
                                    <th>max. Teiln.</th>
                            </tr></thead>
                            <tbody>
                        <?php
                            $events = $myEventsController->getWeekEntries();

                            foreach($events as $event) {
                                echo '
                            <tr>
                                <td><input type="radio" name="projectWeekEntryId" value="'.$event->getProjectWeekEntryId().'" text="" /></td>
                                <td>'.$event->getEvent()->name.'</td>
                                <td>'.$event->getEvent()->length.'</td>
                                <td>'.$event->getParticipants().'</td>
                                <td>'.$event->getMaxParticipants().'</td>
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
                                        <th style="text-align: center;border: 3px solid #EEE;">04.09.2017</th>
                                        <th style="text-align: center;border: 3px solid #EEE;">05.09.2017</th>
                                        <th style="text-align: center;border: 3px solid #EEE;">06.09.2017</th>
                                        <th style="text-align: center;border: 3px solid #EEE;">07.09.2017</th>
                                        <th style="text-align: center;border: 3px solid #EEE;">08.09.2017</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr style="background-color: #FFF;">
                                        <td style="vertical-align: middle; text-align: center;border: 3px solid #EEE;">1. Halbtag<br>(08:00 Uhr - 12:00 Uhr)</td>
                                        <td style="border: 3px solid #EEE;"><center><div class="calender-event one">Veranstaltungsbezeichnung</div></center></td>
                                        <td style="border: 3px solid #EEE;" rowspan="2"><center><div class="calender-event three two-rows" data-toggle="tooltip" data-placement="auto" data-html="true" title="<strong>Veranstaltungsübersicht</strong><table><tr><td><strong>Datum:</strong></td><td><span>05.09.2017</span></td></tr><tr><td><strong>Zeit:</strong></td><td><span>08:00 Uhr -</span><span>16:00 Uhr</span></td></tr><tr><td><strong>Teilnehmer:</strong></td><td><span>12</span></td></tr><tr><td><strong>Verantw.:</strong></td><td><span>Mitarbeiter XY</span></td></tr></table>">Veranstaltungsbezeichnung</div></center></td>
                                        <td style="border: 3px solid #EEE;"><center><div class="calender-event five">Veranstaltungsbezeichnung</div></center></td>
                                        <td style="border: 3px solid #EEE;" rowspan="2"><center><div class="calender-event seven two-rows">Veranstaltungsbezeichnung</div></center></td>
                                        <td style="border: 3px solid #EEE;" rowspan="2"><center><div class="calender-event seven two-rows">Veranstaltungsbezeichnung</div></center></td>
                                    </tr>
                                    <tr style="background-color: #FFF;">
                                        <td style="vertical-align: middle; text-align: center;border: 3px solid #EEE;">2. Halbtag<br>(12:00 Uhr - 16:00 Uhr)</td>
                                        <td style="border: 3px solid #EEE;"><center><div class="calender-event two">Veranstaltungsbezeichnung</div></center></td>
                                        <td style="border: 3px solid #EEE;"><center><div class="calender-event six">Veranstaltungsbezeichnung</div></center></td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>       

                    </div>

                </div>

                <!-- List -->
                <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                    
                    <div class="row justify-content-center">

                        <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-6 tab-col">

                            <!-- List Item (One day) -->
                            <ul class="list-group event-list">

                                <!-- Date -->
                                <li class="list-group-item active" style="background-color: #1348AB; border-color: #1348AB; font-size: 1.5rem; color:#FFF">Montag, 04.09.2017</li>

                                <!-- Event 1 -->
                                <li class="list-group-item">
                                    <span class="event-title">Veranstaltungsbezeichnung</span>
                                    <table class="event-information">
                                        <tr><td><strong>Datum:</strong></td><td>04.09.2017</td></tr>
                                        <tr><td><strong>Zeit:</strong></td><td>08:00 Uhr - 12:00 Uhr</td></tr>
                                        <tr><td><strong>Anz. Teilnehmer:</strong></td><td>12</td></tr>
                                        <tr><td><strong>Verantwortlicher:</strong></td><td>Mitarbeiter XY</td></tr>
                                    </table>
                                </li>

                                <!-- Event 2 -->
                                <li class="list-group-item">
                                    <span class="event-title">Veranstaltungsbezeichnung</span>
                                    <table class="event-information">
                                        <tr><td><strong>Datum:</strong></td><td>04.09.2017</td></tr>
                                        <tr><td><strong>Zeit:</strong></td><td>12:00 Uhr - 16:00 Uhr</td></tr>
                                        <tr><td><strong>Anz. Teilnehmer:</strong></td><td>12</td></tr>
                                        <tr><td><strong>Verantwortlicher:</strong></td><td>Mitarbeiter XY</td></tr>
                                    </table>
                                </li>

                            </ul>

                            <!-- List Item (Another day) -->
                            <ul class="list-group event-list">

                                <li class="list-group-item active" style="background-color: #1348AB; border-color: #1348AB; font-size: 1.5rem; color:#FFF">Dienstag, 05.09.2017</li>

                                <li class="list-group-item">
                                    <span class="event-title">Veranstaltungsbezeichnung</span>
                                    <table class="event-information">
                                        <tr><td><strong>Datum:</strong></td><td>05.09.2017</td></tr>
                                        <tr><td><strong>Zeit:</strong></td><td>08:00 Uhr - 16:00 Uhr</td></tr>
                                        <tr><td><strong>Anz. Teilnehmer:</strong></td><td>12</td></tr>
                                        <tr><td><strong>Verantwortlicher:</strong></td><td>Mitarbeiter XY</td></tr>
                                    </table>
                                </li>

                            </ul>
                        
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
                                        <th>Position</th>
                                        <th>Veranstaltung</th>
                                        <th>Anz. Teilnehmer</th>
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
                                                
                                                <td>'.$eventRegistration->getProjectWeekEntry()->getPosition().'</td>
                                                <td>'.$eventRegistration->getProjectWeekEntry()->getEvent()->name.'</td>
                                                <td>'.$eventRegistration->getProjectWeekEntry()->getParticipants().'</td>
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