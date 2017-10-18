<?php

    include_once __DIR__.'/../class/event.php';

    class ProjectWeekEntry {

        const TABLE = 'ProjectWeekEntry';

        private $projectWeekEntryId;
        private $year;
        private $week;
        private $eventId;
        private $position;
        private $participants;
        private $maxParticipants;

        private $event;

        function __construct($projectWeekEntryId) {

            $this->databaseHandler = new PDOHandler();  
            $this->projectWeekEntryId = $projectWeekEntryId;
            
            if($projectWeekEntryId != NULL) {
                $this->loadData();
                $this->loadEvent();
            }
        }

        private function loadData() {
            $where = 'projectWeekEntryId = '.$this->projectWeekEntryId;
            $result = $this->databaseHandler->select(self::TABLE, $where);

            $this->year = $result[0]['year'];
            $this->week = $result[0]['week'];
            $this->eventId = $result[0]['eventId'];
            $this->position = $result[0]['position'];
            $this->participants = $result[0]['participants'];
            $this->maxParticipants = $result[0]['maxParticipants'];
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

            if($this->projectWeekEntryId != NULL) {

                $where = 'projectWeekEntryId = '.$this->projectWeekEntryId;                
                $this->databaseHandler->update(self::TABLE, $values, $where);
            } else {
                $this->databaseHandler->insert(self::TABLE, $values);
            }
        }

        public function delete() {
            $where = 'projectWeekEntryId = '.$this->projectWeekEntryId;
            $this->databaseHandler->delete(self::TABLE, $where);
        }

        public function getId() {
            return $this->projectWeekEntryId;
        }

        public function getYear() {
            return $this->year;
        }

        public function setYear($year) {
            $this->year = $year;
        }

        public function getWeek() {
            return $this->week;
        }

        public function setWeek($week) {
            $this->week = $week;
        }

        public function getEventId() {
            return $this->eventId;
        }

        public function setEventId($eventId) {
            $this->eventId = $eventId;
        }

        public function getPosition() {
            return $this->position;
        }

        public function setPosition($position) {
            $this->position = $position;
        }

        public function getParticipants() {
            return $this->participants;
        }

        public function setParticipants($participants) {
            $this->participants = $participants;
        }

        public function getMaxParticipants() {
            return $this->maxParticipants;
        }

        public function setMaxParticipants($maxParticipants) {
            $this->maxParticipants = $maxParticipants;
        }

        public function getEvent() {
            return $this->event;
        }
    }

?>