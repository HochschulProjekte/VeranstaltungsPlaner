<?php

include $_SERVER['DOCUMENT_ROOT'].'/vstp/class/user.php';

if ($_POST['id']) {

    // Get name
    $name = $_POST['id'];

    // Create user object and load user
    $user = new User($name);

    // Delete user
    if ($user->delete() == true) {
        echo json_encode(
            array(
                "err" => false,
                "msg" => 'Der Nutzer wurde erfolgreich gelöscht'
            )
        );
    } else {
        echo json_encode(
            array(
                "err" => true,
                "msg" => 'Beim Löschen des Users in der Datenbank ist ein Fehler aufgetreten'
            )
        );
    }

} else {

    // No data was given
    echo json_encode(
        array(
            'err' => true,
            'msg' => 'Beim Löschen des Nutzers wurde kein Name übergeben'
        )
    );

}

?>