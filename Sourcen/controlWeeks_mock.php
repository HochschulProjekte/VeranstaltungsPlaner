<!DOCTYPE html>
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Title -->
    <title>Wochen verwalten</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Includes -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/controlWeeks.css">
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
                <a class="nav-link" href="#">Ausloggen</a>
            </span>
        </div>
    </nav>

    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">
        
        <!-- Show week and control back and forward -->
        <div class="row week">
            <div class="col-12">
                <center>
                    <a href="#" id="btn-back"><i class="fa fa-chevron-left"></i></a>
                    04.09.2017 - 08.09.2017
                    <a href="#" id="btn-forward"><i class="fa fa-chevron-right"></i></a>
                </center>
            </div>
        </div>

        <!-- Table showing events for selected week -->
        <div class="row events">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Datum</th>
                        <th>Länge</th>
                        <th>Verantwortlicher</th>
                        <th>Max. Anzahl Teilnehmer</th>
                        <th>Beschreibung</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Veranstaltung</td>
                        <td>05.09.2017</td>
                        <td>Ganztägig</td>
                        <td>Mitarbeiter XY</td>
                        <td>12</td>
                        <td>1 gute Veranstaltung vong Niceigkeit her, lol</td>
                    </tr>
                    <tr>
                        <td>Veranstaltung</td>
                        <td>05.09.2017</td>
                        <td>Ganztägig</td>
                        <td>Mitarbeiter XY</td>
                        <td>12</td>
                        <td>1 gute Veranstaltung vong Niceigkeit her, lol</td>
                    </tr>
                    <tr>
                        <td>Veranstaltung</td>
                        <td>05.09.2017</td>
                        <td>Ganztägig</td>
                        <td>Mitarbeiter XY</td>
                        <td>12</td>
                        <td>1 gute Veranstaltung vong Niceigkeit her, lol</td>
                    </tr>
                    <tr>
                        <td>Veranstaltung</td>
                        <td>05.09.2017</td>
                        <td>Ganztägig</td>
                        <td>Mitarbeiter XY</td>
                        <td>12</td>
                        <td>1 gute Veranstaltung vong Niceigkeit her, lol</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Form for adding a new event to the week -->
        <div class="row add-event">

            <!-- Heading -->
            <div class="col-12">
                <h4>Veranstaltung hinzufügen</h4>
                <button class="btn btn-success">Importieren</button>
            </div>

            <!-- Name -->
            <div class="col-12 col-sm-8 col-md-8 col-lg-4 col-xl-2">
                <input type="text" class="form-control" name="name" id="name" maxlength="45" placeholder="Name">
            </div>

            <!-- Date -->
            <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2">
                <input type="text" class="form-control" name="date" id="date" maxlength="10" placeholder="Datum">
            </div>

            <!-- Length -->
            <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-1">
                <select class="form-control" name="length" id="length">
                    <option selected>1. Halbtag</option>
                    <option>2. Halbtag</option>
                    <option>Gantägig</option>
                    <option>2 Tage</option>
                    <option>3 Tage</option>
                    <option>4 Tage</option>
                    <option>5 Tage</option>
                </select>
            </div>

            <!-- EventManager -->
            <div class="col-12 col-sm-8 col-md-8 col-lg-4 col-xl-2">
                <select class="form-control" name="eventManager" id="eventManager">
                    <option selected>Mitarbeiter XY</option>
                    <option>Mitarbeiter XZ</option>
                    <option>Mitarbeiter YZ</option>
                </select>
            </div>

            <!-- Max. Participants -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                <input type="text" class="form-control" name="maxParticipants" id="maxParticipants" placeholder="Max. Anzahl Teilnehmer">
            </div>

            <!-- Description -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-3">
                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Beschreibung"></textarea>
            </div>

            <!-- Submit -->
            <div class="col-12">
                <center><button type="submit" class="btn btn-danger" id="submit">Speichern</button></center>
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