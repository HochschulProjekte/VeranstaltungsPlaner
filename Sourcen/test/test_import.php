<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/importEvents.php';

$import = new ImportEvents('Veranstaltungen.csv');

print '<pre>';
print_r($import->getValues());
print '</pre>';

?>