<?php

/**
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */

include __DIR__ . '/../class/user.php';

if ($_POST['data']) {

    // JSON in ein assoziatives Array umwandeln.
    $data = json_decode(stripslashes($_POST['data']), true);

    // Benutzer-Objekt erstellen.
    $user = new User($data['primaryKey']);

    // Benutzername setzen.
    $user->setName($data['name']);
    $user->setPersonnalManager($data['personnalManager']);
    $user->setEmail($data['email']);

    // User-Objekt updaten.
    if ($user->update() == true) {
        echo json_encode(
            array(
                "err" => false,
                "msg" => 'Die Änderungen wurden erfolgreich gespeichert'
            )
        );
    } else {
        echo json_encode(
            array(
                "err" => true,
                "msg" => 'Beim Speichern des Users in der Datenbank ist ein Fehler aufgetreten'
            )
        );
    }

} else {

    // Es wurden keine Daten uebergeben.
    echo json_encode(
        array(
            "err" => true,
            "msg" => 'Beim Speichern des Nutzers wurden keine Daten übergeben'
        )
    );
}

?>