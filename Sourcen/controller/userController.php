<?php

    include_once __DIR__.'/../controller/controllerInterface.php';

    /**
     * Class UserController
     */
    class UserController implements Controller {

        private $user;

        /**
         * UserController constructor.
         * @param $user
         */
        public function __construct($user) {
            $this->user = $user;
            $this->checkPageAllowed();
        }

        /**
         * Ueberprueft ob der Nutzer genug Rechte hat, um die Seite zu besuchen.
         */
        private function checkPageAllowed() {

            if (!$this->user->isPersonnalManager()) {

                header('Location: ./index.php');
                exit();
            }
        }

        /**
         * Gibt den Dateinamen der Template-Datei zurueck.
         * @return string Dateiname
         */
        public function getTemplate() {
            return 'controlUsersTemplate';
        }

        /**
         * Gibt den Dateinamen der CSS-Datei zurueck.
         * @return string Dateiname
         */
        public function getStyleSheet() {
            return 'controlUsers';
        }

        /**
         * Ob eine JavaScript-Datei vorhanden ist oder nicht.
         * @return boolean
         */
        public function isScriptFileAvailable() {
            return true;
        }

        /**
         * Gibt den Dateinamen der JavaScript-Datei zurueck.
         * @return string Dateiname
         */
        public function getScriptFile() {
            return 'controlUsers';
        }

        /**
         * Gibt den angemeldeten User zurueck.
         * @return User
         */
        public function getUser() {
            return $this->user;
        }


    }

?>