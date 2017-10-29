<?php

/**
 * Class BlockedUser
 *
 * Diese Klasse entspricht einem Mitarbeiter, welcher im Phasenwechsel 2 zu 3 fuer eine/mehrere Positionen uebersprungen
 * werden soll, da jener vorher zu einer Veranstaltung zugewiesen wurde, welche laenger als einen Halbtag dauert.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class BlockedUser {

    private $username;
    private $count;

    /**
     * BlockedUser constructor.
     * @param string $username
     * @param int $count
     */
    public function __construct($username, $count) {
        $this->username = $username;
        $this->count = $count;
    }

    /**
     * Liefert den Benutzernamen des Users.
     * @return string Username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Liefert die Anzahl der geblocketen Positionen des Users.
     * @return int count
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * Anzahl der gesperrten Positionen um eine Position verringern.
     */
    public function decreaseCount() {
        $this->count--;
    }

}

?>