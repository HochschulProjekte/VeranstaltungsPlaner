<?php

include_once __DIR__ . '/../class/event.php';

/**
 * Class PersonnalManager
 *
 * Diese Klasse repraesentiert einen Sachbearbeiter.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class PersonnalManager {

    private $name;
    private $email;

    /**
     * PersonnalManager constructor.
     * @param $name
     * @param $email
     */
    function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Erstellen eines neuen Veranstaltung.
     * @param $name
     * @param $description
     * @param $length
     * @param $maxParticipants
     * @param $personnalManager
     * @return bool
     */
    function createEvent($name, $description,
                         $length, $maxParticipants,
                         $personnalManager) {
        $event = new Event();

        $event->setName($name);
        $event->setDescription($description);
        $event->setLength($length);
        $event->setMaxParticipants($maxParticipants);
        $event->setPersonnalManager($personnalManager);

        return $event->save();
    }

    /**
     * Liefert den Namen des Sachbearbeiters.
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Liefert die Email-Adresse des Sachbearbeiters.
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }
}

?>