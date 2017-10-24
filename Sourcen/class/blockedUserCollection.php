<?php

    include_once __DIR__.'/../class/blockedUser.php';

    /**
     * Class BlockedUserCollection
     */
    class BlockedUserCollection {

        private $blockedUsers = [];

        /**
         * BlockedUserCollection constructor.
         */
        public function __construct() {

        }

        /**
         * @param $blockedUser
         */
        public function add($blockedUser) {
            array_push($this->blockedUsers, $blockedUser);
        }

        /**
         * @param $username
         * @return bool
         */
        public function exists($username) {
            foreach($this->blockedUsers as $blockedUser) {
                if($blockedUser->getUsername() == $username) {
                    return true;
                }
            }

            return false;
        }

        /**
         *
         */
        public function decreaseCount() {
            foreach($this->blockedUsers as $blockedUser) {
                $blockedUser->decreaseCount();

                if($blockedUser->getCount() == 0) {
                    $this->blockedUsers = $this->unsetValue($this->blockedUsers, $blockedUser);
                }
            }
        }

        /**
         * @param array $array
         * @param $value
         * @param bool $strict
         * @return array
         */
        private function unsetValue(array $array, $value, $strict = TRUE) {
            if(($key = array_search($value, $array, $strict)) !== FALSE) {
                unset($array[$key]);
            }

            $newArray = [];

            foreach($array as $entry) {
                array_push($newArray, $entry);
            }

            return $newArray;
        }
    }

?>