<?php

include_once __DIR__ . '/../database/pdoDatabaseController.php';
include_once __DIR__ . '/../class/projectWeek.php';
include_once __DIR__ . '/../class/eventRegistration.php';
include_once __DIR__ . '/../class/eventRegistrationRepresentation.php';

/**
 * Class EventRegistrationCollection
 *
 * Eine Sammlung von Veranstaltungsregistrierungen eines Mitarbeiters.
 *
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

        $this->databaseHandler = new PDODatabaseController();

        $this->username = $username;
        $this->projectWeek = $projectWeek;

        $this->load();
    }

    /**
     * Alle Registrierungen eines Mitarbeiters laden.
     */
    private function load() {
        $where = 'username = "' . $this->username . '" AND year = ' . $this->projectWeek->getYear() . ' AND week = ' . $this->projectWeek->getWeek();

        $result = $this->databaseHandler->select(self::TABLE, $where);

        foreach ($result as $eventRegistration) {
            $this->add(new EventRegistration($eventRegistration['eventRegistrationId']));
        }
    }

    /**
     * Eines Registierung zu dem aktuellen Array hinzufuegen.
     * @param EventRegistration $eventRegistration
     */
    public function add($eventRegistration) {
        array_push($this->eventRegistrations, $eventRegistration);
    }

    /**
     * Liefert alle Veranstaltungs-Registrierungen.
     * @return array EventRegistration
     */
    public function getEventRegistrations() {
        return $this->eventRegistrations;
    }

    /**
     * Liefert alle Registierungen als Repraesentations-Objekte, fuer die Darstellung des Kalenders, zurueck.
     * @return array EventRepresentation
     */
    public function getEventRepresentations() {

        $eventRepresentations = [];
        $colors = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

        foreach ($this->eventRegistrations as $eventRegistration) {
            $length = $eventRegistration->getProjectWeekEntry()->getEvent()->getLength();
            $position = $eventRegistration->getProjectWeekEntry()->getPosition();

            for ($i = $position; $i < ($position + $length); $i++) {
                array_push($eventRepresentations, new EventRegistrationRepresentation($eventRegistration, $i, $colors[$position - 1]));
            }
        }

        return $eventRepresentations;
    }
}

?>