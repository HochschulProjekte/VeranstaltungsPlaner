<?php

include_once __DIR__ . '/../database/pdoDatabaseController.php';
include_once __DIR__ . '/../class/user.php';

/**
 * Class LoginHandler
 *
 * Diese Klasse uebernimmt das Session-Handling und den entsprechenden Login eines Benutzers.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class LoginHandler {

    const TABLE = 'User';
    private $databaseHandler;

    /**
     * LoginHandler constructor.
     */
    function __construct() {

        // Set database
        $this->databaseHandler = new PDODatabaseController();

    }

    /**
     * @param string $username
     * @param string $password
     * @return array
     */
    public function login($username, $password) {
        $ret = array();
        $ret['err'] = false;
        $ret['type'] = 'info';
        $ret['msg'] = '';

        // Wurde der Benutzername und das Passwort uebertragen?
        if ($this->checkEmptyUsernamePassword($username, $password) == true) {
            $ret['err'] = true;
            $ret['type'] = 'info';
            $ret['msg'] = 'Bitte geben Sie ihren Benutzernamen und ihr Passwort ein.';
            return $ret;
        }

        // Ist der Benutzer vorhanden?
        if ($this->checkUserExists($username) == false) {
            $ret['err'] = true;
            $ret['type'] = 'danger';
            $ret['msg'] = 'Der angegebene Benutzer existiert nicht.';
            return $ret;
        }

        // Ist das Passwort korrekt?
        if ($this->checkPasswordCorrect($username, $password) == false) {
            $ret['err'] = true;
            $ret['type'] = 'danger';
            $ret['msg'] = 'Das angegebene Passwort ist nicht korrekt.';
            return $ret;
        }

        // Start session and set session variable
        $this->setSession($username);

        // Weiterleiten zur index.php
        $this->redirect('index.php');

        return $ret;
    }

    /**
     * Ueberprueft ob der eingebene Benutzername oder das Passwort leer ist.
     * @param string $username
     * @param string $password
     * @return bool
     */
    private function checkEmptyUsernamePassword($username, $password) {
        if (empty($username)
            || empty($password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Ueberprueft ob ein eingebene Benutzer in der Datenbank exisitiert.
     * @param string $username
     * @return bool
     */
    private function checkUserExists($username) {

        $result = $this->databaseHandler->select(self::TABLE, 'name = "' . $username . '"');

        if (empty($result)
            || !isset($result)
            || $result == false
            || $result == 0) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * Ueberprueft ob das eingebene Passwort richtig ist.
     * @param string $username
     * @param string $password
     * @return bool
     */
    private function checkPasswordCorrect($username, $password) {

        $result = $this->databaseHandler->select(self::TABLE, 'name = "' . $username . '"');

        if ($password == $result[0]['password']) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Starten der Session und setzen der Session-Variable.
     * @param $username
     */
    private function setSession($username) {

        session_start();

        $_SESSION = array(
            'login' => true,
            'username' => $username
        );

    }

    /**
     * Weiterleiten zur Seite X.
     * @param string $page
     */
    public function redirect($page) {
        header('Location: ./' . $page);
        exit();
    }

    /**
     * Logout
     */
    public function logout() {
        $this->deleteSession();
    }

    /**
     * Leeren und loeschen der Session.
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

    /**
     * Ueberprueung ob eine Benutzer eingeloggt.
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

    /**
     * Wiederherstellung einer Session.
     */
    private function restartSession() {
        session_start();
        session_regenerate_id();
    }

    /**
     * Ueberpruefung ob ein Benutzer bereits eingeloggt ist.
     * @return bool
     */
    private function checkLogin() {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Liefert ein User-Objekt des aktuelle eingeloggten Benutzers.
     * @return User
     */
    public function getMyUser() {
        return new User($_SESSION['username']);
    }
}

?>