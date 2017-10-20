<?php

    include_once __DIR__.'/../class/eventRegistration.php';

    /**
     * Class EventRegistrationRepresentation
     */
    class EventRegistrationRepresentation {

        private $eventRegistration;
        private $position;
        private $color;

        public function __construct($eventRegistration, $position, $color) {
            $this->eventRegistration = $eventRegistration;
            $this->position = $position;
            $this->color = $color;
        }

        public function getHTML($rowspan = false) {
            return '
                <td style="border: 3px solid #EEE;"'.($rowspan ? ' rowspan="2"' : '').'>
                    <center>
                        <div class="calender-event '.$this->color.($this->eventRegistration->getApproved() ? '' : ' not-approved').($rowspan ? ' two-rows':'').'" 
                             data-toggle="tooltip" data-placement="auto" data-html="true" 
                             title="<strong>'.$this->eventRegistration->getProjectWeekEntry()->getEvent()->name.'</strong><table><tr><td><strong>Beschreibung:</strong></td><td>'.$this->eventRegistration->getProjectWeekEntry()->getEvent()->description.'</td></tr><tr><td><strong>Teilnehmer:</strong></td><td><span>'.$this->eventRegistration->getProjectWeekEntry()->getParticipants().'</span></td></tr><tr><td><strong>Verantw.:</strong></td><td><span>'.$this->eventRegistration->getProjectWeekEntry()->getEvent()->eventManager.'</span></td></tr></table>" >
                             '.$this->eventRegistration->getProjectWeekEntry()->getEvent()->name.'
                        </div>
                    </center>
                </td>                                        
            ';
        }

        /**
         * @return mixed
         */
        public function getPosition()
        {
            return $this->position;
        }

        public function getRegistrationId() {
            return $this->eventRegistration->getId();
        }
    }

?>