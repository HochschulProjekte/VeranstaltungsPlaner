<?php
    include_once __DIR__.'/../class/projectWeek.php';
    include_once __DIR__.'/../class/projectWeekEntry.php';

    if (isset($_POST['add'])
        && isset($_POST['year'])
        && isset($_POST['week'])
        && isset($_POST['position'])
        && isset($_POST['maxParticipants'])
        && isset($_POST['eventId'])) {

        $entry = new ProjectWeekEntry(NULL);

        $entry->setYear($_POST['year']);
        $entry->setWeek($_POST['week']);
        $entry->setPosition($_POST['position']);
        $entry->setParticipants('0');
        $entry->setMaxParticipants($_POST['maxParticipants']);
        $entry->setEventId($_POST['eventId']);

        $entry->save();
    }

    if(isset($_POST['delete']) && isset($_POST['projectWeekEntryId'])) {

        $projectWeekEntry = new ProjectWeekEntry($_POST['projectWeekEntryId']);
        $projectWeekEntry->delete();
    }

    if(isset($_POST['year']) && isset($_POST['week'])) {

        $projectWeek = new ProjectWeek($_POST['year'], $_POST['week']);
    } else {
        $projectWeek = new ProjectWeek();
    }
?>