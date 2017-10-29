<?php
include_once __DIR__ . '/../database/pdoDatabaseController.php';

/**
 * Class Event
 *
 * Diese Klasse repraesentiert eine Veranstaltung. Diese Veranstaltung kann:
 * - ihre eigenen Daten aus der Datenbank laden,
 * - Aenderungen ihrer Daten in der Datenbank persistieren,
 * - und sich selber in der Datenbank loeschen.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class Event {

    const TABLE = 'Event';
    private $id;
    private $name;
    private $description;
    private $length;
    private $maxParticipants;
    private $personnalManager;
    private $databaseHandler;

    /**
     * Event constructor.
     * @param int $id
     */
    function __construct($id = NULL) {

        $this->databaseHandler = new PDODatabaseController();

        if ($id != NULL) {
            $this->load($id);
        }
    }

    /**
     * Veranstaltung laden.
     * @param $id
     */
    private function load($id) {
        $result = $this->databaseHandler->select(self::TABLE, 'eventId = ' . $id);

        $this->id = $result[0]['eventId'];
        $this->name = $result[0]['name'];
        $this->description = $result[0]['description'];

        $this->length = $result[0]['length'];

        $this->maxParticipants = $result[0]['maxParticipants'];
        $this->personnalManager = $result[0]['eventManager'];

    }

    /**
     * Veranstaltung speichern.
     * @return bool
     */
    public function save() {

        $values = [
            new ColumnItem('name', $this->name),
            new ColumnItem('description', $this->description),
            new ColumnItem('length', $this->length),
            new ColumnItem('maxParticipants', $this->maxParticipants),
            new ColumnItem('eventManager', $this->personnalManager)
        ];

        if ($this->id == NULL) {
            // new event
            return $this->databaseHandler->insert(self::TABLE, $values);
        } else {
            // update
            return $this->databaseHandler->update(self::TABLE, $values, 'eventId = ' . $this->id);
        }
    }

    /**
     * Veranstaltung loeschen.
     * @return bool
     */
    public function delete() {
        $where = 'eventId = ' . $this->id;
        if ($this->databaseHandler->delete(self::TABLE, $where)) {
            $this->id = NULL;
            $this->name = NULL;
            $this->description = NULL;
            $this->length = NULL;
            $this->maxParticipants = NULL;
            $this->personnalManager = NULL;

            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
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
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength($length) {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getMaxParticipants() {
        return $this->maxParticipants;
    }

    /**
     * @param int $maxParticipants
     */
    public function setMaxParticipants($maxParticipants) {
        $this->maxParticipants = $maxParticipants;
    }

    /**
     * @return int
     */
    public function getPersonnalManager() {
        return $this->personnalManager;
    }

    /**
     * @param int $personnalManager
     */
    public function setPersonnalManager($personnalManager) {
        $this->personnalManager = $personnalManager;
    }
}

?>