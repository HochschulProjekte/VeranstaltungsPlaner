<?php

    include_once __DIR__.'/../controller/controllerInterface.php';

    /**
     * Class UserInterface
     * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
     */
    class UserInterface {

        private $controller;

        /**
         * UserInterface constructor.
         * @param User $user Benutzer-Objekt
         * @param string $fileName Dateiname fuer die CSS-Datei
         */
        function __construct($controller) {
            $this->controller = $controller;
        }

        /**
         * Gibt den Inhalt der gesamten Seite aus.
         */
        public function renderPage() {
            $this->renderHeader();
            $this->renderContent();
            $this->renderFooter();
        }

        /**
         * Gibt die Kopfzeile aus.
         */
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
                <link rel="stylesheet" href="css/'.$this->controller->getStyleSheet().'.css">
              </head>
            
              <!-- BODY -->
              <body>
            
                <!-- Navbar -->
                <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="index.php">Veranstaltungsplaner</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            '.($this->controller->getUser()->isPersonnalManager() ? '<li class="nav-item">
                                <a class="nav-link" href="control.php">Verwaltung</a>
                            </li>' : '').'
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

        /**
         * Gibt den Inhalt der Datei aus.
         */
        public function renderContent() {
            $controller = $this->controller;
            include __DIR__.'/../template/'.$this->controller->getTemplate().'.php';
        }

        /**
         * Gibt die Fusszeile aus.
         */
        public function renderFooter() {
            echo '
            <!-- Footer -->
            <nav class="navbar navbar-bottom navbar-light bg-light">
                <span class="navbar-text pull-right">by Matthias Fischer, Jonathan Hermsen, Fabian Hagengers</span>
            </nav>
            
            <!-- Javascript Includes -->
            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin=" anonymous"></script>
            
            '.(($this->controller->isScriptFileAvailable()) ? '<script src="js/'.$this->controller->getScriptFile().'.js"></script>' : '').'
            </body>
            
            </html>
            ';
        }
    }

?>