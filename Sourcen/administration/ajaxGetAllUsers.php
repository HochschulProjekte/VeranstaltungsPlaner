<?php

include __DIR__.'/../class/user.php';

/**
 * @author Matthias Fischer, Fabian Hagengers, Jonathan Hermsen
 */

$databaseHandler = new PDOHandler();
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