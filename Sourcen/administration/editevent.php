<?php
    include $_SERVER['DOCUMENT_ROOT'].'/vstp/administration/createevent.php';
?>

<!DOCTYPE html>
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Title -->
    <title></title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Includes -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/mycreateevent.css">
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
                    <a class="nav-link" href="#">Startseite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Veranstaltungsübersicht</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Meine Veranstaltungen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Verwaltung</a>
                </li>
            </ul>
            <span class="nav-item">
                <a class="nav-link" href="#">Mein Profil</a>
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

                        <hr>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control" id="myevent-date" name="myevent-date" placeholder="Startdatum" value="" required>
                        </div>

                        <div class="input-group secound-group">
                            <div class="input-group-addon"><i class="fa fa-long-arrow-right"></i></div>
                            <input type="text" class="form-control" id="myevent-length" name="myevent-length" placeholder="Tageslänge" value="" required>
                        </div>

                        <hr>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>
                            <input type="text" class="form-control" id="myevent-participants" name="myevent-participants" placeholder="Teilnehmer" value="" required>
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