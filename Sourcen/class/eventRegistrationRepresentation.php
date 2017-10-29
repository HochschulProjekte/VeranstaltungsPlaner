<?php

include_once __DIR__ . '/../class/eventRegistration.php';

/**
 * Class EventRegistrationRepresentation
 *
 * Darstellung einer Veranstaltungsregistrierung fuer den Kalender.
 *
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */
class EventRegistrationRepresentation {

    private $eventRegistration;
    private $position;
    private $color;

    /**
     * EventRegistrationRepresentation constructor.
     * @param EventRegistration $eventRegistration Objekt
     * @param int $position Position der Veranstaltung
     * @param string $color CSS-Klassennamen
     */
    public function __construct($eventRegistration, $position, $color) {
        $this->eventRegistration = $eventRegistration;
        $this->position = $position;
        $this->color = $color;
    }

    /**
     * Liefert einen HTML-String der Veranstaltungsregistrierung in der <td>-Darstellung
     * @param bool $rowspan
     * @return string HTML-String
     */
    public function getHTML($rowspan = false) {
        return '
                <td style="border: 3px solid #EEE;"' . ($rowspan ? ' rowspan="2"' : '') . '>
                    <center>
                        <div class="calender-event ' . $this->color . ($this->eventRegistration->isApproved() ? '' : ' not-approved') . ($rowspan ? ' two-rows' : '') . '" 
                             data-toggle="tooltip" data-placement="auto" data-html="true" 
                             title="<strong>' . $this->eventRegistration->getProjectWeekEntry()->getEvent()->getName() . '</strong><table><tr><td><strong>Beschreibung:</strong></td><td>' . $this->eventRegistration->getProjectWeekEntry()->getEvent()->getDescription() . '</td></tr><tr><td><strong>Teilnehmer:</strong></td><td><span>' . $this->eventRegistration->getProjectWeekEntry()->getParticipants() . '</span></td></tr><tr><td><strong>Verantw.:</strong></td><td><span>' . $this->eventRegistration->getProjectWeekEntry()->getEvent()->getPersonnalManager() . '</span></td></tr></table>" >
                             ' . $this->eventRegistration->getProjectWeekEntry()->getEvent()->getName() . '
                        </div>
                    </center>
                </td>                                        
            ';
    }

    /**
     * Liefert die Position des Events in der Projektwoche
     * @return int position
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Liefert die ID der Registrierung
     * @return int registrationId
     */
    public function getRegistrationId() {
        return $this->eventRegistration->getId();
    }

    /**
     * Ist die Veranstaltungs-Registrierung bestaetigt?
     * @return boolean zugewiesen = true; nicht zugewiesen = false
     */
    public function isApproved() {
        return $this->eventRegistration->isApproved();
    }
}

?>