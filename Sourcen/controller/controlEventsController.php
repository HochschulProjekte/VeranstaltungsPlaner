<?php
include_once __DIR__ . '/../class/personnalManager.php';
include_once __DIR__ . '/../class/personnalManagerCollection.php';
include_once __DIR__ . '/../class/projectWeek.php';
include_once __DIR__ . '/../class/eventCollection.php';
include_once __DIR__ . '/../class/importEvents.php';
include_once __DIR__ . '/../controller/IController.php';

/**
 * Class ControlEventsController
 *
 * Diese Klasse steuert die Logik der controlEvents.php Seite. Hierzu gehoert:
 *
 * - das Erstellen einer neuen Veranstaltung,
 * - das Bearbeiten einer vorhandenen Veranstaltung
 * - und das Loeschen einer vorhandenen Veranstaltung.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class ControlEventsController implements IController {

    private $personnalManager;
    private $personnalManagerCollection;
    private $user;

    private $status = 'NONE';
    private $message = '';

    private $events;
    private $event;

    /**
     * EventsController constructor.
     * @param $POST_ARRAY
     * @param $personnalManager
     */
    public function __construct($POST_ARRAY, $FILES, $user) {

        $this->user = $user;
        $this->checkPageAllowed();

        $this->personnalManager = new PersonnalManager($user->getName(), $user->getEmail());
        $this->personnalManagerCollection = new PersonnalManagerCollection();

        $this->event = new Event();

        $this->parsePostArray($POST_ARRAY, $FILES);
        $this->loadAllEvents();
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
     * POST Eingabe auswerten
     * @param $POST_ARRAY
     */
    private function parsePostArray($POST_ARRAY, $FILES) {

        // Excel-Datei importieren
        if (
        isset($FILES['userfile'])
        ) {
            $this->importEvents($FILES['userfile']['tmp_name']);
        }

        // Neue Veranstaltung erstellen oder vorhandene Veranstaltung anpassen
        if (
            isset($POST_ARRAY['name']) &&
            isset($POST_ARRAY['description']) &&
            isset($POST_ARRAY['length']) &&
            isset($POST_ARRAY['maxParticipants']) &&
            isset($POST_ARRAY['personnalManager'])
        ) {

            $name = $POST_ARRAY['name'];
            $description = $POST_ARRAY['description'];
            $length = $POST_ARRAY['length'];
            $maxParticipants = $POST_ARRAY['maxParticipants'];
            $personnalManager = $POST_ARRAY['personnalManager'];

            if (isset($POST_ARRAY['id'])) {
                // Event bearbeiten
                $id = $POST_ARRAY['id'];

                $this->saveEvent($id, $name, $description, $length, $maxParticipants, $personnalManager);
            } else {
                // Event erstellen
                $this->createEvent($name, $description, $length, $maxParticipants, $personnalManager);
            }
        }

        // Bearbeitung vorbereiten
        if (
            isset($POST_ARRAY['edit']) &&
            isset($POST_ARRAY['id'])
        ) {
            $this->prepareEdit($POST_ARRAY['id']);
        }

        // Event löschen
        if (
            isset($POST_ARRAY['delete']) &&
            isset($POST_ARRAY['id'])
        ) {
            $this->deleteEvent($POST_ARRAY['id']);
        }
    }

    /**
     * Importiert Veranstaltungen aus einer hochgeladenen Datei.
     * @param string $file Dateiname
     */
    private function importEvents($file) {
        $import = new ImportEvents($file);
    }

    /**
     * Speichere vorhandene Veranstaltung
     * @param int $id
     * @param string $name
     * @param string $description
     * @param int $length
     * @param int $maxParticipants
     * @param string $personnalManager Benutzername des Verantwortlichen
     */
    private function saveEvent($id, $name, $description, $length, $maxParticipants, $personnalManager) {
        $event = new Event($id);
        $event->setName($name);
        $event->setDescription($description);
        $event->setLength($length);
        $event->setMaxParticipants($maxParticipants);
        $event->setPersonnalManager($personnalManager);

        if ($event->save()) {
            $this->status = 'SUCCESS';
            $this->message = 'Die Veranstaltung "' . $name . '" wurde erfolgreich gespeichert.';
        } else {
            $this->status = 'ERROR';
            $this->message = 'Bei der Bearbeitung der Veranstaltung "' . $name . '" ist ein Fehler aufgetreten.';
        }
    }

    /**
     * Erstellt ein neue Veranstaltung
     * @param string $name
     * @param string $description
     * @param int $length Halbtage
     * @param int $maxParticipants
     * @param string $personnalManager Benutzername des Verantwortlichen
     */
    private function createEvent($name, $description, $length, $maxParticipants, $personnalManager) {

        if ($this->personnalManager->createEvent($name, $description, $length, $maxParticipants, $personnalManager)) {
            $this->status = 'SUCCESS';
            $this->message = 'Die Veranstaltung "' . $name . '" wurde erfolgreich erstellt.';
        } else {
            $this->status = 'ERROR';
            $this->message = 'Die Veranstaltung "' . $name . '" konnte nicht erstellt werden.';
        }
    }

    /**
     * Veranstaltung laden.
     * @param int $id Veranstaltungs-ID
     */
    private function prepareEdit($id) {
        $this->event = new Event($id);
    }

    /**
     * Loesche eine vorhandene Veranstaltung
     * @param int $id
     */
    private function deleteEvent($id) {
        $event = new Event($id);
        $eventName = $event->getName();

        if ($event->delete()) {
            $this->status = 'SUCCESS';
            $this->message = 'Die Veranstaltung "' . $eventName . '" wurde erfolgreich gelöscht.';
        } else {
            $this->status = 'ERROR';
            $this->message = 'Bei dem Löschen der Veranstaltung "' . $eventName . '" ist ein Fehler aufgetreten.';
        }
    }

    /**
     * Laden aller moeglichen Veranstaltungen
     */
    private function loadAllEvents() {
        $eventCollection = new EventCollection();
        $eventCollection->addAllEvents();

        $this->events = $eventCollection->getEvents();
    }

    /**
     * Gibt den Dateinamen der Template-Datei zurueck.
     * @return string Dateiname
     */
    public function getTemplate() {
        return 'controlEventsTemplate';
    }

    /**
     * Gibt den Dateinamen der CSS-Datei zurueck.
     * @return string Dateiname
     */
    public function getStyleSheet() {
        return 'controlEvents';
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
        return 'controlEvents';
    }

    /**
     * Gibt den angemeldeten User zurueck.
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Gibt den Status der vorherigen Funktion zurueck.
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Gibt eine Nachricht der vorherigen Funktion zurueck.
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Liefert ein Array mit allen vorhandenen Sachbearbeitern.
     * @return array
     */
    public function getPersonnalManagers() {
        return $this->personnalManagerCollection->getPersonnalManagers();
    }

    /**
     * Liefert ein Array mit allen Veranstaltungen.
     * @return array
     */
    public function getEvents() {
        return $this->events;
    }

    /**
     * Liefert die aktuell bearbeitende Veranstaltung zurueck.
     * @return Event
     */
    public function getEvent() {
        return $this->event;
    }
}

?>