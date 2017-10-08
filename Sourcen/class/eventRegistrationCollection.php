<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/database/databasehandler.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeek.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/eventRegistration.php';

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

}

?>