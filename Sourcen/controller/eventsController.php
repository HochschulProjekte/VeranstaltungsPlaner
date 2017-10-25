<?php
    include_once __DIR__.'/../class/personnalManager.php';
    include_once __DIR__.'/../class/projectWeek.php';
    include_once __DIR__.'/../class/eventCollection.php';
    include_once __DIR__.'/../class/importEvents.php';
    include_once __DIR__.'/../controller/controllerInterface.php';

    /**
     * Class EventsController
     */
    class EventsController implements Controller {

        private $personnalManager;
        private $user;

        private $status = 'NONE';
        private $events;
        private $event;

        /**
         * EventsController constructor.
         * @param $POST_ARRAY
         * @param $personnalManager
         */
        public function __construct($POST_ARRAY, $FILES, $user) {

            $this->user = $user;
            $this->checkPageAllowed();

            $this->personnalManager = new PersonnalManager($user->getName(), $user->getEmail());

            $this->event = new Event();

            $this->parsePostArray($POST_ARRAY, $FILES);
            $this->loadAllEvents();
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
         * POST Eingabe auswerten
         * @param $POST_ARRAY
         */
        private function parsePostArray($POST_ARRAY, $FILES) {

            // Excel-Datei importieren
            if(
                isset($FILES['userfile'])
            ) {
                $this->importEvents($FILES['userfile']['tmp_name']);
            }

            // Neue Veranstaltung erstellen oder vorhandene Veranstaltung anpassen
            if(
                isset($POST_ARRAY['myevent-name']) &&
                isset($POST_ARRAY['myevent-description']) &&
                isset($POST_ARRAY['myevent-length']) &&
                isset($POST_ARRAY['myevent-maxParticipants']) &&
                isset($POST_ARRAY['myevent-eventManager'])
            ) {

                $name = $POST_ARRAY['myevent-name'];
                $description = $POST_ARRAY['myevent-description'];
                $length = $POST_ARRAY['myevent-length'];
                $maxParticipants = $POST_ARRAY['myevent-maxParticipants'];
                $personnalManager = $POST_ARRAY['myevent-eventManager'];

                if(isset($POST_ARRAY['myevent-id'])) {
                    // Event bearbeiten
                    $id = $POST_ARRAY['myevent-id'];

                    $this->saveEvent($id, $name, $description, $length, $maxParticipants, $personnalManager);
                } else {
                    // Event erstellen
                    $this->createEvent($name, $description, $length, $maxParticipants, $personnalManager);
                }
            }

            // Bearbeitung vorbereiten
            if(
                isset($POST_ARRAY['edit']) &&
                isset($POST_ARRAY['id'])
            ) {
                $this->prepareEdit($POST_ARRAY['id']);
            }

            // Event löschen
            if(
                isset($POST_ARRAY['delete']) &&
                isset($POST_ARRAY['id'])
            ) {
                $this->deleteEvent($POST_ARRAY['id']);
            }
        }

        /**
         * Importiert Veranstaltungen aus einer hochgeladenen Datei.
         * @param string $file Dateiname
         */
        private function importEvents($file) {
            $import = new ImportEvents($file);
        }

        /**
         * Veranstaltung laden.
         * @param int $id Veranstaltungs-ID
         */
        private function prepareEdit($id) {
            $this->event = new Event($id);
        }

        /**
         * Erstellt ein neue Veranstaltung
         * @param string $name
         * @param string $description
         * @param int $length Halbtage
         * @param int $maxParticipants
         * @param string $personnalManager Benutzername des Verantwortlichen
         */
        private function createEvent($name, $description, $length, $maxParticipants, $personnalManager) {
            $user = new PersonnalManager('Chef', 'chef@boss.de');

            if($user->createEvent(  $name, $description, $length, $maxParticipants, $personnalManager)) {
                $this->status = 'SUCCESS';
            } else {
                $this->status = 'ERROR';
            }
        }

        /**
         * Speichere vorhandene Veranstaltung
         * @param int $id
         * @param string $name
         * @param string $description
         * @param int $length
         * @param int $maxParticipants
         * @param string $personnalManager Benutzername des Verantwortlichen
         */
        private function saveEvent($id, $name, $description, $length, $maxParticipants, $personnalManager) {
            $event = new Event($id);
            $event->name = $name;
            $event->description = $description;
            $event->length = $length;
            $event->maxParticipants = $maxParticipants;
            $event->eventManager = $personnalManager;

            if($event->save()) {
                $this->status = 'SUCCESS';
            } else {
                $this->status = 'ERROR';
            }
        }

        /**
         * Loesche eine vorhandene Veranstaltung
         * @param int $id
         */
        private function deleteEvent($id) {
            $event = new Event($id);
            $event->delete();
        }

        /**
         * Laden aller moeglichen Veranstaltungen
         */
        private function loadAllEvents() {
            $eventCollection = new EventCollection();
            $eventCollection->addAllEvents();

            $this->events = $eventCollection->getEvents();
        }

        /**
         * Gibt den Dateinamen der Template-Datei zurueck.
         * @return string Dateiname
         */
        public function getTemplate() {
            return 'controlEventsTemplate';
        }

        /**
         * Gibt den Dateinamen der CSS-Datei zurueck.
         * @return string Dateiname
         */
        public function getStyleSheet() {
            return 'controlEvents';
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
            return 'controlEvents';
        }

        /**
         * Gibt den angemeldeten User zurueck.
         * @return User
         */
        public function getUser() {
            return $this->user;
        }


        public function getStatus() {
            return $this->status;
        }

        public function getEvents() {
            return $this->events;
        }

        public function getEvent() {
            return $this->event;
        }
    }

?>