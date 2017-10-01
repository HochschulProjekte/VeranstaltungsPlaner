<?php

    class UserInterface {

        private $fileName;
        private $script = NULL;

        function __construct($fileName) {
            $this->fileName = $fileName;
        }

        public function addScript($fileName) {
            $this->script = $fileName;
        }

        public function renderHeader() {

            echo '
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
                <link rel="stylesheet" href="css/font-awesome.min.css">
                <link rel="stylesheet" href="css/custom.css">
                <link rel="stylesheet" href="css/'.$this->fileName.'.css">
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
                                <a class="nav-link" href="myEvents.php">Meine Veranstaltungen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="control.php">Verwaltung</a>
                            </li>
                        </ul>
                        <span class="nav-item">
                            <a class="nav-link" href="myProfile.php">Mein Profil</a>
                        </span>
                        <span class="nav-item">
                            <a class="nav-link" href="logout.php">Ausloggen</a>
                        </span>
                    </div>
                </nav>            
            ';
        }

        public function renderFooter() {
            echo '
            <!-- Footer -->
            <nav class="navbar navbar-bottom navbar-light bg-light">
                <span class="nav-item">
                    <a class="nav-link" href="#">Impressum</a>
                </span>
                <span class="navbar-text pull-right">by Matthias Fischer, Jonathan Hermsen, Fabian Hagengers</span>
            </nav>
            
            <!-- Javascript Includes -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
            
            '.(($this->script != NULL) ? '<script src="js/'.$this->script.'.js"></script>' : '').'
            </body>
            
            </html>
            ';
        }
    }

?>