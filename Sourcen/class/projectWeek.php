<?php

    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/database/databasehandler.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/event.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeekEntry.php';

    class ProjectWeek {
        
        const TABLE = 'ProjectWeek';

        private $databaseHandler;

        private $year;
        private $week;

        private $from;
        private $until;

        private $allEvents = [];
        private $entries = [];

        function __construct($year = NULL, $week = NULL) {
            $this->databaseHandler = new PDOHandler();
            
            if($year == NULL && $week == NULL) {
                $this->year = $this->getCurrentCalendarYear();
                $this->week = $this->getCurrentCalendarWeek();
                $this->from = $this->getCurrentStartDate();
                $this->until = $this->getCurrentEndDate();

                $this->createWeek();
            } else {
                $this->load($year, $week);
            }

            $this->loadMyEvents();
        }

        private function createWeek() {

            $values = [
                new ColumnItem('year', $this->year),
                new ColumnItem('week', $this->week),
                new ColumnItem('from', $this->from),
                new ColumnItem('until', $this->until)
            ];

            $result = $this->databaseHandler->insert(self::TABLE, $values);
        }

        private function load($year, $week) {
            $result = $this->databaseHandler->select(self::TABLE, 'year = '.$year.' AND week = '.$week);

            if(count($result == 0)) {
                $this->year = $year;
                $this->week = $week;

                $this->from = date('Y-m-d', strtotime($year.'W'.$week));
                $this->until = date( 'Y-m-d', strtotime($year.'W'.$week.' +4 days') );

                $this->createWeek();
                return;
            }

            $this->year = $result[0]['year'];
            $this->week = $result[0]['week'];
            $this->from = $result[0]['from'];
            $this->until = $result[0]['until'];
        }

        public function loadAllEvents() {
            $result = $this->databaseHandler->select('Event', null);
            $this->allEvents = [];

            foreach ($result as $row) {
                array_push($this->allEvents, new Event($row['eventId']));
            }

            return $this->allEvents;
        }

        private function loadMyEvents() {
            $result = $this->databaseHandler->select('ProjectWeekEntry', 'year = '.$this->year.' AND week = '.$this->week);
            
            $this->entries = [];

            foreach ($result as $entry) {
                array_push($this->entries, 
                    new ProjectWeekEntry($entry['year'], $entry['week'], 
                                            $entry['eventId'], $entry['position'],
                                            $entry['participants'], $entry['maxParticipants']));
            }

            return $this->entries;
        }

        public function getCurrentCalendarWeek() {
            $calendarWeek = 0;
            $calendarWeek = date('W', time());
            return $calendarWeek;
        }

        public function getCurrentCalendarYear() {
            $year = 0;
            $year = date('Y');
            return $year;
        }

        public function getCurrentStartDate() {
            return date("Y-m-d", strtotime('monday this week'));
        }

        public function getCurrentEndDate() {
            return date("Y-m-d", strtotime('friday this week'));
        }

        public function getProjectWeekEntries() {
            return $this->entries;
        }

        public function getYear() {
            return $this->year;
        }
        
        public function getWeek() {
            return $this->week;
        }

        public function getFromDate() {
            return $this->from;
        }

        public function getUntilDate() {
            return $this->until;
        }
    }
?>