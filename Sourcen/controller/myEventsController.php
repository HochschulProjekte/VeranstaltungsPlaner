<?php

    include_once __DIR__.'/../class/user.php';
    include_once __DIR__.'/../class/projectWeek.php';
    include_once __DIR__.'/../class/projectWeekEntry.php';

    include_once __DIR__.'/../class/eventRegistration.php';
    include_once __DIR__.'/../class/eventRegistrationRepresentation.php';
    include_once __DIR__.'/../class/eventRegistrationCollection.php';

    /**
     * Class MyEventsController
     */
    class MyEventsController {
        
        private $user;
        private $projectWeek;
        private $eventRegistrationCollection;

        /**
         * MyEventsController constructor.
         * @param $POST_ARRAY
         */
        function __construct($POST_ARRAY) {
            $this->parsePostArray($POST_ARRAY);
        }

        /**
         * POST Eingabe auswerten.
         * @param $POST_ARRAY
         */
        private function parsePostArray($POST_ARRAY) {

            $year = NULL;
            $week = NULL;
            
            if(
                isset($POST_ARRAY['year'])
                && isset($POST_ARRAY['week'])
            ) {
                $year = $POST_ARRAY['year'];
                $week = $POST_ARRAY['week'];
            } else {
                $year = ProjectWeek::getCurrentCalendarYear();
                $week = ProjectWeek::getCurrentCalendarWeek();
            }

            // Projektwochen-Objekt erstellen
            $this->createProjectWeek($year, $week);

            // Benutzerobjekt erstellen
            $this->createUserObject($_SESSION['username']);

            // Benutzer an einer Veranstaltung registrierten
            if(
                isset($POST_ARRAY['registration'])
                && isset($POST_ARRAY['projectWeekEntryId'])
                && isset($POST_ARRAY['priority'])
            ) {
                $this->registerToEvent($POST_ARRAY['projectWeekEntryId'], $POST_ARRAY['priority']);
            }

            // Alle Anmeldungen zu Events eines Nutzers laden
            $this->createEventRegistrationCollection();
        }

        /**
         * Erstellt ein Projektwochen-Objekt
         * @param int $year
         * @param int $week
         */
        private function createProjectWeek($year, $week) {
            $this->projectWeek = new ProjectWeek($year, $week);
        }

        /**
         * Erstellt das User-Objekt zu einem Benutzernamen.
         * @param string $username
         */
        private function createUserObject($username) {
            $this->user = new User($username);
        }

        /**
         * Registiert einen Nutzer an einem spezifischen Projektwochen-Eintrag
         * @param int $projectWeekEntryId
         * @param int $priority
         */
        private function registerToEvent($projectWeekEntryId, $priority) {

            $eventRegistration = new EventRegistration(NULL);

            $eventRegistration->setUsername($this->user->getName());
            $eventRegistration->setProjectWeekEntry(new ProjectWeekEntry($projectWeekEntryId));
            $eventRegistration->setPriority($priority);
            $eventRegistration->setApproved('0');
            $eventRegistration->setRegistrationDate(date('Y-m-d H:i:s'));

            $eventRegistration->save();
        }

        /**
         * Erstellt eine Liste von Veranstaltungs-Registrierungen fuer einen spezifischen Benutzer
         * und Projektwochen kombination.
         */
        private function createEventRegistrationCollection() {
            $this->eventRegistrationCollection = new EventRegistrationCollection(
                $this->user->getName(),
                $this->projectWeek
            );
        }

        /**
         * Ist die Registeriung erlaubt?
         * @return bool
         */
        public function isRegistrationAllowed() {
            $phase = $this->projectWeek->getPhase();
            return ($phase == '2');
        }

        /**
         * Liefert die Wochentage der aktuellen Projektwoche als Array von Zeichenketten.
         * @return array Wochentage als Zeichenketten
         */
        public function getWeekDays() {
            $day_array = [];

            array_push($day_array, $this->getWeekStartDate());
            array_push($day_array, date('Y-m-d', strtotime('next tuesday', strtotime($this->getWeekStartDate()))));
            array_push($day_array, date('Y-m-d', strtotime('next wednesday', strtotime($this->getWeekStartDate()))));
            array_push($day_array, date('Y-m-d', strtotime('next thursday', strtotime($this->getWeekStartDate()))));
            array_push($day_array, date('Y-m-d', strtotime('next friday', strtotime($this->getWeekStartDate()))));

            return $day_array;
        }

        public function getEventRegistrationRepresentationAtPosition($position) {

            // Suche der Veranstaltung-Registrierung-Darstellungs-Objekte
            foreach($this->eventRegistrationCollection->getEventRepresentations() as $eventRepresentation) {

                // ist die richtige Position gefunden
                if($eventRepresentation->getPosition() == $position) {

                    // wird ueberprueft ob die Registrierung akzeptiert wurde oder nicht.
                    if($eventRepresentation->isApproved()) {
                        return $eventRepresentation;
                    } else {
                        return NULL;
                    }
                }
            }

            return NULL;
        }

        public function getWeekStartDate() {
            return $this->projectWeek->getFromDate();
        }

        public function getWeekEndDate() {
            return $this->projectWeek->getUntilDate();
        }

        public function getYear() {
            return $this->projectWeek->getYear();
        }

        public function getWeek() {
            return $this->projectWeek->getWeek();
        }

        public function getWeekEntries() {
            return $this->projectWeek->getProjectWeekEntries();
        }

        public function getEventRegistrationCollection() {
            return $this->eventRegistrationCollection;
        }
    }

?>