<?php

    include_once __DIR__.'/../class/projectWeek.php';
    include_once __DIR__.'/../class/projectWeekEntry.php';
    include_once __DIR__.'/../class/eventRegistration.php';
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
            } else if($newPhase == 3) {
                return $this->changeToPhaseThree();
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

        private function changeToPhaseThree() {

            // loop over every position of the projectweek
            for($position = 1; $position <= 10; $position++) {

                $users = $this->getAllUsers();
                $projectWeekEntries = $this->projectWeek->getProjectWeekEntriesAtPosition($position);

                // loop over every event of the projectweek-position
                foreach ($projectWeekEntries as $projectWeekEntry) {

                    // get all registrations of an event - sorted descending by priority
                    $registrations = $this->getRegistrationsOfProjectWeekEntry($projectWeekEntry->getId());

                    // register all participants
                    for($i = 0; $i < $projectWeekEntry->getMaxParticipants(); $i++) {

                        if(count($registrations) != 0) {

                            // remove the registered user of the user-list
                            $approvedUsername = $registrations[0]->getUsername();
                            foreach($users as $user) {
                                if($user == $approvedUsername) {
                                    $users = $this->unsetValue($users, $user);
                                    break;
                                }
                            }

                            // approve the registration
                            $registrations[0]->setApproved(1);
                            $registrations[0]->save();

                            $registrations = $this->unsetValue($registrations, $registrations[0]);

                            // increase participants count
                            $projectWeekEntry->setParticipants($projectWeekEntry->getParticipants() + 1);
                            $projectWeekEntry->save();
                        } else {
                            break;
                        }
                    }
                }

                // create and approve the registrations of the depending users
                if(count($users) != 0) {

                    $unfilledProjectWeekEntries = $this->getUnfilledProjectWeekEntriesAtPosition($this->projectWeek, $position);

                    foreach($unfilledProjectWeekEntries as $unfilledProjectWeekEntry) {
                        for($i = $unfilledProjectWeekEntry->getParticipants(); $i < $unfilledProjectWeekEntry->getMaxParticipants(); $i++) {

                            if(count($users) == 0) {
                                break;
                            }

                            // create new user registration
                            $eventRegistration = new EventRegistration();
                            $eventRegistration->setUsername($users[0]);
                            $eventRegistration->setProjectWeekEntry($unfilledProjectWeekEntry);
                            $eventRegistration->setPriority(1);
                            $eventRegistration->setApproved(1);
                            $eventRegistration->setRegistrationDate(date('Y-m-d H:i:s'));
                            $eventRegistration->save();

                            $users = $this->unsetValue($users, $users[0]);

                            // update current participants count
                            $unfilledProjectWeekEntry->setParticipants($unfilledProjectWeekEntry->getParticipants() + 1);
                            $unfilledProjectWeekEntry->save();
                        }

                        if(count($users) == 0) {
                            break;
                        }
                    }
                }
            }

            $this->projectWeek->setPhase(3);
            $this->projectWeek->save();

            return null;
        }

        private function unsetValue(array $array, $value, $strict = TRUE) {
            if(($key = array_search($value, $array, $strict)) !== FALSE) {
                unset($array[$key]);
            }

            $newArray = [];

            foreach($array as $entry) {
                array_push($newArray, $entry);
            }

            return $newArray;
        }

        private function getAllUsers() {
            $users = [];

            $where = 'personnalManager = 0';
            $result = $this->databaseHandler->select('User', $where);

            foreach($result as $user) {
                array_push($users, $user['name']);
            }

            return $users;
        }

        private function getRegistrationsOfProjectWeekEntry($projectWeekEntryId) {
            $registrations = [];
            $where = 'projectWeekEntryId = '.$projectWeekEntryId.' ORDER BY priority DESC';
            $result = $this->databaseHandler->select('EventRegistration', $where);

            foreach($result as $eventRegistration) {
                array_push($registrations, new EventRegistration($eventRegistration['eventRegistrationId']));
            }

            return $registrations;
        }

        private function getUnfilledProjectWeekEntriesAtPosition($projectWeek, $position) {
            $projecWeekEntries = [];
            $sqlString = 'SELECT * FROM ProjectWeekEntry WHERE year = '.$projectWeek->getYear().' AND week = '.$projectWeek->getWeek().' AND position = '.$position.' AND participants < maxParticipants;';

            $result = $this->databaseHandler->query($sqlString);

            foreach($result as $projectWeekEntry) {
                array_push($projecWeekEntries, new ProjectWeekEntry($projectWeekEntry['projectWeekEntryId']));
            }

            return $projecWeekEntries;
        }
    }

?>