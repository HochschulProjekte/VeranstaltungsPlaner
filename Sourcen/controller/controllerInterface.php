<?php

    /**
     * Interface Controller
     * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
     */
    interface Controller {
        /**
         * Gibt den Dateinamen der Template-Datei zurueck.
         * @return string Dateiname
         */
        public function getTemplate();

        /**
         * Gibt den Dateinamen der CSS-Datei zurueck.
         * @return string Dateiname
         */
        public function getStyleSheet();

        /**
         * Ob eine JavaScript-Datei vorhanden ist oder nicht.
         * @return boolean
         */
        public function isScriptFileAvailable();

        /**
         * Gibt den Dateinamen der JavaScript-Datei zurueck.
         * @return string Dateiname
         */
        public function getScriptFile();

        /**
         * Gibt den angemeldeten User zurueck.
         * @return User
         */
        public function getUser();
    }

?>