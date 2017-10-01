<?php

    // Includes
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/user.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeek.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeekEntry.php';

    class MyEventsController {
        
        private $user;
        private $projectWeek;

        function __construct($POST_ARRAY) {
            $this->parsePostArray($POST_ARRAY);
        }

        private function parsePostArray($POST_ARRAY) {
            
            // ProjectWeek
            $year = NULL;
            $week = NULL;
            
            if(
                isset($_POST['year'])
                && isset($_POST['week'])
            ) {
                $year = $_POST['year'];
                $week = $_POST['week'];
            } else {
                $year = ProjectWeek::getCurrentCalendarYear();
                $week = ProjectWeek::getCurrentCalendarWeek();
            }

            $this->createProjectWeek($year, $week);

            // TODO: User wird noch statisch gesetzt.
            // User
            $this->createUser('test');
        }

        private function createProjectWeek($year, $calendarWeek) {
            $this->projectWeek = new ProjectWeek($year, $calendarWeek);
        }

        private function createUser($username) {
            $this->user = new User($username);
        }

        public function getWeekStartDate() {
            return $this->projectWeek->getFromDate();
        }

        public function getWeekEndDate() {
            return $this->projectWeek->getUntilDate();
        }

        public function getYear() {
            return $this->projectWeek->getYear();
        }

        public function getWeek() {
            return $this->projectWeek->getWeek();
        }

        public function getWeekEntries() {
            return $this->projectWeek->getProjectWeekEntries();
        }
    }

    // Controller-Creation
    $myEventsController = new MyEventsController($_POST);

?>