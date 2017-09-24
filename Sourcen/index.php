<?php

// Authenticate user
include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/authenticateUser.php';

?>

<!DOCTYPE html>
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Title -->
    <title>Startseite</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Includes -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/index.css">
  </head>

  <!-- BODY -->
  <body>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Veranstaltungsplaner</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Startseite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Veranstaltungsübersicht</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myevents.php">Meine Veranstaltungen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="control.php">Verwaltung</a>
                </li>
            </ul>
            <span class="nav-item">
                <a class="nav-link" href="myprofile.php">Mein Profil</a>
            </span>
            <span class="nav-item">
                <a class="nav-link" href="logout.php">Ausloggen</a>
            </span>
        </div>
    </nav>

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

    <!-- Footer -->
    <nav class="navbar navbar-bottom navbar-light bg-light">
        <span class="nav-item">
            <a class="nav-link" href="#">Impressum</a>
        </span>
        <span class="navbar-text pull-right">by Matthias Fischer, Jonathan Hermsen, Fabian Hagengers</span>
    </nav>

    <!-- Javascript Includes -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  </body>

</html>