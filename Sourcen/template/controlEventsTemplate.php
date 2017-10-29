<!-- Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen -->

<!-- Wrapper -->
<div class="container-fluid" id="wrapper">

    <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">

            <div class="jumbotron create-event">

                <h1 class="h2">Veranstaltungen</h1>

                <hr>

                <form action="#" method="post" id="needs-validation">
                    <?php

                    if ($controller->getEvent()->getId() != NULL) {
                        echo '<input type="hidden" name="id" value="' . $controller->getEvent()->getId() . '" />';
                    }

                    echo '
                        <div class="input-group event-input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-university"></i></div>
                            <input type="text" class="form-control" id="myevent-name" name="name" placeholder="Name" value="' . $controller->getEvent()->getName() . '" required>
                        </div>

                        <div class="input-group secound-group event-input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-file-text-o"></i></div>
                            <input type="text" class="form-control" id="myevent-description" name="description" placeholder="Beschreibung" value="' . $controller->getEvent()->getDescription() . '" required>
                        </div>

                        <div class="input-group secound-group event-input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-long-arrow-right"></i></div>
                            <input type="text" class="form-control" id="myevent-length" name="length" placeholder="Länge" value="' . $controller->getEvent()->getLength() . '" required>
                        </div>

                        <div class="input-group secound-group event-input-group">
                            <div class="input-group-addon event-input-icon"><i class="fa fa-users"></i></div>
                            <input type="text" class="form-control" id="myevent-maxParticipants" name="maxParticipants" placeholder="Max. Teilnehmer" value="' . $controller->getEvent()->getMaxParticipants() . '" required>
                        </div>

                        <hr>
                        
                        <div class="form-group" class="personnalManager-label">
                                <label for="personnalManager">Dozent</label>
                                <select class="form-control" id="personnalManager" name="personnalManager">
                    ';

                    foreach ($controller->getPersonnalManagers() as $personnalManager) {
                        echo '<option>' . $personnalManager->getName() . '</option>';
                    }

                    echo '
                            </select>
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
                if ($controller->getStatus() == 'SUCCESS') {
                    echo '
                            <div class="my-message alert alert-success" role="alert">
                                ' . $controller->getMessage() . '
                            </div>    
                            ';
                } else if ($controller->getStatus() == 'ERROR') {
                    echo '
                            <div class="my-message alert alert-danger" role="alert">
                                ' . $controller->getMessage() . '
                            </div>
                            ';
                }
                ?>

                <hr>

                <form id="edit" action="#" method="POST">
                    <input type="hidden" name="edit" value="X"/>
                </form>
                <form id="delete" action="#" method="POST">
                    <input type="hidden" name="delete" value="X"/>
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

                    foreach ($controller->getEvents() as $event) {
                        echo '
                                
                                        <tr>
                                            <td>' . $event->getName() . '</td>
                                            <td>' . $event->getLength() . '</td>
                                            <td>' . $event->getMaxParticipants() . '</td>
                                            <td>' . $event->getPersonnalManager() . '</td>
                                            <td><button type="button" onclick="editEvent(' . $event->getId() . ')">E</button></td>
                                            <td><button type="button" onclick="deleteEvent(' . $event->getId() . ')">X</button></td>
                                        </tr>
                                
                                ';
                    }
                    ?>
                    </tbody>
                </table>

                <center>
                    <form enctype="multipart/form-data" action="#" method="post">
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
                        <input name="userfile" type="file"
                               accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                        <button type="submit" class="btn btn-primary">Importieren</button>
                    </form>
                </center>
            </div>

        </div>

    </div>
</div>
