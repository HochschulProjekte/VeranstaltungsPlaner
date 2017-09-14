<?php
    include $_SERVER['DOCUMENT_ROOT'].'/vstp/navbar.php';
?>

<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/database/databasehandler.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/event.php';

    class ProjectWeek {

        const TABLE = 'ProjectWeek';

        private $databaseHandler;
        private $events = [];

        function __construct($id = NULL) {
            $this->databaseHandler = new PDOHandler();
            
           /*  if($id != NULL) {
                $this->load($id);
            } */
        }

        function loadAllEvents() {
            $result = $this->databaseHandler->select('Event', null);
            $this->events = [];

            foreach ($result as $row) {
                array_push($this->events, new Event($row['eventId']));
            }

            return $this->events;
        }
    }

    $projectWeek = new ProjectWeek();

?>

    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">
        
        <div class="row justify-content-center">

            <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Veranstaltung hinzufügen
                </button>

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
                                    <input type="text" class="form-control" id="myprojectweek-position" name="myprojectweek-position" placeholder="Position" value="" required>
                                </div>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-university"></i></div>
                                    <input type="text" class="form-control" id="myprojectweek-participants" name="myprojectweek-participants" placeholder="Max. Teilnehmer" value="" required>
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
                    <th>#</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Länge</th>
                    <th>Datum</th>
                    <th>Verantwortlicher</th>
                    <th>max. Teilnehmer</th>
                    <th>Beschreibung</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/vstp/footer.php';
?>