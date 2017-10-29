<?php

include_once __DIR__ . '/../database/pdoDatabaseController.php';
include_once __DIR__ . '/../class/projectWeekEntry.php';

/**
 * Class EventRegistration
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class EventRegistration {

    const TABLE = 'EventRegistration';

    private $databaseHandler;

    private $id;
    private $username;
    private $projectWeekEntry;
    private $year;
    private $week;
    private $priority;
    private $approved;
    private $registrationDate;

    /**
     * EventRegistration constructor.
     * @param null $id
     */
    function __construct($id = NULL) {

        $this->databaseHandler = new PDODatabaseController();

        if ($id != NULL) {
            $this->load($id);
        }
    }

    /**
     * Laedt die aktuellen Daten aus der Datenbank.
     * @param $id
     */
    private function load($id) {
        $where = 'eventRegistrationId = ' . $id;

        $result = $this->databaseHandler->select(self::TABLE, $where);

        $this->id = $result[0]['eventRegistrationId'];
        $this->username = $result[0]['username'];
        $this->projectWeekEntry = new ProjectWeekEntry($result[0]['projectWeekEntryId']);
        $this->year = $result[0]['year'];
        $this->week = $result[0]['week'];
        $this->priority = $result[0]['priority'];
        $this->approved = $result[0]['approved'];
        $this->registrationDate = $result[0]['registrationDate'];
    }

    /**
     * Persistiert die Registration eines Mitarbeiters in der Datenbank.
     */
    public function save() {

        $values = [
            new ColumnItem('username', $this->username),
            new ColumnItem('projectWeekEntryId', $this->projectWeekEntry->getId()),
            new ColumnItem('year', $this->projectWeekEntry->getYear()),
            new ColumnItem('week', $this->projectWeekEntry->getWeek()),
            new ColumnItem('priority', $this->priority),
            new ColumnItem('approved', $this->approved),
            new ColumnItem('registrationDate', $this->registrationDate)
        ];

        if ($this->id != NULL) {
            $where = 'eventRegistrationId = ' . $this->id;
            $this->databaseHandler->update(self::TABLE, $values, $where);
        } else {
            $this->databaseHandler->insert(self::TABLE, $values);
        }
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return ProjectWeekEntry
     */
    public function getProjectWeekEntry() {
        return $this->projectWeekEntry;
    }

    /**
     * @param ProjectWeekEntry $projectWeekEntry
     */
    public function setProjectWeekEntry($projectWeekEntry) {
        $this->projectWeekEntry = $projectWeekEntry;
    }

    /**
     * @return int
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority) {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function isApproved() {
        return $this->approved;
    }

    /**
     * @param int $approved
     */
    public function setApproved($approved) {
        $this->approved = $approved;
    }

    /**
     * @return string
     */
    public function getRegistrationDate() {
        return $this->registrationDate;
    }

    /**
     * @param string $registrationDate
     */
    public function setRegistrationDate($registrationDate) {
        $this->registrationDate = $registrationDate;
    }

}

?>