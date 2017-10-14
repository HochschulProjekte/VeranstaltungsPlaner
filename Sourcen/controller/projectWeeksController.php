<?php
    include_once __DIR__.'/../class/projectWeek.php';
    include_once __DIR__.'/../class/projectWeekEntry.php';

    include_once __DIR__.'/../class/phaseManager.php';
    include_once __DIR__.'/../class/changePhaseMessage.php';

    class ProjectWeeksController {

        private $projectWeek;
        private $changePhaseMessage = null;

        public function __construct($POST_ARRAY) {
            $this->parsePostArray($POST_ARRAY);
        }

        private function parsePostArray($POST_ARRAY) {

            // add projectWeekEntry
            if(isset($POST_ARRAY['add'])
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

            // delete projectWeekEntry
            if(isset($POST_ARRAY['delete']) && isset($POST_ARRAY['projectWeekEntryId'])) {
                $this->deleteProjectWeekEntry($POST_ARRAY['projectWeekEntryId']);
            }

            // create projectWeek
            if(isset($POST_ARRAY['year']) && isset($POST_ARRAY['week'])) {

                $this->projectWeek = new ProjectWeek($POST_ARRAY['year'], $POST_ARRAY['week']);
            } else {
                $this->projectWeek = new ProjectWeek();
            }

            // change phase
            if(isset($POST_ARRAY['changePhase'])) {

                $this->changePhase($POST_ARRAY['changePhase']);
            }
        }

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

        private function deleteProjectWeekEntry($projectWeekEntryId) {
            $projectWeekEntry = new ProjectWeekEntry($projectWeekEntryId);
            $projectWeekEntry->delete();
        }

        private function changePhase($newPhase) {
            $phaseManager = new PhaseManager($this->projectWeek);
            $this->changePhaseMessage = $phaseManager->changePhase($newPhase);
        }

        /**
         * @return mixed
         */
        public function getProjectWeek() {
            return $this->projectWeek;
        }

        /**
         * @return null
         */
        public function getChangePhaseMessage() {
            return $this->changePhaseMessage;
        }
    }
?>