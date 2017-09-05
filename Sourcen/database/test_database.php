<?php
    include "./databasehandler.php";

    $db = new PDOHandler();
    var_dump($db->select('benutzer', null));
?>