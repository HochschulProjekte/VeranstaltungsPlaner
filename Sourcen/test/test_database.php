<!-- Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen -->

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/vstp/database/pdoDatabaseController.php";

$db = new PDOHandlerI();

/*     
    // Insert
    $values = [
        new ColumnItem('name', 'test3'),
        new ColumnItem('passwort', 'test3'),
        new ColumnItem('sachbearbeiter', '1'),
        new ColumnItem('email', 'test3@test.de')
    ];

    $db->insert('Benutzer', $values); 
 */

/*     
    // Update
    $values = [
        new ColumnItem('name', 'test5')
    ];

    $db->update('Benutzer', $values, 'name = "test3"'); 
 */

/* 
    // Delete
    $db->delete('Benutzer', 'name = "test5"');
 */
var_dump($db->select('Benutzer', null));

?>