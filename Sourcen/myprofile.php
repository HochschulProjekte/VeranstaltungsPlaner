<?php

// Authenticate user
include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/authenticateUser.php';

?>

<!DOCTYPE html>
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Title -->
    <title>Mein Profil</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Includes -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/myprofile.css">
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
            <span class="nav-item active">
                <a class="nav-link" href="myprofile.php">Mein Profil</a>
            </span>
            <span class="nav-item">
                <a class="nav-link" href="#">Ausloggen</a>
            </span>
        </div>
    </nav>

    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">

        <div class="row justify-content-center">

            <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">
        
                <div class="jumbotron">
                    
                    <h1 class="display-3 h1">Mein Profil</h1>

                    <hr>

                    <label>Username: username</label>

                    <hr>

                    <form action="#" method="post">

                        <h2 class="display-3 h2">E-Mail ändern</h2>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                            <input type="email" class="form-control" id="myprofile-email" name="myprofile-email" placeholder="E-Mail" value="mail@mail.de">
                        </div>

                        <hr>

                        <h2 class="display-3 h2">Passwort ändern</h2>

                        <input type="password" class="form-control" id="myprofile-oldpassword" name="myprofile-oldpassword" placeholder="Altes Passwort" value="passwort">

                        <input type="password" class="form-control" id="myprofile-newpassword" name="myprofile-newpassword" placeholder="Neues Passwort">

                        <input type="password" class="form-control" id="myprofile-passwordconfirm" name="myprofile-passwordconfirm" placeholder="Passwort bestätigen">

                        <center><button type="submit" class="btn btn-primary">Speichern</button></center>

                    </form>

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

  </body>

</html>