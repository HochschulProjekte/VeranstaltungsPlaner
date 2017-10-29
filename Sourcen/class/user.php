<?php

include_once __DIR__ . '/../database/pdoDatabaseController.php';

/**
 * Class User
 *
 * Diese Klasse repraesentiert einen Benutzer.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class User {

    const TABLE = 'User';
    private $databaseHandler;

    private $primaryKey;
    private $name;
    private $password;
    private $personnalManager;
    private $email;

    /**
     * User constructor (Falls der Name des Nutzer uebergeben wird,
     * laedt die Klasse automatisch ihre Daten aus der Datenbank)
     * @param null $name
     */
    function __construct($name = NULL) {

        $this->databaseHandler = new PDODatabaseController();

        if ($name != NULL) {
            $this->load($name);
        }

    }

    /**
     * Laedt die Daten eines Benutzer aus der Datenbank
     * @param string $name
     */
    public function load($name) {

        $result = $this->databaseHandler->select(self::TABLE, 'name = "' . $name . '"');

        $this->setPrimaryKey($result[0]['name']);
        $this->setName($result[0]['name']);
        $this->setPassword($result[0]['password']);
        $this->setPersonnalManager($this->convertPersonnalManagerForObject($result[0]['personnalManager']));
        $this->setEmail($result[0]['email']);

    }

    /**
     * PersonnalManager-Attribut fuer das Objekt von Integer zu Boolean umwandeln.
     * @param $personnalManager
     * @return bool
     */
    private function convertPersonnalManagerForObject($personnalManager) {
        if ($personnalManager == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Benutzer in der Datenbank erstellen.
     * @return bool
     */
    public function create() {

        $values = [
            new ColumnItem('name', $this->getName()),
            new ColumnItem('password', $this->getPassword()),
            new ColumnItem('personnalManager', $this->convertPersonnalManagerForDatabase($this->isPersonnalManager())),
            new ColumnItem('email', $this->getEmail())
        ];

        if ($this->databaseHandler->insert(self::TABLE, $values) == true) {
            $this->setPrimaryKey($this->getName());
            return true;
        } else {
            return false;
        }
    }

    /**
     * Umwandeln der des boolean Werts des Attributs $personnalManager zu einem Integer-Wert.
     * @param bool $personnalManager
     * @return int
     */
    private function convertPersonnalManagerForDatabase($personnalManager) {
        if ($personnalManager == true) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Daten eines Nutzers in der Datenbank persistieren.
     * @return bool
     */
    public function update() {

        $values = [
            new ColumnItem('name', $this->getName()),
            new ColumnItem('password', $this->getPassword()),
            new ColumnItem('personnalManager', $this->convertPersonnalManagerForDatabase($this->isPersonnalManager())),
            new ColumnItem('email', $this->getEmail())
        ];

        if ($this->databaseHandler->update(self::TABLE, $values, 'name = "' . $this->getPrimaryKey() . '"') == true) {
            $this->setPrimaryKey($this->getName());
            return true;
        } else {
            return false;
        }
    }

    /**
     * Loeschen eines Nutzers aus der Datenbank.
     * @return bool
     */
    public function delete() {
        return $this->databaseHandler->delete(self::TABLE, 'name = "' . $this->getPrimaryKey() . '"');
    }

    /**
     * @return int
     */
    private function getPrimaryKey() {
        return $this->primaryKey;
    }

    /**
     * @param int $primaryKey
     */
    private function setPrimaryKey($primaryKey) {
        $this->primaryKey = $primaryKey;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @param bool $personnalManager
     */
    public function setPersonnalManager($personnalManager) {
        $this->personnalManager = $personnalManager;
    }

    /**
     * @return bool
     */
    public function isPersonnalManager() {
        return $this->personnalManager;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }
}

?>