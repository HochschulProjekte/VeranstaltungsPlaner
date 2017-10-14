<?php

    include_once __DIR__.'/../class/projectWeek.php';
    include_once __DIR__.'/../class/projectWeekEntry.php';
    include_once __DIR__.'/../class/changePhaseMessage.php';

    class PhaseManager {

        // Object variable for database handling
        private $databaseHandler;

        private $projectWeek;

        public function __construct($projectWeek) {

            $this->databaseHandler = new PDOHandler();
            $this->projectWeek = $projectWeek;
        }

        public function changePhase($newPhase) {
            if($newPhase == 2) {
                return $this->changeToPhaseTwo();
            }
        }

        private function changeToPhaseTwo() {
            $cntUsers = $this->databaseHandler->count('User', 'name', 'personnalManager = 0');
            $projectWeekEntries = $this->projectWeek->getProjectWeekEntries();

            $cntUserSpace = 0;

            for($position = 1; $position <= 10; $position++) {

                foreach($projectWeekEntries as $projectWeekEntry) {
                    if($projectWeekEntry->getPosition() == $position
                        || ($projectWeekEntry->getPosition() < $position && ($projectWeekEntry->getPosition() + $projectWeekEntry->getEvent()->length - 1) >= $position)){

                        $cntUserSpace += $projectWeekEntry->getMaxParticipants();

                    } else if($projectWeekEntry->getPosition() < $position) {
                        $projectWeekEntries = $this->unsetValue($projectWeekEntries, $projectWeekEntry);
                    }
                }

                if($cntUserSpace < $cntUsers) {
                    return new ChangePhaseMessage(false, $position, ($cntUsers - $cntUserSpace));
                }

                $cntUserSpace = 0;
            }

            $this->projectWeek->setPhase(2);
            $this->projectWeek->save();

            return new ChangePhaseMessage(true);
        }

        private function unsetValue(array $array, $value, $strict = TRUE) {
            if(($key = array_search($value, $array, $strict)) !== FALSE) {
                unset($array[$key]);
            }
            return $array;
        }
    }

?>