<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/personnalManager.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeek.php';

    $status = 'NONE';
    $event = new Event();

    // Neues Event anlegen / Vorhandenes Event bearbeiten
    if(
        isset($_POST['myevent-name']) &&
        isset($_POST['myevent-description']) &&
        isset($_POST['myevent-length']) &&
        isset($_POST['myevent-maxParticipants']) &&
        isset($_POST['myevent-eventManager'])
    ) {

        $name = $_POST['myevent-name'];
        $description = $_POST['myevent-description'];
        $length = $_POST['myevent-length'];
        $maxParticipants = $_POST['myevent-maxParticipants'];
        $eventManager = $_POST['myevent-eventManager'];

        if(isset($_POST['myevent-id'])) {
            // Event bearbeiten
            $id = $_POST['myevent-id'];

            $event = new Event($id);
            $event->name = $name;
            $event->description = $description;
            $event->length = $length;
            $event->maxParticipants = $maxParticipants;
            $event->eventManager = $eventManager;
            
            if($event->save()) {
                $status = 'SUCCESS';
            } else {
                $status = 'ERROR';
            }
        } else {
            // Event erstellen
            $user = new PersonnalManager('Chef', 'chef@boss.de');
            
            if($user->createEvent(  $name, $description, $length,
                                    $maxParticipants, $eventManager)) {
                $status = 'SUCCESS';
            } else {
                $status = 'ERROR';
            }
        }
    }

    // Bearbeitung vorbereiten
    if(
        isset($_POST['edit']) &&
        isset($_POST['id'])
    ) {
        $eventId = $_POST['id'];
        $event = new Event($eventId);
    }

    // Event löschen
    if(
        isset($_POST['delete']) &&
        isset($_POST['id'])
    ) {
        $eventId = $_POST['id'];
        $event = new Event($eventId);
        $event->delete();
    }

?>