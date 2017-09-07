<?php

    include $_SERVER['DOCUMENT_ROOT'].'/vstp/class/event.php';

    class PersonnalManager {

        private $name;
        private $email;

        function __construct($name, $email) {
            $this->name = $name;
            $this->email = $email;    
        }

        function createEvent() {
            $event = new Event();

            $event->name = 'Test10';
            $event->description = 'Test10';
            $event->date = '2017-09-10 00:00:00';
            $event->length = '3';
            $event->currentParticipants = '0';
            $event->maxParticipants = '100';
            $event->eventManager = $this->name;

            $event->save();
        }
    }

    $test = new PersonnalManager('Chef', 'chef@boss.de');
    $test->createEvent();


?>