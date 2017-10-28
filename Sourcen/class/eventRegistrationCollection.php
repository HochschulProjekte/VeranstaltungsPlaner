<?php

include_once __DIR__ . '/../database/databaseHandler.php';
include_once __DIR__.'/../class/projectWeek.php';
include_once __DIR__.'/../class/eventRegistration.php';
include_once __DIR__.'/../class/eventRegistrationRepresentation.php';

    /**
     * Class EventRegistrationCollection
     * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
     */
    class EventRegistrationCollection {

        const TABLE = 'EventRegistration';

        private $databaseHandler;

        private $username;
        private $projectWeek;
        private $eventRegistrations = [];

        /**
         * EventRegistrationCollection constructor.
         * @param $username
         * @param $projectWeek
         */
        public function __construct($username, $projectWeek) {

            $this->databaseHandler = new PDOHandler();

            $this->username = $username;
            $this->projectWeek = $projectWeek;

            $this->load();
        }

        /**
         * Load EventRegistrations from database
         */
        private function load() {
            $where = 'username = "'.$this->username.'" AND year = '.$this->projectWeek->getYear().' AND week = '.$this->projectWeek->getWeek();

            $result = $this->databaseHandler->select(self::TABLE, $where);

            foreach($result as $eventRegistration) {
                $this->add(new EventRegistration($eventRegistration['eventRegistrationId']));
            }
        }

        /**
         * Add event-registration to local array
         * @param $eventRegistration
         */
        public function add($eventRegistration) {
            array_push($this->eventRegistrations, $eventRegistration);
        }

        /**
         * Get all event-registrations
         * @return array
         */
        public function getEventRegistrations() {
            return $this->eventRegistrations;
        }

        /**
         * Get all event-registrations as representation objects
         * @return array
         */
        public function getEventRepresentations() {

            $eventRepresentations = [];
            $colors = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

            foreach($this->eventRegistrations as $eventRegistration) {
                $length = $eventRegistration->getProjectWeekEntry()->getEvent()->length;
                $position = $eventRegistration->getProjectWeekEntry()->getPosition();

                for($i = $position; $i < ($position + $length); $i++) {
                    array_push($eventRepresentations, new EventRegistrationRepresentation($eventRegistration, $i, $colors[$position-1]));
                }
            }

            return $eventRepresentations;
        }
    }

?>