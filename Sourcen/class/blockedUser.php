<?php

    /**
     * Class BlockedUser
     * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
     */
    class BlockedUser {

        private $username;
        private $count;

        /**
         * BlockedUser constructor.
         * @param string $username
         * @param int $count
         */
        public function __construct($username, $count) {
            $this->username = $username;
            $this->count = $count;
        }

        /**
         * @return string Username
         */
        public function getUsername() {
            return $this->username;
        }

        /**
         * @return int count
         */
        public function getCount() {
            return $this->count;
        }

        /**
         * Anzahl der gesperrten Positionen um eine Position verringern.
         */
        public function decreaseCount() {
            $this->count--;
        }

    }

?>