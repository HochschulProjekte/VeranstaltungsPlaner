<?php

include_once __DIR__ . '/../class/arrayHelper.php';
include_once __DIR__ . '/../class/blockedUser.php';

/**
 * Class BlockedUserCollection
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class BlockedUserCollection {

    private $blockedUsers = [];

    /**
     * BlockedUserCollection constructor.
     */
    public function __construct() {

    }

    /**
     * Einen Mitarbeiter hinzufuegen.
     * @param $blockedUser
     */
    public function add($blockedUser) {
        array_push($this->blockedUsers, $blockedUser);
    }

    /**
     * Ist ein Mitarbeiter blockiert?
     * @param string $username Mitarbeiter-Name
     * @return bool ja oder nein
     */
    public function exists($username) {
        foreach ($this->blockedUsers as $blockedUser) {
            if ($blockedUser->getUsername() == $username) {
                return true;
            }
        }

        return false;
    }

    /**
     * Anzahl der gesperrten Positionen um eine Position verringern.
     */
    public function decreaseCount() {
        foreach ($this->blockedUsers as $blockedUser) {
            $blockedUser->decreaseCount();

            if ($blockedUser->getCount() == 0) {
                $this->blockedUsers = ArrayHelper::unsetValue($this->blockedUsers, $blockedUser);
            }
        }
    }
}

?>