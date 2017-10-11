<?php

    // Authenticate user
    include_once './administration/authenticateUser.php';

    // User Interface
    include_once './class/userInterface.php';
    $userInterface = new UserInterface($myUser,'index');
    $userInterface->renderHeader();

?>

    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">
        
        <div class="row justify-content-center">

            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">

                <ul class="list-group information-list">

                    <li class="list-group-item active">Informationen</li>

                    <li class="list-group-item list-group-item-warning">
                        Sie haben noch keine Priorisierungen für folgende Zeiträume vorgenommen:
                        <ul>
                            <li>10.09.2017, 1. Halbtag</li>
                            <li>12.09.2017, 1. Halbtag</li>
                            <li>12.09.2017, 2. Halbtag</li>
                        </ul>
                    </li>

                    <li class="list-group-item list-group-item-primary">
                        Die Veranstaltungsliste für die kommende Woche ist nun freigeschaltet.
                    </li>

                    <li class="list-group-item list-group-item-danger">
                        Die Veranstaltungsliste für die kommende Woche wurde noch nicht freigeschaltet.
                    </li>

                    <li class="list-group-item">
                        <i>Keine neuen Informationen vorhanden</i>
                    </li>

                </ul>

            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">

                <ul class="list-group event-list">

                    <li class="list-group-item active">Heute, 04.09.2017</li>

                    <li class="list-group-item">
                        <span class="event-title">Veranstaltungsbezeichnung</span>
                        <table class="event-information">
                            <tr><td><strong>Datum:</strong></td><td>04.09.2017</td></tr>
                            <tr><td><strong>Zeit:</strong></td><td>08:00 Uhr - 12:00 Uhr</td></tr>
                            <tr><td><strong>Anz. Teilnehmer:</strong></td><td>12</td></tr>
                            <tr><td><strong>Verantwortlicher:</strong></td><td>Mitarbeiter XY</td></tr>
                        </table>
                    </li>

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

                <ul class="list-group event-list">

                    <li class="list-group-item active">Morgen, 05.09.2017</li>

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

<?php
    $userInterface->renderFooter();
?>