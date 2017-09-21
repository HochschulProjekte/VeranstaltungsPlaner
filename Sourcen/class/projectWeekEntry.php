<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/event.php';

    class ProjectWeekEntry {

        const TABLE = 'ProjectWeekEntry';

        private $year;
        private $week;
        private $eventId;
        private $position;
        private $participants;
        private $maxParticipants;

        private $event;

        function __construct($year, $week, 
                             $eventId, $position,
                             $participants, $maxParticipants) {

            $this->databaseHandler = new PDOHandler();                    
            $this->year = $year;
            $this->week = $week;
            $this->eventId = $eventId;
            $this->position = $position;
            $this->participants = $participants;
            $this->maxParticipants = $maxParticipants;

            $this->loadEvent();
        }

        private function loadEvent() {
            $this->event = new Event($this->eventId);
        }

        public function save() {

            $values = [
                new ColumnItem('eventId', $this->eventId),
                new ColumnItem('year', $this->year),
                new ColumnItem('week', $this->week),
                new ColumnItem('position', $this->position),
                new ColumnItem('participants', $this->participants),
                new ColumnItem('maxParticipants', $this->maxParticipants)
            ];

            $where = 'eventId = '.$this->eventId.' AND year = '.$this->year.' AND week = '.$this->week.' AND position = '.$this->position;

            $exists = $this->databaseHandler->select(self::TABLE, $where);

            if(count($exists) > 0) {
                $this->databaseHandler->update(self::TABLE, $values, $where);
            } else {
                $this->databaseHandler->insert(self::TABLE, $values);
            }
        }

        public function delete() {
            $where = 'eventId = '.$this->eventId.' AND year = '.$this->year.' AND week = '.$this->week.' AND position = '.$this->position;
            $this->databaseHandler->delete(self::TABLE, $where);
        }

        public function getYear() {
            return $this->year;
        }

        public function getWeek() {
            return $this->week;
        }

        public function getEventId() {
            return $this->eventId;
        }

        public function getPosition() {
            return $this->position;
        }

        public function getParticipants() {
            return $this->participants;
        }

        public function getMaxParticipants() {
            return $this->maxParticipants;
        }

        public function getEvent() {
            return $this->event;
        }
    }

?>