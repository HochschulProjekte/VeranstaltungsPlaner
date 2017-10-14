<?php

    class ChangePhaseMessage {

        private $status;
        private $position;
        private $missingUsers;

        public function __construct($status, $position = 0, $missingUsers = 0){
            $this->status = $status;
            $this->position = $position;
            $this->missingUsers = $missingUsers;
        }

        /**
         * @return mixed
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * @return mixed
         */
        public function getPosition()
        {
            return $this->position;
        }

        /**
         * @return mixed
         */
        public function getMissingUsers()
        {
            return $this->missingUsers;
        }
    }

?>