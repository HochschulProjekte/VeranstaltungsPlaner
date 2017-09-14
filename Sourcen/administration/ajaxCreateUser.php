<?php

include $_SERVER['DOCUMENT_ROOT'].'/vstp/class/user.php';

if ($_POST['data']) {

    // Decode data into array
    $data = json_decode(stripslashes($_POST['data']), true);

    // Create empty user object
    $user = new User();
    
    // Set user data
    $user->setName($data['name']);
    $user->setPassword($data['password']);
    $user->setPersonnalManager($data['personnalManager']);
    $user->setEmail($data['email']);

    // Create user
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

    // No data was given
    echo json_encode(
        array(
            "err" => true,
            "msg" => 'Beim Anlegen des Nutzers wurden keine Daten übergeben'
        )
    );
}

?>