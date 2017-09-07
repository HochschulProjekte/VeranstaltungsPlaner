<!DOCTYPE html>
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Title -->
    <title>Meine Veranstaltungen</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Includes -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/myevents.css"
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
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Startseite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Veranstaltungsübersicht</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="myevents.php">Meine Veranstaltungen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Verwaltung</a>
                </li>
            </ul>
            <span class="nav-item">
                <a class="nav-link" href="myprofile.php">Mein Profil</a>
            </span>
            <span class="nav-item">
                <a class="nav-link" href="#">Ausloggen</a>
            </span>
        </div>
    </nav>

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

            <!-- Tab Content -->
            <div class="tab-content">

                <!-- Time period and control -->
                <div class="period-control">
                    <span class="period">04.09.2017 - 08.09.2017</span>
                    <a class="btn btn-light btn-back" href="#" role="button"><</a>
                    <a class="btn btn-light btn-forward" href="#" role="button">></a>
                </div>
                
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
                                        <th>Datum</th>
                                        <th>Zeit</th>
                                        <th>Bezeichnung</th>
                                        <th>Anz. Teilnehmer</th>
                                        <th>Verantwortlicher</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr style="background-color: #EEE;">
                                        <th scope="row">04.09.2017</th>
                                        <td>08:00 Uhr - 12:00 Uhr</td>
                                        <td>Veranstaltungsbezeichnung</td>
                                        <td>12</td>
                                        <td>Mitarbeiter XY</td>
                                    </tr>
                                    <tr style="background-color: #FFF;">
                                        <th scope="row">04.09.2017</th>
                                        <td>08:00 Uhr - 12:00 Uhr</td>
                                        <td>Veranstaltungsbezeichnung</td>
                                        <td>12</td>
                                        <td>Mitarbeiter XY</td>
                                    </tr>
                                    <tr style="background-color: #EEE;">
                                        <th scope="row">04.09.2017</th>
                                        <td>08:00 Uhr - 12:00 Uhr</td>
                                        <td>Veranstaltungsbezeichnung</td>
                                        <td>12</td>
                                        <td>Mitarbeiter XY</td>
                                    </tr>
                                    <tr style="background-color: #FFF;">
                                        <th scope="row">04.09.2017</th>
                                        <td>08:00 Uhr - 12:00 Uhr</td>
                                        <td>Veranstaltungsbezeichnung</td>
                                        <td>12</td>
                                        <td>Mitarbeiter XY</td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>        

                    </div>

                </div>
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

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

  </body>

</html>