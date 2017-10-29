<?php

include_once __DIR__ . '/../database/pdoDatabaseController.php';
include_once __DIR__ . '/../class/event.php';
include_once __DIR__ . '/../class/eventCollection.php';
include_once __DIR__ . '/../class/projectWeekEntry.php';

/**
 * Class ProjectWeek
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class ProjectWeek {

    const TABLE = 'ProjectWeek';

    private $databaseHandler;

    private $year;
    private $week;

    private $from;
    private $until;

    private $phase;

    private $allEvents;
    private $entries = [];

    /**
     * ProjectWeek constructor.
     * @param int $year
     * @param int $week
     */
    function __construct($year = NULL, $week = NULL) {
        $this->databaseHandler = new PDODatabaseController();

        if ($year == NULL && $week == NULL) {
            $this->year = $this->getCurrentCalendarYear();
            $this->week = $this->getCurrentCalendarWeek();
            $this->from = $this->getCurrentStartDate();
            $this->until = $this->getCurrentEndDate();
            $this->phase = 1;

        } else {
            $this->year = $year;
            $this->week = $week;
        }

        $this->load($this->year, $this->week);
        $this->loadMyEvents();
    }

    /**
     * Liefert das aktuelle Kalender Jahr.
     * @return int
     */
    public static function getCurrentCalendarYear() {
        $year = date('Y');
        return $year;
    }

    /**
     * Liefert die aktuelle Kalenderwoche.
     * @return int
     */
    public static function getCurrentCalendarWeek() {
        $calendarWeek = date('W', time());
        return $calendarWeek;
    }

    /**
     * Liefert das Datum als yyyy-mm-dd des aktuellen Montags dieser Woche.
     * @return string
     */
    public function getCurrentStartDate() {
        return date("Y-m-d", strtotime('monday this week'));
    }

    /**
     * Liefert das Datum als yyyy-mm-dd des aktuellen Freitags dieser Woche.
     * @return string
     */
    public function getCurrentEndDate() {
        return date("Y-m-d", strtotime('friday this week'));
    }

    /**
     * Laden der Projektwoche.
     * @param int $year
     * @param int $week
     */
    private function load($year, $week) {
        $result = $this->databaseHandler->select(self::TABLE, 'year = ' . $year . ' AND week = ' . $week);

        if (count($result) == 0) {

            $this->from = $this->getStartDateOfWeek($year, $week);
            $this->until = $this->getEndDateOfWeek($year, $week);
            $this->phase = 1;

            $this->create();
        } else {

            $this->year = $result[0]['year'];
            $this->week = $result[0]['week'];
            $this->from = date('Y-m-d', strtotime($result[0]['from']));
            $this->until = date('Y-m-d', strtotime($result[0]['until']));
            $this->phase = $result[0]['phase'];
        }

    }

    /**
     * Liefert das Datum als yyyy-mm-dd des aktuellen Montags der uebergebenden Woche.
     * @param int $year
     * @param int $week
     * @return string
     */
    public static function getStartDateOfWeek($year, $week) {

        if (strlen($week) == 1) {
            $week = '0' . $week;
        }

        return date('Y-m-d', strtotime($year . 'W' . $week));
    }

    /**
     * Liefert das Datum als yyyy-mm-dd des aktuellen Freitags der uebergebenden Woche.
     * @param int $year
     * @param int $week
     * @return string
     */
    public static function getEndDateOfWeek($year, $week) {

        if (strlen($week) == 1) {
            $week = '0' . $week;
        }

        return date('Y-m-d', strtotime($year . 'W' . $week . ' +4 days'));
    }

    /**
     * Neue Projektwoche anlegen.
     * @return bool
     */
    private function create() {

        $values = [
            new ColumnItem('year', $this->year),
            new ColumnItem('week', $this->week),
            new ColumnItem('from', $this->from),
            new ColumnItem('until', $this->until),
            new ColumnItem('phase', $this->phase)
        ];

        return $this->databaseHandler->insert(self::TABLE, $values);
    }

    /**
     * Projektwochen-Eintraege laden.
     * @return array
     */
    private function loadMyEvents() {
        $result = $this->databaseHandler->select('ProjectWeekEntry', 'year = ' . $this->year . ' AND week = ' . $this->week, 'position');

        $this->entries = [];

        foreach ($result as $entry) {
            array_push($this->entries,
                new ProjectWeekEntry($entry['projectWeekEntryId'])
            );
        }

        return $this->entries;
    }

    /**
     * Vorhandene Projektwoche speichern.
     * @return bool
     */
    public function save() {

        $values = [
            new ColumnItem('phase', $this->phase)
        ];

        return $this->databaseHandler->update(self::TABLE, $values, 'year = ' . $this->year . ' AND week = ' . $this->week);
    }

    /**
     * Liefert alle Veranstaltung einer Projektwoche die ein Dozent halten muss.
     * @param int $year
     * @param int $week
     * @param string $username
     * @return array ProjectWeekEntry
     */
    public function getProjectWeekEntriesOfPersonnalManager($username) {
        $entries = [];
        $result = $this->databaseHandler->query('SELECT * FROM ProjectWeekEntry INNER JOIN Event ON ProjectWeekEntry.eventId = Event.eventId WHERE ProjectWeekEntry.year = ' . $this->year . ' AND ProjectWeekEntry.week = ' . $this->week . ' AND Event.eventManager = "' . $username . '" ORDER BY ProjectWeekEntry.position;');

        foreach ($result as $entry) {
            array_push($entries,
                new ProjectWeekEntry($entry['projectWeekEntryId'])
            );
        }

        return $entries;
    }

    /**
     * Liefert die eingetragenen Projektwochen-Eintraege.
     * @return array ProjectWeekEntry
     */
    public function getProjectWeekEntries() {
        return $this->entries;
    }

    /**
     * Liefert die Projektwochen-Eintraege einer bestimmten Position.
     * @param int $position
     * @return array ProjectWeekEntry
     */
    public function getProjectWeekEntriesAtPosition($position) {

        $entriesAtPosition = [];

        foreach ($this->entries as $entry) {
            if ($entry->getPosition() == $position) {
                array_push($entriesAtPosition, $entry);
            }
        }

        return $entriesAtPosition;
    }

    /**
     * Liefert alle moeglichen Veranstaltungen.
     * @return array Event
     */
    public function getAllEvents() {
        return $this->allEvents->getEvents();
    }

    /**
     * Liefert das Jahr der Projektwoche.
     * @return int
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * Liefert die Kalenderwoche der Projektwoche.
     * @return int
     */
    public function getWeek() {
        return $this->week;
    }

    /**
     * Liefert das Startdatum einer Projektewoche als yyyy-mm-dd.
     * @return string
     */
    public function getFromDate() {
        return $this->from;
    }

    /**
     * Liefert das Enddatum einer Projektewoche als yyyy-mm-dd.
     * @return string
     */
    public function getUntilDate() {
        return $this->until;
    }

    /**
     * Liefert die aktuelle Phase der Projektwoche.
     * @return int
     */
    public function getPhase() {
        return $this->phase;
    }

    /**
     * Aendert die aktuelle Phase der Projektwoche.
     * @param int $phase
     */
    public function setPhase($phase) {
        $this->phase = $phase;
    }
}

?>