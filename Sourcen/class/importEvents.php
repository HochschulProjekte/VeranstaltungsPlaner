<?php

include_once __DIR__ . '/../class/import.php';
include_once __DIR__ . '/../class/event.php';

/**
 * Class ImportEvents
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class ImportEvents extends Import {

    /**
     * ImportEvents constructor.
     * @param null $file
     */
    function __construct($file = null) {
        if ($file != null) {
            $this->setFile($file);
            $this->readFile($file);
            $this->storeEvents();
        }
    }

    /**
     * Save imported events
     */
    public function storeEvents() {

        foreach ($this->getValues() as $row) {
            $this->createEvent($row['Name']
                , $row['Beschreibung']
                , $row['Laenge']
                , $row['Max. Teilnehmer']
                , $row['Verantwortlicher']);
        }

    }

    /**
     * Create an event
     * @param $name
     * @param $description
     * @param $length
     * @param $maxParticipants
     * @param $eventManager
     * @return bool
     */
    private function createEvent($name
        , $description
        , $length
        , $maxParticipants
        , $eventManager) {
        $event = new Event();

        $event->setName($name);
        $event->setDescription($description);
        $event->setLength($length);
        $event->setMaxParticipants($maxParticipants);
        $event->setPersonnalManager($eventManager);

        return $event->save();
    }
}

?>