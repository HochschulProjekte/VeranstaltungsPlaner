<?php

// Authenticate user
include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/authenticateUser.php';

?>

<!DOCTYPE html>
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Title -->
    <title>Nutzer verwalten</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Includes -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/controlUsers.css">
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

        <!-- Table showing users -->
        <div class="row users">
            <!-- Message -->
            <div class="col-12">
                <div id="edit-message" class="alert alert-danger" role="alert"></div>
            </div>
            <!-- Table -->
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Name</th>
                        <th><center>Sachbearbeiter</center></th>
                        <th>E-Mail</th>
                    </tr>
                </thead>
                <tbody id="tbody-users"></tbody>
            </table>
        </div>

        <!-- Form for adding a new user -->
        <div class="row add-user">

            <!-- Heading -->
            <div class="col-12">
                <h4>Nutzer hinzufügen</h4>
            </div>

            <!-- Message -->
            <div class="col-12">
                <div id="new-message" class="alert alert-danger" role="alert"></div>
            </div>

            <!-- Name -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2">
                <input type="text" class="form-control" name="new-name" id="new-name" maxlength="12" placeholder="Name">
            </div>

            <!-- Password -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2">
                <input type="password" class="form-control" name="new-password" id="new-password" maxlength="45" placeholder="Passwort">
            </div>

            <!-- Confirm Password -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2">
                <input type="password" class="form-control" name="new-password-confirm" id="new-password-confirm" maxlength="45" placeholder="Passwort bestätigen">
            </div>

            <!-- personnal Manager -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-2 col-xl-2">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="new-personnal-manager" id="new-personnal-manager" value="yes"> Sachbearbeiter
                    </label>
                </div>
            </div>

            <!-- E-Mail -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-4">
                <input type="email" class="form-control" name="new-email" id="new-email" maxlength="45" placeholder="E-Mail (optional)">
            </div>

            <!-- Submit -->
            <div class="col-12">
                <center><a class="btn btn-danger" id="new-submit" href="#" role="button">Speichern</a></center>
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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script src="js/controlUsers.js"></script>

  </body>

</html>