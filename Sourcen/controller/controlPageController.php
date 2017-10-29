<?php

include_once __DIR__ . '/../controller/IController.php';

/**
 * Class ControlPageController
 *
 * Diese Klasse steuert die Seite control.php.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class ControlPageController implements IController {

    private $user;

    /**
     * ControlPageController constructor.
     * @param $user
     */
    public function __construct($user) {
        $this->user = $user;
        $this->checkPageAllowed();
    }

    /**
     * Ueberprueft ob der Nutzer genug Rechte hat, um die Seite zu besuchen.
     */
    private function checkPageAllowed() {

        if (!$this->user->isPersonnalManager()) {

            header('Location: ./index.php');
            exit();
        }
    }

    /**
     * Gibt den Dateinamen der Template-Datei zurueck.
     * @return string Dateiname
     */
    public function getTemplate() {
        return 'controlTemplate';
    }

    /**
     * Gibt den Dateinamen der CSS-Datei zurueck.
     * @return string Dateiname
     */
    public function getStyleSheet() {
        return 'control';
    }

    /**
     * Ob eine JavaScript-Datei vorhanden ist oder nicht.
     * @return boolean
     */
    public function isScriptFileAvailable() {
        return false;
    }

    /**
     * Gibt den Dateinamen der JavaScript-Datei zurueck.
     * @return string Dateiname
     */
    public function getScriptFile() {
        return NULL;
    }

    /**
     * Gibt den angemeldeten User zurueck.
     * @return User
     */
    public function getUser() {
        return $this->user;
    }
}

?>