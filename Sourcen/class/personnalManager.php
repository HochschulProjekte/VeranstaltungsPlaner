<?php

    include $_SERVER['DOCUMENT_ROOT'].'/vstp/class/event.php';

    class PersonnalManager {

        private $name;
        private $email;

        function __construct($name, $email) {
            $this->name = $name;
            $this->email = $email;    
        }

        function createEvent(   $name, $description,
                                $date, $length, 
                                $currentParticipants, $maxParticipants,
                                $eventManager) {
            $event = new Event();

            $event->name = $name;
            $event->description = $description;
            $event->date = $date;
            $event->length = $length;
            $event->currentParticipants = $currentParticipants;
            $event->maxParticipants = $maxParticipants;
            $event->eventManager = $eventManager;

            return $event->save();
        }
    }

?>