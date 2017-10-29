<?php

include_once __DIR__ . '/../class/user.php';
include_once __DIR__ . '/../controller/IController.php';

/**
 * Class ProfileController
 *
 * Dieser Controller steuert die Logik auf der profile.php-Seite. Es besteht die Moeglichkeit das Passwort
 * und die Email-Adresse des eigenen Nutzers anzupassen.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class ProfileController implements IController {

    private $user;
    private $msg_one;
    private $msg_two;

    /**
     * MyProfileController constructor.
     * @param $POST_ARRAY
     * @param $user
     */
    function __construct($POST_ARRAY, $user) {
        $this->setUser($user);
        $this->setMessage(1, false, '', '');
        $this->setMessage(2, false, '', '');
        $this->parsePostArray($POST_ARRAY);
    }

    /**
     * User-Object speichert.
     * @param $user
     */
    private function setUser($user) {
        $this->user = $user;
    }

    /**
     * Aktuelle Nachricht der vorherigen Funktion speichern.
     * @param string $msg
     * @param bool $show
     * @param string $type
     * @param string $text
     */
    private function setMessage($msg, $show, $type, $text) {
        switch ($msg) {
            case 1:
                $this->msg_one = ['show' => $show,
                    'type' => $type,
                    'text' => $text];
                break;
            case 2:
                $this->msg_two = ['show' => $show,
                    'type' => $type,
                    'text' => $text];
                break;
            default:
                $this->msg_one = ['show' => $show,
                    'type' => $type,
                    'text' => $text];
                break;
        }
    }

    /**
     * POST-Eingabe auswerten.
     * @param $POST_ARRAY
     */
    private function parsePostArray($POST_ARRAY) {

        $email = NULL;
        $oldpassword = NULL;
        $newpassword = NULL;
        $passwordconfirm = NULL;

        if (isset($POST_ARRAY)) {

            if (isset($POST_ARRAY['myprofile-email']) && $POST_ARRAY['myprofile-email'] != $this->user->getEmail()) {
                $email = $POST_ARRAY['myprofile-email'];
                $this->updateEmail($email);
            }

            if (!empty($POST_ARRAY['myprofile-oldpassword']) || !empty($POST_ARRAY['myprofile-newpassword']) || !empty($POST_ARRAY['myprofile-passwordconfirm'])) {

                if (empty($POST_ARRAY['myprofile-oldpassword']) || empty($POST_ARRAY['myprofile-newpassword']) || empty($POST_ARRAY['myprofile-passwordconfirm'])) {
                    $this->setMessage(2, true, 'danger', 'Zum Ändern des Passworts müssen Sie die Felder "Altes Passwort", "Neues Passwort" und "Passwort bestätigen" eingeben.');
                } else {
                    $oldpassword = $POST_ARRAY['myprofile-oldpassword'];
                    $newpassword = $POST_ARRAY['myprofile-newpassword'];
                    $passwordconfirm = $POST_ARRAY['myprofile-passwordconfirm'];

                    if ($oldpassword != $this->user->getPassword()) {
                        $this->setMessage(2, true, 'danger', 'Sie haben ein falsches altes Passwort angegeben.');
                    } else {
                        if ($newpassword != $passwordconfirm) {
                            $this->setMessage(2, true, 'danger', 'Die Felder "Neues Passwort" und "Passwort bestätigen" stimmen nicht überein.');
                        } else {
                            $this->updatePassword($newpassword);
                        }
                    }
                }

            }

        }

    }

    /**
     * EMail-Adresse des aktuellen Benutzers anpassen.
     * @param string $email
     */
    private function updateEmail($email) {
        $this->user->setEmail($email);
        if ($this->user->update()) {
            $this->setMessage(1, true, 'success', 'Die E-Mail-Adresse wurde erfolgreich aktualisiert.');
        } else {
            $this->setMessage(1, true, 'danger', 'Beim Aktualisieren der E-Mail-Adresse ist ein Fehler aufgetreten.');
        }

    }

    /**
     * Passwort des aktuellen Benutzers anpassen.
     * @param string $password
     */
    private function updatePassword($password) {
        $this->user->setPassword($password);
        if ($this->user->update()) {
            $this->setMessage(2, true, 'success', 'Das Passwort wurde erfolgreich aktualisiert.');
        } else {
            $this->setMessage(2, true, 'danger', 'Beim Aktualisieren des Passworts ist ein Fehler aufgetreten.');
        }

    }

    /**
     * Gibt den Dateinamen der Template-Datei zurueck.
     * @return string Dateiname
     */
    public function getTemplate() {
        return 'profileTemplate';
    }

    /**
     * Gibt den Dateinamen der CSS-Datei zurueck.
     * @return string Dateiname
     */
    public function getStyleSheet() {
        return 'myProfile';
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

    /**
     * Gibt den Benutzernamen als Zeichenketten zurueck.
     * @return string
     */
    public function getUsername() {
        return $this->user->getName();
    }

    /**
     * Gibt die EMail-Adresse als Zeichenketten zurueck.
     * @return string
     */
    public function getEmail() {
        return $this->user->getEmail();
    }

    /**
     * Gibt eine Nachricht aus.
     */
    public function getMessages() {
        if ($this->msg_one['show'] === true) {
            echo '<div class="alert alert-' . $this->msg_one['type'] . '">' . $this->msg_one['text'] . '</div>';
        }
        if ($this->msg_two['show'] === true) {
            echo '<div class="alert alert-' . $this->msg_two['type'] . '">' . $this->msg_two['text'] . '</div>';
        }
    }
}

?>