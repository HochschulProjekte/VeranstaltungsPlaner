<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeek.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/projectWeekEntry.php';

    if (isset($_POST['addevent'])
        && isset($_POST['year'])
        && isset($_POST['week'])
        && isset($_POST['position'])
        && isset($_POST['participants'])
        && isset($_POST['eventId'])) {

        $entry = new projectWeekEntry(
            $_POST['year'],
            $_POST['week'],
            $_POST['eventId'],
            $_POST['position'],
            0,
            $_POST['participants']
        );

        $entry->save();
    }

    if(isset($_POST['delete']) 
        && isset($_POST['eventId'])
        && isset($_POST['year']) 
        && isset($_POST['week'])
        && isset($_POST['position'])) {

        $projectWeekEntry = new ProjectWeekEntry(
            $_POST['year'], $_POST['week'],
            $_POST['eventId'], $_POST['position'],
            0, 0
        );

        $projectWeekEntry->delete();
    }

    if(isset($_POST['year']) 
        && isset($_POST['week'])) {

        $projectWeek = new ProjectWeek($_POST['year'], $_POST['week']);
    } else {
        $projectWeek = new ProjectWeek();
    }
?>