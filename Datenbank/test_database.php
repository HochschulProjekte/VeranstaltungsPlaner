<?php
    $pdo = new PDO('mysql:host=db695638739.db.1and1.com;dbname=db695638739', 'dbo695638739', 'ProgProj20!7');
    
    $statement = $pdo->prepare('SHOW TABLES;');
    $statement->execute();

    $tables = $statement->fetchAll(PDO::FETCH_NUM);

    var_dump($tables);
?>