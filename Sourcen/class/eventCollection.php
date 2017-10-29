<?php

include_once __DIR__ . '/../class/event.php';
include_once __DIR__ . '/../database/pdoDatabaseController.php';

/**
 * Class EventCollection
 *
 * Sammlung von Veranstaltungen.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class EventCollection {

    private $events = [];
    private $databaseHandler;

    /**
     * EventCollection constructor.
     */
    public function __construct() {
        $this->databaseHandler = new PDODatabaseController();
    }

    /**
     * Laedt alle moeglichen Veranstaltungen.
     */
    public function addAllEvents() {
        $result = $this->databaseHandler->select('Event', null);

        foreach ($result as $row) {
            $this->add(new Event($row['eventId']));
        }
    }

    /**
     * Fuegt der Liste eine Veranstaltung hinzu.
     * @param Event $event
     */
    public function add($event) {
        array_push($this->events, $event);
    }

    /**
     * Liefert alle vorhandenen Events.
     * @return array Events
     */
    public function getEvents() {
        return $this->events;
    }
}

?>