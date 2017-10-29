<?php

/**
 * Class ChangePhaseMessage
 *
 * Diese Klasse repraesentiert eine Antwort des PhasenManagers.
 * Diese Nachricht kann auf der Oberflaeche dargestellt werden.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class ChangePhaseMessage {

    private $status;
    private $newPhase;
    private $message;
    private $position;
    private $missingUsers;

    /**
     * ChangePhaseMessage constructor.
     * @param boolean $status
     * @param int $newPhase
     * @param string $message
     * @param int $position
     * @param int $missingUsers
     */
    public function __construct($status, $newPhase, $message, $position = 0, $missingUsers = 0) {
        $this->status = $status;
        $this->newPhase = $newPhase;
        $this->message = $message;
        $this->position = $position;
        $this->missingUsers = $missingUsers;
    }

    /**
     * Liefert den Status der Nachricht.
     * @return boolean status
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Liefert die neue Phase.
     * @return int
     */
    public function getNewPhase() {
        return $this->newPhase;
    }

    /**
     * Liefert eine Nachricht des Phasenwechsels.
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Liefert die Position auf Plaetze fuer Veranstaltung fehlen.
     * @return int
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Liefert die Anzahl der fehlenden Plaetze.
     * @return int
     */
    public function getMissingUsers() {
        return $this->missingUsers;
    }
}

?>