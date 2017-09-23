<?php
    // Authenticate user
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/authenticateUser.php';

    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/personnalManager.php';

    $status = 'NONE';

    if(
        isset($_POST['myevent-name']) &&
        isset($_POST['myevent-description']) &&
        isset($_POST['myevent-length']) &&
        isset($_POST['myevent-maxParticipants']) &&
        isset($_POST['myevent-eventManager'])
    ) {

        $name = $_POST['myevent-name'];
        $description = $_POST['myevent-description'];
        $length = $_POST['myevent-length'];
        $maxParticipants = $_POST['myevent-maxParticipants'];
        $eventManager = $_POST['myevent-eventManager'];

        $user = new PersonnalManager('Chef', 'chef@boss.de');
        
        if($user->createEvent(  $name, $description, $length,
                                $maxParticipants, $eventManager)) {
            $status = 'SUCCESS';
        } else {
            $status = 'ERROR';
        }
    }

?>
    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">
        
        <div class="row justify-content-center">

            <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">
        
                <div class="jumbotron create-event">
                    
                    <h1 class="h2">Verantstaltung erstellen</h1>

                    <hr>

                    <form action="#" method="post" id="needs-validation">

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-university"></i></div>
                            <input type="text" class="form-control" id="myevent-name" name="myevent-name" placeholder="Name" value="" required>
                        </div>

                        <div class="input-group secound-group">
                            <div class="input-group-addon"><i class="fa fa-file-text-o"></i></div>
                            <input type="text" class="form-control" id="myevent-description" name="myevent-description" placeholder="Beschreibung" value="" required>
                        </div>

                        <div class="input-group secound-group">
                            <div class="input-group-addon"><i class="fa fa-long-arrow-right"></i></div>
                            <input type="text" class="form-control" id="myevent-length" name="myevent-length" placeholder="Länge" value="" required>
                        </div>

                        <div class="input-group secound-group">
                            <div class="input-group-addon"><i class="fa fa-users"></i></div>
                            <input type="text" class="form-control" id="myevent-maxParticipants" name="myevent-maxParticipants" placeholder="Max. Teilnehmer" value="" required>
                        </div>

                        <hr>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-md"></i></div>
                            <input type="text" class="form-control" id="myevent-eventManager" name="myevent-eventManager" placeholder="Dozent" value="" required>
                        </div>

                        <hr>

                        <center>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                            <a href="./overview.php" class="btn btn-secondary" role="button" aria-pressed="true">Abbrechen</a>
                        </center>

                    </form>

                    <?php
                        if($status == 'SUCCESS') {
                            echo '
                            <div class="my-message alert alert-success" role="alert">
                                Die Veranstaltung wurde erfolgreich erstellt!
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

                </div>
            
            </div>

        </div>
    </div>

<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/footer.php';
?>