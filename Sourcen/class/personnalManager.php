<?php

    include_once __DIR__.'/../class/event.php';

    /**
     * Class PersonnalManager
     * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
     */
    class PersonnalManager {

        private $name;
        private $email;

        /**
         * PersonnalManager constructor.
         * @param $name
         * @param $email
         */
        function __construct($name, $email) {
            $this->name = $name;
            $this->email = $email;    
        }

        /**
         * Erstellen eines neuen Veranstaltung
         * @param $name
         * @param $description
         * @param $length
         * @param $maxParticipants
         * @param $eventManager
         * @return bool
         */
        function createEvent(   $name, $description,
                                $length, $maxParticipants,
                                $eventManager) {
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