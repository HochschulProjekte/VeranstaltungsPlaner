<?php

    $pdo = new PDO('mysql:host=db695638739.db.1and1.com;dbname=db695638739', 'dbo695638739', 'ProgProj20!7');
    
    $statement = $pdo->prepare("
        CREATE TABLE IF NOT EXISTS `db695638739`.`Benutzer` (
        `name` VARCHAR(12) NOT NULL,
        `passwort` VARCHAR(45) NULL,
        `sachbearbeiter` TINYINT NULL,
        `email` VARCHAR(45) NULL,
        PRIMARY KEY (`name`))
        ENGINE = InnoDB;

        CREATE TABLE IF NOT EXISTS `db695638739`.`Veranstaltung` (
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

        CREATE TABLE IF NOT EXISTS `db695638739`.`BenutzerProVeranstaltung` (
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
            REFERENCES `db695638739`.`Veranstaltung` (`veranstaltungsId`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
        CONSTRAINT `fk_BenutzerProVeranstaltung_Benutzer1`
            FOREIGN KEY (`name`)
            REFERENCES `db695638739`.`Benutzer` (`name`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION)
        ENGINE = InnoDB;

        CREATE TABLE IF NOT EXISTS `db695638739`.`Systemeinstellung` (
        `key` VARCHAR(45) NOT NULL,
        `value` VARCHAR(45) NULL,
        PRIMARY KEY (`key`))
        ENGINE = InnoDB;

        CREATE USER 'Admin';

        GRANT ALL ON `db695638739`.* TO 'Admin';
        CREATE USER 'Sachbearbeiter';

        GRANT SELECT, INSERT, TRIGGER ON TABLE `db695638739`.* TO 'Sachbearbeiter';
        CREATE USER 'Mitarbeiter';

        GRANT SELECT ON TABLE `db695638739`.* TO 'Mitarbeiter';
        GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `db695638739`.* TO 'Mitarbeiter';

        SET SQL_MODE=@OLD_SQL_MODE;
        SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
        SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
    ");

    if(!$statement->execute()) {
        echo "Query fehlgeschlagen: ".$statement->error;
    }

?>