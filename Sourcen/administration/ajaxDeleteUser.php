<?php

/**
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */

include __DIR__ . '/../class/user.php';

if ($_POST['id']) {

    // Namen des Nutzers auslesen.
    $name = $_POST['id'];

    // Benutzer-Objekt erstellen.
    $user = new User($name);

    // Benutzer loeschen.
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

    // Kein Benutzername wurde uebergeben.
    echo json_encode(
        array(
            'err' => true,
            'msg' => 'Beim Löschen des Nutzers wurde kein Name übergeben'
        )
    );

}

?>