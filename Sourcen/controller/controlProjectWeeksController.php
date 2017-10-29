<?php

include_once __DIR__ . '/../controller/IController.php';
include_once __DIR__ . '/../class/projectWeek.php';
include_once __DIR__ . '/../class/projectWeekEntry.php';
include_once __DIR__ . '/../class/phaseManager.php';
include_once __DIR__ . '/../class/changePhaseMessage.php';

/**
 * Class ControlProjectWeeksController
 *
 * Diese Klasse steuert die controlWeeks.php Seite. Es besteht hierbei die Moeglichkeit:
 * - eine neue Projektwoche anzulegen,
 * - Veranstaltungen zu einer Projektwoche hinzuzufuegen
 * - und Phasenwechsel einzuleiten.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class ControlProjectWeeksController implements IController {

    private $user;
    private $projectWeek;
    private $changePhaseMessage = null;
    private $allPossibleEvents;

    /**
     * ProjectWeeksController constructor.
     * @param $POST_ARRAY
     * @param $user
     */
    public function __construct($POST_ARRAY, $user) {
        $this->user = $user;
        $this->checkPageAllowed();

        $this->loadAllPossibleEvents();

        $this->parsePostArray($POST_ARRAY);
    }

    /**
     * Ueberprueft ob der Nutzer genug Rechte hat, um die Seite zu besuchen.
     */
    private function checkPageAllowed() {

        if (!$this->user->isPersonnalManager()) {

            header('Location: ./index.php');
            exit();
        }
    }

    /**
     * Laden aller moeglichen Events.
     */
    private function loadAllPossibleEvents() {
        $eventCollection = new EventCollection();
        $eventCollection->addAllEvents();

        $this->allPossibleEvents = $eventCollection->getEvents();
    }

    /**
     * POST Eingabe auswerten und entsprechende Funktionen ausfuehren.
     * @param $POST_ARRAY
     */
    private function parsePostArray($POST_ARRAY) {

        // Projektwochen-Eintrag hinzufuegen
        if (isset($POST_ARRAY['add'])
            && isset($POST_ARRAY['year'])
            && isset($POST_ARRAY['week'])
            && isset($POST_ARRAY['position'])
            && isset($POST_ARRAY['maxParticipants'])
            && isset($POST_ARRAY['eventId'])) {

            $this->addProjectWeekEntry(
                $POST_ARRAY['year'], $POST_ARRAY['week'],
                $POST_ARRAY['position'], $POST_ARRAY['maxParticipants'],
                $POST_ARRAY['eventId']
            );
        }

        // Projektwochen-Eintrag loeschen
        if (isset($POST_ARRAY['delete']) && isset($POST_ARRAY['projectWeekEntryId'])) {
            $this->deleteProjectWeekEntry($POST_ARRAY['projectWeekEntryId']);
        }

        // Neue Projektwoche erstellen
        if (isset($POST_ARRAY['year']) && isset($POST_ARRAY['week'])) {

            $this->projectWeek = new ProjectWeek($POST_ARRAY['year'], $POST_ARRAY['week']);
        } else {
            $this->projectWeek = new ProjectWeek();
        }

        // Phasenwechsel
        if (isset($POST_ARRAY['changePhase'])) {

            $this->changePhase($POST_ARRAY['changePhase']);
        }
    }

    /**
     * Erstellung eines neuen Projektwochen-Eintrags.
     * @param int $year
     * @param int $week
     * @param int $position
     * @param int $maxParticipants
     * @param int $eventId
     */
    private function addProjectWeekEntry($year, $week, $position, $maxParticipants, $eventId) {
        $entry = new ProjectWeekEntry(NULL);

        $entry->setYear($year);
        $entry->setWeek($week);
        $entry->setPosition($position);
        $entry->setParticipants('0');
        $entry->setMaxParticipants($maxParticipants);
        $entry->setEventId($eventId);

        $entry->save();
    }

    /**
     * Loeschen eines Projektwochen-Eintrages.
     * @param int $projectWeekEntryId
     */
    private function deleteProjectWeekEntry($projectWeekEntryId) {
        $projectWeekEntry = new ProjectWeekEntry($projectWeekEntryId);
        $projectWeekEntry->delete();
    }

    /**
     * Wechel der Phase der ausgewahlten Projektwoche.
     * @param int $newPhase
     */
    private function changePhase($newPhase) {
        $phaseManager = new PhaseManager($this->projectWeek);
        $this->changePhaseMessage = $phaseManager->changePhase($newPhase);
    }

    /**
     * Gibt den Dateinamen der Template-Datei zurueck.
     * @return string Dateiname
     */
    public function getTemplate() {
        return 'controlProjectWeeksTemplate';
    }

    /**
     * Gibt den Dateinamen der CSS-Datei zurueck.
     * @return string Dateiname
     */
    public function getStyleSheet() {
        return 'controlProjectWeeks';
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
        return 'controlProjectWeeks';
    }

    /**
     * Gibt den angemeldeten User zurueck.
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Liefert die aktuelle Projektwoche.
     * @return ProjectWeek
     */
    public function getProjectWeek() {
        return $this->projectWeek;
    }

    /**
     * Liefert eine Nachricht des Phasenwechsels.
     * @return ChangePhaseMessage
     */
    public function getChangePhaseMessage() {
        return $this->changePhaseMessage;
    }

    /**
     * Liefert alle vorhanden Veranstaltungen
     * @return array Event
     */
    public function getAllPossibleEvents() {
        return $this->allPossibleEvents;
    }
}

?>