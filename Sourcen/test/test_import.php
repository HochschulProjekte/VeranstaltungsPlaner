<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/vstp/class/import.php';

$import = new Import('../../Dokumente/csv.csv');

var_dump($import->getValues());

?>