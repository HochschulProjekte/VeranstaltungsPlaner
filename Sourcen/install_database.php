<?php

    // Datenbank eingaben einlesen
    $host = $_POST['install-hostname'];
    $db = $_POST['install-database'];
    $user = $_POST['install-username'];
    $pass = $_POST['install-password'];

    if($host != NULL && $db != NULL && $user != NULL) {
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
        
        // Datenbank Statement vorbereiten
        $statement = $pdo->prepare("
            CREATE TABLE IF NOT EXISTS `".$db."`.`Benutzer` (
            `name` VARCHAR(12) NOT NULL,
            `passwort` VARCHAR(45) NULL,
            `sachbearbeiter` TINYINT NULL,
            `email` VARCHAR(45) NULL,
            PRIMARY KEY (`name`))
            ENGINE = InnoDB;

            CREATE TABLE IF NOT EXISTS `".$db."`.`Veranstaltung` (
            `veranstaltungsId` INT NOT NULL,
            `name` VARCHAR(45) NULL,
            `beschreibung` LONGTEXT NULL,
            `start` DATETIME NULL,
            `ende` DATETIME NULL,
            `teilnehmer` INT NULL,
            `maxTeilnehmer` INT NULL,
            `projektverantwortlicher` VARCHAR(45) NULL,
            PRIMARY KEY (`veranstaltungsId`))
            ENGINE = InnoDB;

            CREATE TABLE IF NOT EXISTS `".$db."`.`BenutzerProVeranstaltung` (
            `veranstaltungsId` INT NOT NULL,
            `name` VARCHAR(12) NOT NULL,
            `prioritaet` INT NULL DEFAULT 0,
            `eintragungszeitpunkt` DATETIME NULL,
            `bestaetigt` TINYINT NULL,
            PRIMARY KEY (`veranstaltungsId`, `name`),
            INDEX `fk_BenutzerProVeranstaltung_Veranstaltung_idx` (`veranstaltungsId` ASC),
            INDEX `fk_BenutzerProVeranstaltung_Benutzer1_idx` (`name` ASC),
            CONSTRAINT `fk_BenutzerProVeranstaltung_Veranstaltung`
                FOREIGN KEY (`veranstaltungsId`)
                REFERENCES `".$db."`.`Veranstaltung` (`veranstaltungsId`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
            CONSTRAINT `fk_BenutzerProVeranstaltung_Benutzer1`
                FOREIGN KEY (`name`)
                REFERENCES `".$db."`.`Benutzer` (`name`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;

            CREATE TABLE IF NOT EXISTS `".$db."`.`Systemeinstellung` (
            `key` VARCHAR(45) NOT NULL,
            `value` VARCHAR(45) NULL,
            PRIMARY KEY (`key`))
            ENGINE = InnoDB;

            CREATE USER 'Admin';

            GRANT ALL ON `".$db."`.* TO 'Admin';
            CREATE USER 'Sachbearbeiter';

            GRANT SELECT, INSERT, TRIGGER ON TABLE `".$db."`.* TO 'Sachbearbeiter';
            CREATE USER 'Mitarbeiter';

            GRANT SELECT ON TABLE `".$db."`.* TO 'Mitarbeiter';
            GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `".$db."`.* TO 'Mitarbeiter';

            SET SQL_MODE=@OLD_SQL_MODE;
            SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
            SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
        ");

        // Datenbank Statement ausführen
        if(!$statement->execute()) {
            echo "Query fehlgeschlagen: ".$statement->error;
        } else {

            // Erstellung der DB-Informations-Dateis
            $fhandler = fopen('./database/credentials.php', 'w');
            $content = '
                <?php
                    $host = "'.$host.'";
                    $db = "'.$db.'";
                    $user = "'.$user.'";
                    $pass = "'.$pass.'";
                ?>
            ';

            // DB-Datei schliessen
            fwrite($fhandler, $content);
            fclose($fhandler);

            // Installationsdatei löschen
            unlink('./installation.php');
            unlink('./install_database.php');

            // Erfolgsmeldung ausgebens
            echo '<h1>Installation Erfolgreich</h1>';
            echo '<script>function navigateToLogin() { window.location.replace("./login.php") }</script>';
            echo '<button onclick="navigateToLogin()">Ok</button>';
        }
    } else {
        // Navigation zurück zur Installations-Seite
        header('Location: ./installation.php');
    }

?>