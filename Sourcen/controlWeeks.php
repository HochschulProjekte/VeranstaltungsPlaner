<?php

    // Authenticate user
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/authenticateUser.php';

    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/projectWeekHandler.php';
?>

    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">
        
        <div class="row justify-content-center">

            <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">

                <div class="jumbotron create-event">
                    <form id="projectWeek" action="#" method="POST"></form>
                    <?php
                        echo '
                        <button type="button" onclick="previousWeek('.$projectWeek->getYear().', '.$projectWeek->getWeek().')" class="btn btn-secondary"><</button>
                        <a>Woche: '.$projectWeek->getWeek().' - '.$projectWeek->getFromDate().' - '.$projectWeek->getUntilDate().'</a>
                        <button type="button" onclick="nextWeek('.$projectWeek->getYear().', '.$projectWeek->getWeek().')" class="btn btn-secondary">></button>
                        ';
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-university"></i></div>
                                            <?php
                                            echo '
                                                <input type="hidden" name="addevent" value="X" />
                                                <input type="hidden" name="year" value="'.$projectWeek->getYear().'" />
                                                <input type="hidden" name="week" value="'.$projectWeek->getWeek().'" />
                                            ';
                                            ?>
                                            <input type="text" class="form-control" id="myprojectweek-position" name="position" placeholder="Position" value="" required>
                                        </div>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-university"></i></div>
                                            <input type="text" class="form-control" id="myprojectweek-participants" name="participants" placeholder="Max. Teilnehmer" value="" required>
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
                                                    $events = $projectWeek->loadAllEvents();

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
                            <th>Name</th>
                            <th>Position</th>
                            <th>Länge</th>
                            <th>Dozent</th>
                            <th>max.</th>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <form id="delete" action="#" method="POST"></form>
                            <?php
                                foreach ($projectWeek->getProjectWeekEntries() as $entry) {
                                    echo '
                                    <tr>
                                        <td>'.$entry->getEvent()->name.'</td>
                                        <td>'.$entry->getPosition().'</td>
                                        <td>'.$entry->getEvent()->length.'</td>
                                        <td>'.$entry->getEvent()->eventManager.'</td>
                                        <td>'.$entry->getMaxParticipants().'</td>
                                        <td>'.$entry->getEvent()->description.'</td>
                                        <td><button type="button" onclick="deleteEvent('.$entry->getEventId().', '.$entry->getYear().', '.$entry->getWeek().', '.$entry->getPosition().')" class="btn btn-secondary">X</button></td>
                                    </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                    </table>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Veranstaltung hinzufügen
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/vstp/footer.php';
?>

<script>

    function previousWeek(currentYear, currentWeek) {

        if(currentWeek == 1) {
            submitWeek(currentYear - 1, 52);
            return;
        }
        submitWeek(currentYear, currentWeek-1);
    }
    
    function nextWeek(currentYear, currentWeek) {
        if(currentWeek == 52) {
            submitWeek(currentYear + 1, 1);
            return;
        }
        submitWeek(currentYear, currentWeek+1);
    }

    function submitWeek(year, week) {
        $('#projectWeek').append('<input type="hidden" name="year" value="'+ year +'" />');
        $('#projectWeek').append('<input type="hidden" name="week" value="'+ week +'" />');
        $("#projectWeek").submit(); 
    }

    function deleteEvent(id, year, week, position) {
        $('#delete').append('<input type="hidden" name="eventId" value="'+ id +'" />');
        $('#delete').append('<input type="hidden" name="year" value="'+ year +'" />');
        $('#delete').append('<input type="hidden" name="week" value="'+ week +'" />');
        $('#delete').append('<input type="hidden" name="position" value="'+ position +'" />');
        $('#delete').append('<input type="hidden" name="delete" value="X" />');
        $("#delete").submit(); 
    }

</script>