<?php

// Includes
include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/user.php';

class MyProfileController {

    private $user;
    private $msg_one;
    private $msg_two;

    function __construct($POST_ARRAY, $user) {
        $this->setUser($user);
        $this->setMessage(1, false, '', '');
        $this->setMessage(2, false, '', '');
        $this->parsePostArray($POST_ARRAY);
    }

    public function getUsername() {
        return $this->user->getName();
    }

    public function getEmail() {
        return $this->user->getEmail();
    }

    public function getMessages() {
        if ($this->msg_one['show'] === true) {
            echo '<div class="alert alert-' . $this->msg_one['type'] . '">' . $this->msg_one['text'] . '</div>';
        }
        if ($this->msg_two['show'] === true) {
            echo '<div class="alert alert-' . $this->msg_two['type'] . '">' . $this->msg_two['text'] . '</div>';
        }
    }

    private function setUser($user) {
        $this->user = $user;
    }

    private function setMessage($msg, $show, $type, $text) {
        switch ($msg) {
            case 1:
                $this->msg_one = [  'show' => $show,
                                    'type' => $type,
                                    'text' => $text];
                break;
            case 2:
                $this->msg_two = [  'show' => $show,
                                    'type' => $type,
                                    'text' => $text];
                break;
            default:
                $this->msg_one = [  'show' => $show,
                                    'type' => $type,
                                    'text' => $text];
                break;
        }
    }

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

    private function updateEmail($email) {
        $this->user->setEmail($email);
        if ($this->user->update()) {
            $this->setMessage(1, true, 'success', 'Die E-Mail-Adresse wurde erfolgreich aktualisiert.');
        } else {
            $this->setMessage(1, true, 'danger', 'Beim Aktualisieren der E-Mail-Adresse ist ein Fehler aufgetreten.');
        }
        
    }

    private function updatePassword($password) {
        $this->user->setPassword($password);
        if ($this->user->update()) {
            $this->setMessage(2, true, 'success', 'Das Passwort wurde erfolgreich aktualisiert.');
        } else {
            $this->setMessage(2, true, 'danger', 'Beim Aktualisieren des Passworts ist ein Fehler aufgetreten.');
        }
        
    }

}

$myprofileController = new MyProfileController($_POST, $myUser);

?>