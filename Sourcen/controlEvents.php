<?php
    // Authenticate user
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/authenticateUser.php';

    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/pagehandler/controlEventsHandler.php';

?>
    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">
        
        <div class="row justify-content-center">

            <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">
        
                <div class="jumbotron create-event">
                    
                    <h1 class="h2">Verantstaltungen</h1>

                    <hr>

                    <form action="#" method="post" id="needs-validation">
                        <?php

                        if($event->id != NULL) {
                            echo '<input type="hidden" name="myevent-id" value="'.$event->id.'" />';
                        }

                        echo '
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-university"></i></div>
                            <input type="text" class="form-control" id="myevent-name" name="myevent-name" placeholder="Name" value="'.$event->name.'" required>
                        </div>

                        <div class="input-group secound-group">
                            <div class="input-group-addon"><i class="fa fa-file-text-o"></i></div>
                            <input type="text" class="form-control" id="myevent-description" name="myevent-description" placeholder="Beschreibung" value="'.$event->description.'" required>
                        </div>

                        <div class="input-group secound-group">
                            <div class="input-group-addon"><i class="fa fa-long-arrow-right"></i></div>
                            <input type="text" class="form-control" id="myevent-length" name="myevent-length" placeholder="Länge" value="'.$event->length.'" required>
                        </div>

                        <div class="input-group secound-group">
                            <div class="input-group-addon"><i class="fa fa-users"></i></div>
                            <input type="text" class="form-control" id="myevent-maxParticipants" name="myevent-maxParticipants" placeholder="Max. Teilnehmer" value="'.$event->maxParticipants.'" required>
                        </div>

                        <hr>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-md"></i></div>
                            <input type="text" class="form-control" id="myevent-eventManager" name="myevent-eventManager" placeholder="Dozent" value="'.$event->eventManager.'" required>
                        </div>
                        ';
                        ?>
                        <hr>

                        <center>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                            <a href="control.php" class="btn btn-secondary" role="button" aria-pressed="true">Abbrechen</a>
                        </center>

                    </form>

                    <?php
                        if($status == 'SUCCESS') {
                            echo '
                            <div class="my-message alert alert-success" role="alert">
                                Die Veranstaltung wurde erfolgreich gespeichert!
                            </div>    
                            ';
                        } else if($status == 'ERROR') {
                            echo '
                            <div class="my-message alert alert-danger" role="alert">
                                Es ist ein Fehler aufgetreten!
                            </div>
                            ';
                        }
                    ?>

                    <hr>

                    <form id="edit" action="#" method="POST">
                        <input type="hidden" name="edit" value="X" />
                    </form>
                    <form id="delete" action="#" method="POST">
                        <input type="hidden" name="delete" value="X" />
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Länge</th>
                                <th>Max.</th>
                                <th>Dozent</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $projectWeek = new ProjectWeek();
                                $events = $projectWeek->loadAllEvents();

                                foreach($events as $event) {
                                    echo '
                                
                            <tr>
                                <td>'.$event->name.'</td>
                                <td>'.$event->length.'</td>
                                <td>'.$event->maxParticipants.'</td>
                                <td>'.$event->eventManager.'</td>
                                <td><button type="button" onclick="editEvent('.$event->id.')">E</button></td>
                                <td><button type="button" onclick="deleteEvent('.$event->id.')">X</button></td>
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

<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/footer.php';
?>

<script>

    function editEvent(eventId) {
        $('#edit').append('<input type="hidden" name="id" value="'+ eventId +'" />');
        $("#edit").submit(); 
    }

    function deleteEvent(eventId) {
        $('#delete').append('<input type="hidden" name="id" value="'+ eventId +'" />');
        $("#delete").submit(); 
    }

</script>