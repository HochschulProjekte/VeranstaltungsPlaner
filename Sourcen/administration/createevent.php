<?php

    include $_SERVER['DOCUMENT_ROOT'].'/vstp/class/personnalManager.php';

    $status = 'NONE';

    if(
        isset($_POST['myevent-name']) &&
        isset($_POST['myevent-description']) &&
        isset($_POST['myevent-date']) &&
        isset($_POST['myevent-length']) &&
        isset($_POST['myevent-participants']) &&
        isset($_POST['myevent-maxParticipants']) &&
        isset($_POST['myevent-eventManager'])
    ) {

        $name = $_POST['myevent-name'];
        $description = $_POST['myevent-description'];
        $date = $_POST['myevent-date'];
        $length = $_POST['myevent-length'];
        $participants = $_POST['myevent-participants'];
        $maxParticipants = $_POST['myevent-maxParticipants'];
        $eventManager = $_POST['myevent-eventManager'];

        $user = new PersonnalManager('Chef', 'chef@boss.de');
        
        if($user->createEvent(  $name, $description, $date, $length,
                                $participants, $maxParticipants,
                                $eventManager)) {
            $status = 'SUCCESS';
        } else {
            $status = 'ERROR';
        }
    }

?>