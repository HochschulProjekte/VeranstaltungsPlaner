<?php

include_once __DIR__ . '/../controller/IController.php';
include_once __DIR__ . '/../class/loginHandler.php';

/**
 * Class LoginController
 *
 * Diese Klasse steuert die Seite login.php.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class LoginController implements IController {

    public $alert;

    /**
     * LoginController constructor.
     * @param $POST_ARRAY
     */
    public function __construct($POST_ARRAY) {
        $this->parsePostArray($POST_ARRAY);
    }

    /**
     * POST Eingabe auswerten und die entsprechenden Methoden aufrufen.
     * @param $POST_ARRAY
     */
    private function parsePostArray($POST_ARRAY) {

        // Eingabefelder gefuellt?
        if (isset($POST_ARRAY['login-username']) && isset($POST_ARRAY['login-password'])) {

            $loginHandler = new LoginHandler();
            $ret = $loginHandler->login($POST_ARRAY['login-username'], $POST_ARRAY['login-password']);

            // Ueberpruefung ob der Login erfolgreich war.
            if ($ret['err'] == true) {
                // => Fehler aufgetreten -> Fehlermeldung ausgeben
                $this->alert = array();
                $this->alert['type'] = $ret['type'];
                $this->alert['msg'] = $ret['msg'];
            } else {
                // => Login erfolgreich -> Benutzer weiterleiten.
                $loginHandler->redirect('index.php');
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