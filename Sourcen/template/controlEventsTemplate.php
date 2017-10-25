<!-- Wrapper -->
<div class="container-fluid" id="wrapper">

    <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">

            <div class="jumbotron create-event">

                <h1 class="h2">Veranstaltungen</h1>

                <hr>

                <form action="#" method="post" id="needs-validation">
                    <?php

                    if($controller->getEvent()->id != NULL) {
                        echo '<input type="hidden" name="myevent-id" value="'.$controller->getEvent()->id.'" />';
                    }

                    echo '
                        <div class="input-group event-input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-university"></i></div>
                            <input type="text" class="form-control" id="myevent-name" name="myevent-name" placeholder="Name" value="'.$controller->getEvent()->name.'" required>
                        </div>

                        <div class="input-group secound-group event-input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-file-text-o"></i></div>
                            <input type="text" class="form-control" id="myevent-description" name="myevent-description" placeholder="Beschreibung" value="'.$controller->getEvent()->description.'" required>
                        </div>

                        <div class="input-group secound-group event-input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-long-arrow-right"></i></div>
                            <input type="text" class="form-control" id="myevent-length" name="myevent-length" placeholder="Länge" value="'.$controller->getEvent()->length.'" required>
                        </div>

                        <div class="input-group secound-group event-input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-users"></i></div>
                            <input type="text" class="form-control" id="myevent-maxParticipants" name="myevent-maxParticipants" placeholder="Max. Teilnehmer" value="'.$controller->getEvent()->maxParticipants.'" required>
                        </div>

                        <hr>

                        <div class="input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-user-md"></i></div>
                            <input type="text" class="form-control" id="myevent-eventManager" name="myevent-eventManager" placeholder="Dozent" value="'.$controller->getEvent()->eventManager.'" required>
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
                if($controller->getStatus() == 'SUCCESS') {
                    echo '
                            <div class="my-message alert alert-success" role="alert">
                                Die Veranstaltung wurde erfolgreich gespeichert!
                            </div>    
                            ';
                } else if($controller->getStatus() == 'ERROR') {
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

                    foreach($controller->getEvents() as $event) {
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

                <center>
                    <form enctype="multipart/form-data" action="#" method="post">
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        <input name="userfile" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                        <button type="submit" class="btn btn-primary">Importieren</button>
                    </form>
                </center>
            </div>

        </div>

    </div>
</div>
