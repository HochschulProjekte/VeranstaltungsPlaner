<?php

include_once __DIR__ . '/../controller/controllerInterface.php';
include_once __DIR__ . '/../class/loginHandler.php';

/**
 * Class LoginController
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class LoginController implements Controller {

    public $alert;

    /**
     * LoginController constructor.
     * @param $POST_ARRAY
     */
    public function __construct($POST_ARRAY) {
        $this->parsePostArray($POST_ARRAY);
    }

    /**
     * Parse POST array and decide which function should be executed.
     * @param $POST_ARRAY
     */
    private function parsePostArray($POST_ARRAY) {
        // Check, if inputs are filled
        if (isset($POST_ARRAY['login-username']) && isset($POST_ARRAY['login-password'])) {
            // Create LoginHandler
            $loginHandler = new LoginHandler();

            // Try to login user with form inputs
            $ret = $loginHandler->login($POST_ARRAY['login-username'], $POST_ARRAY['login-password']);

            // Check, if login was successful
            if ($ret['err'] == true) {
                // => error occured -> set talert
                $this->alert = array();
                $this->alert['type'] = $ret['type'];
                $this->alert['msg'] = $ret['msg'];
            } else {
                // => login successful -> redirect user
                $loginHandler->redirect('vstp/index.php');
            }
        } else {
            $this->alert = array();
            $this->alert['type'] = 'info';
            $this->alert['msg'] = 'Bitte geben Sie ihren Benutzernamen und ihr Passwort ein.';
        }
    }

    /**
     * Gibt den Dateinamen der Template-Datei zurueck.
     * @return string Dateiname
     */
    public function getTemplate() {
        return 'loginTemplate';
    }

    /**
     * Gibt den Dateinamen der CSS-Datei zurueck.
     * @return string Dateiname
     */
    public function getStyleSheet() {
        return NULL;
    }

    /**
     * Ob eine JavaScript-Datei vorhanden ist oder nicht.
     * @return boolean
     */
    public function isScriptFileAvailable() {
        return NULL;
    }

    /**
     * Gibt den Dateinamen der JavaScript-Datei zurueck.
     * @return string Dateiname
     */
    public function getScriptFile() {
        return false;
    }

    /**
     * Gibt den angemeldeten User zurueck.
     * @return User
     */
    public function getUser() {
        return NULL;
    }


}

?>