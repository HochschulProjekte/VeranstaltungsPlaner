<?php

include_once __DIR__ . '/../database/databaseHandler.php';
include_once __DIR__.'/../class/user.php';

    class LoginHandler {

        // Table for database statements
        const TABLE = 'User';

        // Object variable for database handling
        private $databaseHandler;

        /**
         * LoginHandler constructor.
         */
        function __construct() {

            // Set database
            $this->databaseHandler = new PDOHandler();

        }

        /**
         * @param $username
         * @param $password
         * @return array
         */
        public function login($username, $password) {
            $ret = array();
            $ret['err'] = false;
            $ret['type'] = 'info';
            $ret['msg'] = '';

            // Password and Username filled?
            if ($this->checkEmptyUsernamePassword($username, $password) == true) {
                $ret['err'] = true;
                $ret['type'] = 'info';
                $ret['msg'] = 'Bitte geben Sie ihren Benutzernamen und ihr Passwort ein.';
                return $ret;
            }

            // Does the user exist?
            if ($this->checkUserExists($username) == false) {
                $ret['err'] = true;
                $ret['type'] = 'danger';
                $ret['msg'] = 'Der angegebene Benutzer existiert nicht.';
                return $ret;
            }

            // Password correct?
            if ($this->checkPasswordCorrect($username, $password) == false) {
                $ret['err'] = true;
                $ret['type'] = 'danger';
                $ret['msg'] = 'Das angegebene Passwort ist nicht korrekt.';
                return $ret;
            }

            // Start session and set session variable
            $this->setSession($username);

            // Redirect user to index.php
            $this->redirect('index.php');

            return $ret;
        }

        /**
         * Logout function
         */
        public function logout() {
            $this->deleteSession();
        }

        /**
         * Redirect user to a page
         * @param $page
         */
        public function redirect($page) {
            header('Location: ./' . $page);
            exit();
        }

        /**
         * Check, if user is logged in
         * @return bool
         */
        public function isUserLoggedIn() {

            $this->restartSession();

            if ($this->checkLogin() == false) {
                return false;
            } else {
                return true;
            }
        }

        /*
         * Set user variable
         */
        public function getMyUser() {
            return new User($_SESSION['username']);
        }

        /**
         * Check, if user exists in database
         * @param $username
         * @return bool
         */
        private function checkUserExists($username) {

            $result = $this->databaseHandler->select(self::TABLE, 'name = "' . $username . '"');

            if (    empty($result)
                ||  !isset($result)
                ||  $result == false
                ||  $result == 0) {
                return false;
            } else {
                return true;
            }

        }

        /**
         * Check, if apssword is correct
         * @param $username
         * @param $password
         * @return bool
         */
        private function checkPasswordCorrect($username, $password) {

            $result = $this->databaseHandler->select(self::TABLE, 'name = "'. $username . '"');

            if ($password == $result[0]['password']) {
                return true;
            } else {
                return false;
            }

        }

        /**
         * Check, if username or password is empty
         * @param $username
         * @param $password
         * @return bool
         */
        private function checkEmptyUsernamePassword($username, $password) {
            if (    empty($username)
                ||  empty($password)) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Check, if user is logged in session
         * @return bool
         */
        private function checkLogin() {
            if (    isset($_SESSION['login'])){
                if (    $_SESSION['login'] == true) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        /**
         * Start session and set session variable
         * @param $username
         */
        private function setSession($username) {

            session_start();

            $_SESSION = array(
                'login'     => true,
                'username'  => $username
            );

        }

        /**
         * Restart the users session
         */
        private function restartSession() {
            session_start();
            session_regenerate_id();
        }

        /**
         * Empty and destroy session
         */
        private function deleteSession() {
            session_start();

            $_SESSION = array();

            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
            }

            session_destroy();
        }
    }

?>