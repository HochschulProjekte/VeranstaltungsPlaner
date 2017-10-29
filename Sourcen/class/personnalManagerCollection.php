<?php

include_once __DIR__ . '/../class/personnalManager.php';
include_once __DIR__ . '/../database/pdoDatabaseController.php';

/**
 * Class PersonnalManagerCollection
 *
 * Diese Klasse enthaelt eine Sammlung von Sachbearbeitern.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class PersonnalManagerCollection {

    const TABLE = 'User';
    private $databaseHandler;

    private $personnalManagers = [];

    /**
     * PersonnalManagerCollection constructor.
     */
    public function __construct() {
        $this->databaseHandler = new PDODatabaseController();
        $this->loadAllPersonnalManagers();
    }

    /**
     * Laden aller moeglichen Sachbearbeiter / Dozenten.
     */
    private function loadAllPersonnalManagers() {
        $result = $this->databaseHandler->select(self::TABLE, 'personnalManager = 1');

        foreach ($result as $item) {
            array_push($this->personnalManagers, new PersonnalManager($item['name'], $item['email']));
        }
    }

    /**
     * Liefert ein Array von Sachbearbeitern.
     * @return array
     */
    public function getPersonnalManagers() {
        return $this->personnalManagers;
    }
}

?>