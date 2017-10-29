<?php

include_once __DIR__ . '/../class/arrayHelper.php';
include_once __DIR__ . '/../class/projectWeek.php';
include_once __DIR__ . '/../class/projectWeekEntry.php';
include_once __DIR__ . '/../class/positionMapping.php';
include_once __DIR__ . '/../class/user.php';

include_once __DIR__ . '/../class/eventRegistration.php';
include_once __DIR__ . '/../class/eventRegistrationRepresentation.php';
include_once __DIR__ . '/../class/eventRegistrationCollection.php';

/**
 * Class EventsController
 *
 * Steuert die Logik der index.php Seite. Diese enthaelt die Darstellung des Studenplans eines Mitarbeiters bzw. die
 * Vorlesungen des Sachbearbeiters in der aktuellen Projektwoche.
 *
 * Mithilfe dieser Klasse besteht den Sacharbeitern die Moeglichkeit, sich an Projektwochen-Eintraegen zu registrieren.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class EventsController implements IController {

    private $user;
    private $projectWeek;
    private $eventRegistrationCollection;

    /**
     * MyEventsController constructor.
     * @param $user
     * @param $POST_ARRAY
     */
    function __construct($user, $POST_ARRAY) {
        $this->user = $user;
        $this->parsePostArray($POST_ARRAY);
    }

    /**
     * POST Eingabe auswerten.
     * @param $POST_ARRAY
     */
    private function parsePostArray($POST_ARRAY) {

        $year = NULL;
        $week = NULL;

        if (
            isset($POST_ARRAY['year'])
            && isset($POST_ARRAY['week'])
        ) {
            $year = $POST_ARRAY['year'];
            $week = $POST_ARRAY['week'];
        } else {
            $year = ProjectWeek::getCurrentCalendarYear();
            $week = ProjectWeek::getCurrentCalendarWeek();
        }

        // Projektwochen-Objekt erstellen
        $this->createProjectWeek($year, $week);

        // Benutzer an einer Veranstaltung registrierten
        if (
            isset($POST_ARRAY['registration'])
            && isset($POST_ARRAY['projectWeekEntryId'])
            && isset($POST_ARRAY['priority'])
        ) {
            $this->registerToEvent($POST_ARRAY['projectWeekEntryId'], $POST_ARRAY['priority']);
        }

        // Alle Anmeldungen zu Events eines Nutzers laden
        $this->createEventRegistrationCollection();
    }

    /**
     * Erstellt ein Projektwochen-Objekt
     * @param int $year
     * @param int $week
     */
    private function createProjectWeek($year, $week) {
        $this->projectWeek = new ProjectWeek($year, $week);
    }

    /**
     * Registiert einen Nutzer an einem spezifischen Projektwochen-Eintrag
     * @param int $projectWeekEntryId
     * @param int $priority
     */
    private function registerToEvent($projectWeekEntryId, $priority) {

        $eventRegistration = new EventRegistration(NULL);

        $eventRegistration->setUsername($this->user->getName());
        $eventRegistration->setProjectWeekEntry(new ProjectWeekEntry($projectWeekEntryId));
        $eventRegistration->setPriority($priority);
        $eventRegistration->setApproved('0');
        $eventRegistration->setRegistrationDate(date('Y-m-d H:i:s'));

        $eventRegistration->save();
    }

    /**
     * Erstellt eine Liste von Veranstaltungs-Registrierungen fuer einen spezifischen Benutzer
     * und Projektwochen kombination.
     */
    private function createEventRegistrationCollection() {
        $this->eventRegistrationCollection = new EventRegistrationCollection(
            $this->user->getName(),
            $this->projectWeek
        );
    }

    /**
     * Ist die Registeriung erlaubt?
     * @return bool
     */
    public function isRegistrationAllowed() {
        $phase = $this->projectWeek->getPhase();
        return ($phase == '2');
    }

    /**
     * Gibt den angemeldeten User zurueck.
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Liefert die Wochentage der aktuellen Projektwoche als Array von Zeichenketten.
     * @return array Wochentage als Zeichenketten
     */
    public function getWeekDays() {
        $day_array = [];

        array_push($day_array, $this->getWeekStartDate());
        array_push($day_array, date('Y-m-d', strtotime('next tuesday', strtotime($this->getWeekStartDate()))));
        array_push($day_array, date('Y-m-d', strtotime('next wednesday', strtotime($this->getWeekStartDate()))));
        array_push($day_array, date('Y-m-d', strtotime('next thursday', strtotime($this->getWeekStartDate()))));
        array_push($day_array, date('Y-m-d', strtotime('next friday', strtotime($this->getWeekStartDate()))));

        return $day_array;
    }

    /**
     * Liefert das Startdatum als yyyy-mm-dd der Projektwoche.
     * @return string
     */
    public function getWeekStartDate() {
        return $this->projectWeek->getFromDate();
    }

    /**
     * Liefert das Enddatum als yyyy-mm-dd der Projektwoche.
     * @return string
     */
    public function getWeekEndDate() {
        return $this->projectWeek->getUntilDate();
    }

    /**
     * Liefert das Jahr der Projektwoche.
     * @return int
     */
    public function getYear() {
        return $this->projectWeek->getYear();
    }

    /**
     * Liefert die Kalender-Woche der Projektwoche.
     * @return int
     */
    public function getWeek() {
        return $this->projectWeek->getWeek();
    }

    /**
     * Gibt den Dateinamen der Template-Datei zurueck.
     * @return string Dateiname
     */
    public function getTemplate() {
        if ($this->user->isPersonnalManager()) {
            return 'eventsPersonnalManagerTemplate';
        } else {
            return 'eventsParticipantsTemplate';
        }
    }

    /**
     * Gibt den Dateinamen der CSS-Datei zurueck.
     * @return string Dateiname
     */
    public function getStyleSheet() {
        return 'myEvents';
    }

    /**
     * Ob eine JavaScript-Datei vorhanden ist oder nicht.
     * @return boolean
     */
    public function isScriptFileAvailable() {
        return true;
    }

    /**
     * Gibt den Dateinamen der JavaScript-Datei zurueck.
     * @return string Dateiname
     */
    public function getScriptFile() {
        return 'myEvents';
    }

    /**
     * Liefert ein Array mit allen Projektwochen-Eintraegen die der angemeldete Sachbearbeiter halten muss.
     * @return array ProjectWeekEntry
     */
    public function getProjectWeekEntriesOfPersonnalManager() {
        return $this->projectWeek->getProjectWeekEntriesOfPersonnalManager($this->user->getName());
    }

    /**
     * Liefert ein Array mit allen Projektwochen-Eintraegen, die ein Mitarbeiter noch priorisieren kann.
     * Hierbei werden bereits priorisierte Projekt-Wochen-Eintraege gefiltert.
     * @return array ProjectWeekEntry
     */
    public function getPossibleProjectWeekEntriesOfUser() {

        $weekEntries = $this->projectWeek->getProjectWeekEntries();

        foreach ($this->eventRegistrationCollection->getEventRegistrations() as $eventRegistration) {
            foreach ($weekEntries as $weekEntry) {

                if ($eventRegistration->getProjectWeekEntry()->getId() == $weekEntry->getId()) {
                    $weekEntries = ArrayHelper::unsetValue($weekEntries, $weekEntry);
                    break;
                }
            }
        }

        return $weekEntries;
    }

    /**
     * Liefert eine HTML-Repraesentation der Registration eines Nutzer an der uebergebenden Position.
     * @param int $position
     * @return string | null
     */
    public function getEventRegistrationRepresentationAtPosition($position) {

        // Suche der Veranstaltung-Registrierung-Darstellungs-Objekte
        foreach ($this->eventRegistrationCollection->getEventRepresentations() as $eventRepresentation) {

            // ist die richtige Position gefunden
            if ($eventRepresentation->getPosition() == $position) {

                // wird ueberprueft ob die Registrierung akzeptiert wurde oder nicht.
                if ($eventRepresentation->isApproved()) {
                    return $eventRepresentation;
                } else {
                    return NULL;
                }
            }
        }

        return NULL;
    }

    /**
     * Liefert ein Objekt vom Typ EventRegistrationCollection mit allen Registrierungen eines Mitarbeiters von der
     * aktuellen Projektwoche.
     * @return EventRegistrationCollection
     */
    public function getEventRegistrationCollection() {
        return $this->eventRegistrationCollection;
    }
}

?>