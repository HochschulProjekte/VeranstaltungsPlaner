<?php

include_once __DIR__ .'/../database/databaseHandler.php';
include_once __DIR__.'/../class/event.php';
include_once __DIR__.'/../class/projectWeekEntry.php';

class ProjectWeek {

    const TABLE = 'ProjectWeek';

    private $databaseHandler;

    private $year;
    private $week;

    private $from;
    private $until;

    private $phase;

    private $allEvents = [];
    private $entries = [];

    function __construct($year = NULL, $week = NULL) {
        $this->databaseHandler = new PDOHandler();

        if($year == NULL && $week == NULL) {
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

    private function load($year, $week) {
        $result = $this->databaseHandler->select(self::TABLE, 'year = '.$year.' AND week = '.$week);

        if(count($result) == 0) {

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

    private function create() {

        $values = [
            new ColumnItem('year', $this->year),
            new ColumnItem('week', $this->week),
            new ColumnItem('from', $this->from),
            new ColumnItem('until', $this->until),
            new ColumnItem('phase', $this->phase)
        ];

        $result = $this->databaseHandler->insert(self::TABLE, $values);
    }

    public function save() {

        $values = [
            new ColumnItem('phase', $this->phase)
        ];

        $result = $this->databaseHandler->update(self::TABLE, $values, 'year = '.$this->year.' AND week = '.$this->week);

    }

    public function loadAllEvents() {
        $result = $this->databaseHandler->select('Event', null);
        $this->allEvents = [];

        foreach ($result as $row) {
            array_push($this->allEvents, new Event($row['eventId']));
        }

        return $this->allEvents;
    }

    private function loadMyEvents() {
        $result = $this->databaseHandler->select('ProjectWeekEntry', 'year = '.$this->year.' AND week = '.$this->week, 'position');

        $this->entries = [];

        foreach ($result as $entry) {
            array_push($this->entries,
                new ProjectWeekEntry($entry['projectWeekEntryId'])
            );
        }

        return $this->entries;
    }

    public static function getStartDateOfWeek($year, $week) {

        if(strlen($week) == 1) {
            $week = '0'.$week;
        }

        return date('Y-m-d', strtotime($year.'W'.$week));
    }

    public static function getEndDateOfWeek($year, $week) {

        if(strlen($week) == 1) {
            $week = '0'.$week;
        }

        return date( 'Y-m-d', strtotime($year.'W'.$week.' +4 days') );
    }

    public static function getCurrentCalendarWeek() {
        $calendarWeek = 0;
        $calendarWeek = date('W', time());
        return $calendarWeek;
    }

    public static function getCurrentCalendarYear() {
        $year = 0;
        $year = date('Y');
        return $year;
    }

    public function getCurrentStartDate() {
        return date("Y-m-d", strtotime('monday this week'));
    }

    public function getCurrentEndDate() {
        return date("Y-m-d", strtotime('friday this week'));
    }

    public function getProjectWeekEntries() {
        return $this->entries;
    }

    public function getProjectWeekEntriesAtPosition($position) {

        $entriesAtPosition = [];

        foreach($this->entries as $entry) {
            if($entry->getPosition() == $position) {
                array_push($entriesAtPosition, $entry);
            }
        }

        return $entriesAtPosition;
    }

    public function getYear() {
        return $this->year;
    }

    public function getWeek() {
        return $this->week;
    }

    public function getFromDate() {
        return $this->from;
    }

    public function getUntilDate() {
        return $this->until;
    }

    public function getPhase() {
        return $this->phase;
    }

    public function setPhase($phase) {
        $this->phase = $phase;
    }
}
?>