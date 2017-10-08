<?php

    // Includes
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/user.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeek.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeekEntry.php';

    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/eventRegistration.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/eventRegistrationCollection.php';

    class MyEventsController {
        
        private $user;
        private $projectWeek;
        private $eventRegistrationCollection;

        /**
         * MyEventsController constructor.
         * @param $POST_ARRAY
         */
        function __construct($POST_ARRAY) {
            $this->parsePostArray($POST_ARRAY);
        }

        /**
         * Parse POST input
         * @param $POST_ARRAY
         */
        private function parsePostArray($POST_ARRAY) {
            
            // ProjectWeek
            $year = NULL;
            $week = NULL;
            
            if(
                isset($POST_ARRAY['year'])
                && isset($POST_ARRAY['week'])
            ) {
                $year = $POST_ARRAY['year'];
                $week = $POST_ARRAY['week'];
            } else {
                $year = ProjectWeek::getCurrentCalendarYear();
                $week = ProjectWeek::getCurrentCalendarWeek();
            }

            // set project week
            $this->createProjectWeek($year, $week);

            // set user
            $this->createUserObject($_SESSION['username']);

            // ProjectWeekEntry - User registration
            if(
                isset($POST_ARRAY['registration'])
                && isset($POST_ARRAY['projectWeekEntryId'])
                && isset($POST_ARRAY['priority'])
            ) {
                $this->registerToEvent($POST_ARRAY['projectWeekEntryId'], $POST_ARRAY['priority']);
            }

            // Alle Anmeldungen zu Events eines Nutzers laden
            $this->createEventRegistrationCollection();
        }

        /**
         * Create a projectweek object
         * @param $year
         * @param $calendarWeek
         */
        private function createProjectWeek($year, $calendarWeek) {
            $this->projectWeek = new ProjectWeek($year, $calendarWeek);
        }

        /**
         * Create an user object
         * @param $username
         */
        private function createUserObject($username) {
            $this->user = new User($username);
        }

        /**
         * Register an user to a specific projectweek entry
         * @param $projectWeekEntryId
         * @param $priority
         */
        private function registerToEvent($projectWeekEntryId, $priority) {

            $eventRegistration = new EventRegistration(NULL);

            $eventRegistration->setUsername($this->user->getName());
            $eventRegistration->setProjectWeekEntry(new ProjectWeekEntry($projectWeekEntryId));
            $eventRegistration->setPriority($priority);
            $eventRegistration->setApproved('0');
            $eventRegistration->setRegistrationDate(date('Y-m-d H:i:s'));

            $eventRegistration->save();
        }

        /**
         * Create a collection of EventRegistrations for a specific user and projectweek combination
         */
        private function createEventRegistrationCollection() {
            $this->eventRegistrationCollection = new EventRegistrationCollection(
                $this->user->getName(),
                $this->projectWeek
            );
        }

        /***********************************************************************************/
        /*   Getter functions                                                              */
        /***********************************************************************************/

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

        public function getEventRegistrationCollection()
        {
            return $this->eventRegistrationCollection;
        }
    }

    // Create Controller
    $myEventsController = new MyEventsController($_POST);

?>