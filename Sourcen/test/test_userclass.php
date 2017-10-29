<!-- Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen -->

<?php

include_once  __DIR__ . '/../class/user.php';

$objUser = new User();
$objUser->setName('fhagengers');
$objUser->load('fhagengers');

print '<pre>';
print_r($objUser);
print '</pre>';

?>