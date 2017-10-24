<?php

    /**
     * Class ChangePhaseMessage
     */
    class ChangePhaseMessage {

        private $status;
        private $newPhase;
        private $position;
        private $missingUsers;

        /**
         * ChangePhaseMessage constructor.
         * @param boolean $status
         * @param int $newPhase
         * @param int $position
         * @param int $missingUsers
         */
        public function __construct($status, $newPhase, $position = 0, $missingUsers = 0){
            $this->status = $status;
            $this->newPhase = $newPhase;
            $this->position = $position;
            $this->missingUsers = $missingUsers;
        }

        /**
         * @return boolean status
         */
        public function getStatus() {
            return $this->status;
        }

        /**
         * @return int new phase
         */
        public function getNewPhase() {
            return $this->newPhase;
        }

        /**
         * @return int position
         */
        public function getPosition() {
            return $this->position;
        }

        /**
         * @return int missing user count
         */
        public function getMissingUsers() {
            return $this->missingUsers;
        }
    }

?>