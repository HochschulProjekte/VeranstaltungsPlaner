<?php

/**
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */

include_once __DIR__ . '/../class/user.php';
include_once __DIR__ . '/../database/pdoDatabaseController.php';

$databaseHandler = new PDODatabaseController();
$dbUsers = $databaseHandler->select('User', NULL);

$arrUsers = array();

foreach ($dbUsers as $dbUser) {

    $objUser = new User($dbUser['name']);

    $arrUser = array(
        'name' => $objUser->getName(),
        'personnalManager' => $objUser->isPersonnalManager(),
        'email' => $objUser->getEmail()
    );

    array_push($arrUsers, $arrUser);

}

echo json_encode($arrUsers);

?>