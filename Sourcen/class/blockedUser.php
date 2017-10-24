<?php

    class BlockedUser {

        private $username;
        private $count;

        public function __construct($username, $count) {
            $this->username = $username;
            $this->count = $count;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getCount() {
            return $this->count;
        }

        public function decreaseCount() {
            $this->count--;
        }

    }

?>