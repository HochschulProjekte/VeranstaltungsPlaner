<!-- Authoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen -->

<?php

include $_SERVER['DOCUMENT_ROOT'].'/programmierprojekt/class/user.php';

$objUser = new User();
$objUser->setName('fhagengers');
$objUser->load('fhagengers');

print '<pre>';
print_r($objUser);
print '</pre>';

?>