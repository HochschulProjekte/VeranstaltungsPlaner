<?php

include $_SERVER['DOCUMENT_ROOT'].'/programmierprojekt/database/databasehandler.php';

class User {

    /***********************************************************************************/
    /*   Variables                                                                     */
    /***********************************************************************************/

    // Set base table for class
    const TABLE = 'User';

    // Object variable for database handling
    private $databaseHandler;

    // Objects user specific variables
    private $primaryKey;
    private $name;
    private $password;
    private $personnalManager;
    private $email;

    /***********************************************************************************/
    /*   Functions                                                                     */
    /***********************************************************************************/

    // Constructor (if name is given it automatically loads the user from database)
    function __construct($name = NULL) {

        $this->databaseHandler = new PDOHandler();

        if ($name != NULL) {
            $this->load($name);
        }

    }

    /***********************************************************************************/
    /*   Getter functions                                                              */
    /***********************************************************************************/

    private function getPrimaryKey() {
        return $this->primaryKey;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function isPersonnalManager() {
        return $this->personnalManager;
    }

    public function getEmail() {
        return $this->email;
    }

    /***********************************************************************************/
    /*   Setter functions                                                              */
    /***********************************************************************************/

    private function setPrimaryKey($primaryKey) {
        $this->primaryKey = $primaryKey;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPersonnalManager($personnalManager) {
        $this->personnalManager = $personnalManager;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    /***********************************************************************************/
    /*   Database functions                                                            */
    /***********************************************************************************/

    // Function for loading user data from database by name
    public function load($name) {

        // Get user data from database
        $result = $this->databaseHandler->select(self::TABLE, 'name = "' . $name . '"');
        
        // Store data in object variables
        $this->setPrimaryKey($result[0]['name']);
        $this->setName($result[0]['name']);
        $this->setPassword($result[0]['password']);
        $this->setPersonnalManager($this->convertPersonnalManagerForObject($result[0]['personnalManager']));
        $this->setEmail($result[0]['email']);

    }

    // Function for creating a new user in the database
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

        return false;

    }

    // Function for updating a user in the database
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

        return false;

    }

    // Function for deleting a user in the database
    public function delete() {

        return $this->databaseHandler->delete(self::TABLE, 'name = "' . $this->getPrimaryKey() . '"');

    }

    /***********************************************************************************/
    /*   Other functions                                                               */
    /***********************************************************************************/

    private function convertPersonnalManagerForObject($personnalManager) {
        if ($personnalManager == 1) {
            return true;
        } else {
            return false;
        }
    }

    private function convertPersonnalManagerForDatabase($personnalManager) {
        if ($personnalManager == true) {
            return 1;
        } else {
            return 0;
        }
    }

}

?>