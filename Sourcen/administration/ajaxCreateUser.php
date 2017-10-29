<?php

/**
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */

include __DIR__ . '/../class/user.php';

if ($_POST['data']) {

    // JSON in Array umwandeln.
    $data = json_decode(stripslashes($_POST['data']), true);

    // Einen leeres User-Objekt erstellen.
    $user = new User();

    // Benutzer Daten setzen.
    $user->setName($data['name']);
    $user->setPassword($data['password']);
    $user->setPersonnalManager($data['personnalManager']);
    $user->setEmail($data['email']);

    // Benutzer erstellen.
    if ($user->create() == true) {
        echo json_encode(
            array(
                "err" => false,
                "msg" => 'Der Nutzer wurde erfolgreich angelegt'
            )
        );
    } else {
        echo json_encode(
            array(
                "err" => true,
                "msg" => 'Beim Anlegen des Users in der Datenbank ist ein Fehler aufgetreten'
            )
        );
    }

} else {

    // Keinen Daten wurden uebergeben.
    echo json_encode(
        array(
            "err" => true,
            "msg" => 'Beim Anlegen des Nutzers wurden keine Daten übergeben'
        )
    );
}

?>