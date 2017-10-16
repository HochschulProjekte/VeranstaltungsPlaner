<?php
    include_once __DIR__.'/../class/personnalManager.php';
    include_once __DIR__.'/../class/projectWeek.php';

    class EventsController {

        private $personnalManager;

        private $status = 'NONE';
        private $events;
        private $event;

        public function __construct($POST_ARRAY, $personnalManager) {

            $this->personnalManager = new PersonnalManager($personnalManager->getName(), $personnalManager->getEmail());
            $this->event = new Event();
            $this->parsePostArray($POST_ARRAY);
            $this->loadAllEvents();
        }

        private function parsePostArray($POST_ARRAY) {
            // Neues Event anlegen / Vorhandenes Event bearbeiten
            if(
                isset($POST_ARRAY['myevent-name']) &&
                isset($POST_ARRAY['myevent-description']) &&
                isset($POST_ARRAY['myevent-length']) &&
                isset($POST_ARRAY['myevent-maxParticipants']) &&
                isset($POST_ARRAY['myevent-eventManager'])
            ) {

                $name = $POST_ARRAY['myevent-name'];
                $description = $POST_ARRAY['myevent-description'];
                $length = $POST_ARRAY['myevent-length'];
                $maxParticipants = $POST_ARRAY['myevent-maxParticipants'];
                $personnalManager = $POST_ARRAY['myevent-eventManager'];

                if(isset($POST_ARRAY['myevent-id'])) {
                    // Event bearbeiten
                    $id = $POST_ARRAY['myevent-id'];

                    $this->saveEvent($id, $name, $description, $length, $maxParticipants, $personnalManager);
                } else {
                    // Event erstellen
                    $this->createEvent($name, $description, $length, $maxParticipants, $personnalManager);
                }
            }

            // Bearbeitung vorbereiten
            if(
                isset($POST_ARRAY['edit']) &&
                isset($POST_ARRAY['id'])
            ) {
                $this->prepareEdit($POST_ARRAY['id']);
            }

            // Event löschen
            if(
                isset($POST_ARRAY['delete']) &&
                isset($POST_ARRAY['id'])
            ) {
                $this->deleteEvent($POST_ARRAY['id']);
            }
        }

        private function prepareEdit($id) {
            $this->event = new Event($id);
        }

        private function createEvent($name, $description, $length, $maxParticipants, $personnalManager) {
            $user = new PersonnalManager('Chef', 'chef@boss.de');

            if($user->createEvent(  $name, $description, $length, $maxParticipants, $personnalManager)) {
                $this->status = 'SUCCESS';
            } else {
                $this->status = 'ERROR';
            }
        }

        private function saveEvent($id, $name, $description, $length, $maxParticipants, $personnalManager) {
            $event = new Event($id);
            $event->name = $name;
            $event->description = $description;
            $event->length = $length;
            $event->maxParticipants = $maxParticipants;
            $event->eventManager = $personnalManager;

            if($event->save()) {
                $this->status = 'SUCCESS';
            } else {
                $this->status = 'ERROR';
            }
        }

        private function deleteEvent($id) {
            $event = new Event($id);
            $event->delete();
        }

        private function loadAllEvents() {
            $projectWeek = new ProjectWeek();
            $this->events = $projectWeek->loadAllEvents();
        }

        /**
         * @return string
         */
        public function getStatus() {
            return $this->status;
        }

        /**
         * @return mixed
         */
        public function getEvents() {
            return $this->events;
        }

        /**
         * @return mixed
         */
        public function getEvent() {
            return $this->event;
        }
    }

?>