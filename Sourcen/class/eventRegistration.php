<?php

    include_once __DIR__.'/../database/databasehandler.php';
    include_once __DIR__.'/../class/projectWeekEntry.php';

    class EventRegistration {
        
        const TABLE = 'EventRegistration';
        
        private $databaseHandler;

        private $id;
        private $username;
        private $projectWeekEntry;
        private $year;
        private $week;
        private $priority;
        private $approved;
        private $registrationDate;

        function __construct($id = NULL) {

            $this->databaseHandler = new PDOHandler();

            if($id != NULL) {
                $this->load($id);
            }
        }
        
        private function load($id) {
            $where = 'eventRegistrationId = '.$id;

            $result = $this->databaseHandler->select(self::TABLE, $where);

            $this->id = $result[0]['eventRegistrationId'];
            $this->username = $result[0]['username'];
            $this->projectWeekEntry = new ProjectWeekEntry($result[0]['projectWeekEntryId']);
            $this->year = $result[0]['year'];
            $this->week = $result[0]['week'];
            $this->priority = $result[0]['priority'];
            $this->approved = $result[0]['approved'];
            $this->registrationDate = $result[0]['registrationDate'];
        }

        public function save() {

            $values = [
                new ColumnItem('username', $this->username),
                new ColumnItem('projectWeekEntryId', $this->projectWeekEntry->getProjectWeekEntryId()),
                new ColumnItem('year', $this->projectWeekEntry->getYear()),
                new ColumnItem('week', $this->projectWeekEntry->getWeek()),
                new ColumnItem('priority', $this->priority),
                new ColumnItem('approved', $this->approved),
                new ColumnItem('registrationDate', $this->registrationDate)
            ];

            if($this->id != NULL) {
                $where = 'eventRegistrationId = '.$this->id;
                $this->databaseHandler->update(self::TABLE, $values, $where);
            } else {
                $this->databaseHandler->insert(self::TABLE, $values);
            }
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return mixed
         */
        public function getUsername()
        {
            return $this->username;
        }

        /**
         * @param mixed $username
         */
        public function setUsername($username)
        {
            $this->username = $username;
        }

        /**
         * @return mixed
         */
        public function getProjectWeekEntry()
        {
            return $this->projectWeekEntry;
        }

        /**
         * @param mixed $projectWeekEntry
         */
        public function setProjectWeekEntry($projectWeekEntry)
        {
            $this->projectWeekEntry = $projectWeekEntry;
        }

        /**
         * @return mixed
         */
        public function getPriority()
        {
            return $this->priority;
        }

        /**
         * @param mixed $priority
         */
        public function setPriority($priority)
        {
            $this->priority = $priority;
        }

        /**
         * @return mixed
         */
        public function getApproved()
        {
            return $this->approved;
        }

        /**
         * @param mixed $approved
         */
        public function setApproved($approved)
        {
            $this->approved = $approved;
        }

        /**
         * @return mixed
         */
        public function getRegistrationDate()
        {
            return $this->registrationDate;
        }

        /**
         * @param mixed $registrationDate
         */
        public function setRegistrationDate($registrationDate)
        {
            $this->registrationDate = $registrationDate;
        }

    }

?>