<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/import.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/event.php';

class ImportEvents extends Import {

    function __construct($file = null) {
        if ($file != null) {
            $this->setFile($file);
            $this->readFile($file);
            $this->storeEvents();
        }
    }

    public function storeEvents() {

        foreach ($this->getValues() as $row) {
            $this->createEvent( $row['Name']
                            ,   $row['Beschreibung']
                            ,   $row['Laenge']
                            ,   $row['Max. Teilnehmer']
                            ,   $row['Verantwortlicher']);
        }

    }

    private function createEvent(   $name
                                ,   $description
                                ,   $length
                                ,   $maxParticipants
                                ,   $eventManager) {
        $event = new Event();

        $event->name = $name;
        $event->description = $description;
        $event->length = $length;
        $event->maxParticipants = $maxParticipants;
        $event->eventManager = $eventManager;
        
        return $event->save();
    }



}

?>