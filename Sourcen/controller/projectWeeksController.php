<?php

    include_once __DIR__.'/../class/projectWeek.php';
    include_once __DIR__.'/../class/projectWeekEntry.php';
    include_once __DIR__.'/../class/phaseManager.php';
    include_once __DIR__.'/../class/changePhaseMessage.php';

    /**
     * Class ProjectWeeksController
     */
    class ProjectWeeksController {

        private $projectWeek;
        private $changePhaseMessage = null;

        /**
         * ProjectWeeksController constructor.
         * @param $POST_ARRAY
         */
        public function __construct($POST_ARRAY) {
            $this->parsePostArray($POST_ARRAY);
        }

        /**
         * Parse post array and decide which method should be executed.
         * @param $POST_ARRAY
         */
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

        /**
         * Create new project week entry.
         * @param $year
         * @param $week
         * @param $position
         * @param $maxParticipants
         * @param $eventId
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
         * Delete existing project week entry.
         * @param $projectWeekEntryId
         */
        private function deleteProjectWeekEntry($projectWeekEntryId) {
            $projectWeekEntry = new ProjectWeekEntry($projectWeekEntryId);
            $projectWeekEntry->delete();
        }

        /**
         * Change phase of the current project week.
         * @param $newPhase
         */
        private function changePhase($newPhase) {
            $phaseManager = new PhaseManager($this->projectWeek);
            $this->changePhaseMessage = $phaseManager->changePhase($newPhase);
        }

        public function getProjectWeek() {
            return $this->projectWeek;
        }

        public function getChangePhaseMessage() {
            return $this->changePhaseMessage;
        }
    }
?>