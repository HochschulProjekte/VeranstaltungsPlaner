<?php

include $_SERVER['DOCUMENT_ROOT'].'/programmierprojekt/class/user.php';

if ($_POST['data']) {

    // Decode data into array
    $data = json_decode(stripslashes($_POST['data']), true);

    // Create user object and load data
    $user = new User($data['primaryKey']);
    
    // Set user data
    $user->setName($data['name']);
    $user->setPersonnalManager($data['personnalManager']);
    $user->setEmail($data['email']);

    // Update user
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

    // No data was given
    echo json_encode(
        array(
            "err" => true,
            "msg" => 'Beim Speichern des Nutzers wurden keine Daten übergeben'
        )
    );
}

?>