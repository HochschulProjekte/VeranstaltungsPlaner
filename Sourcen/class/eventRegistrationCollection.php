<?php

include_once __DIR__ . '/../database/databaseHandler.php';
include_once __DIR__.'/../class/projectWeek.php';
include_once __DIR__.'/../class/eventRegistration.php';
include_once __DIR__.'/../class/eventRegistrationRepresentation.php';

class EventRegistrationCollection {

    const TABLE = 'EventRegistration';

    private $databaseHandler;

    private $username;
    private $projectWeek;
    private $eventRegistrations = [];

    public function __construct($username, $projectWeek) {

        $this->databaseHandler = new PDOHandler();

        $this->username = $username;
        $this->projectWeek = $projectWeek;

        $this->load();
    }

    private function load() {
        $where = 'username = "'.$this->username.'" AND year = '.$this->projectWeek->getYear().' AND week = '.$this->projectWeek->getWeek();

        $result = $this->databaseHandler->select(self::TABLE, $where);

        foreach($result as $eventRegistration) {
            $this->add(new EventRegistration($eventRegistration['eventRegistrationId']));
        }
    }

    public function add($eventRegistration) {
        array_push($this->eventRegistrations, $eventRegistration);
    }

    public function getEventRegistrations() {
        return $this->eventRegistrations;
    }

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