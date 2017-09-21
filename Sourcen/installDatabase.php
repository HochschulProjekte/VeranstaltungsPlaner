<?php

    // Datenbank eingaben einlesen
    $host = $_POST['install-hostname'];
    $db = $_POST['install-database'];
    $user = $_POST['install-username'];
    $pass = $_POST['install-password'];

    if($host != NULL && $db != NULL && $user != NULL) {
        $pdo = new PDO('mysql:host='.$host.';', $user, $pass);
        
        // Datenbank Statement vorbereiten
        $statement = $pdo->prepare("
        
            -- MySQL Script generated by MySQL Workbench
            -- Tue Sep 19 22:15:57 2017
            -- Model: New Model    Version: 1.0
            -- MySQL Workbench Forward Engineering
            
            SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
            SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
            SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
            
            -- -----------------------------------------------------
            -- Schema vstp
            -- -----------------------------------------------------
            
            -- -----------------------------------------------------
            -- Schema vstp
            -- -----------------------------------------------------
            CREATE SCHEMA IF NOT EXISTS `".$db."` DEFAULT CHARACTER SET utf8 ;
            USE `".$db."` ;
            
            -- -----------------------------------------------------
            -- Table `".$db."`.`User`
            -- -----------------------------------------------------
            CREATE TABLE IF NOT EXISTS `".$db."`.`User` (
            `name` VARCHAR(12) NOT NULL,
            `password` VARCHAR(45) NULL,
            `personnalManager` TINYINT NULL,
            `email` VARCHAR(45) NULL,
            PRIMARY KEY (`name`))
            ENGINE = InnoDB;
            
            
            -- -----------------------------------------------------
            -- Table `".$db."`.`Event`
            -- -----------------------------------------------------
            CREATE TABLE IF NOT EXISTS `".$db."`.`Event` (
            `eventId` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(45) NULL,
            `description` LONGTEXT NULL,
            `length` INT NULL,
            `maxParticipants` INT NULL,
            `eventManager` VARCHAR(12) NOT NULL,
            PRIMARY KEY (`eventId`),
            INDEX `fk_Event_User1_idx` (`eventManager` ASC),
            CONSTRAINT `fk_Event_User1`
                FOREIGN KEY (`eventManager`)
                REFERENCES `".$db."`.`User` (`name`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
            
            
            -- -----------------------------------------------------
            -- Table `".$db."`.`ProjectWeek`
            -- -----------------------------------------------------
            CREATE TABLE IF NOT EXISTS `".$db."`.`ProjectWeek` (
            `year` INT NOT NULL,
            `week` INT NOT NULL,
            `from` DATETIME NULL,
            `until` DATETIME NULL,
            PRIMARY KEY (`year`, `week`))
            ENGINE = InnoDB;
            
            
            -- -----------------------------------------------------
            -- Table `".$db."`.`ProjectWeekEntry`
            -- -----------------------------------------------------
            CREATE TABLE IF NOT EXISTS `".$db."`.`ProjectWeekEntry` (
            `eventId` INT NOT NULL,
            `year` INT NOT NULL,
            `week` INT NOT NULL,
            `position` INT NOT NULL,
            `participants` INT NOT NULL,
            `maxParticipants` INT NOT NULL,
            PRIMARY KEY (`eventId`, `year`, `week`, `position`),
            INDEX `fk_ProjectWeekEntry_Event1_idx` (`eventId` ASC),
            INDEX `fk_ProjectWeekEntry_ProjectWeek1_idx` (`year` ASC, `week` ASC),
            CONSTRAINT `fk_ProjectWeekEntry_Event1`
                FOREIGN KEY (`eventId`)
                REFERENCES `".$db."`.`Event` (`eventId`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
            CONSTRAINT `fk_ProjectWeekEntry_ProjectWeek1`
                FOREIGN KEY (`year` , `week`)
                REFERENCES `".$db."`.`ProjectWeek` (`year` , `week`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
            
            
            -- -----------------------------------------------------
            -- Table `".$db."`.`UserPerEvent`
            -- -----------------------------------------------------
            CREATE TABLE IF NOT EXISTS `".$db."`.`UserPerEvent` (
            `username` VARCHAR(12) NOT NULL,
            `priority` INT NULL DEFAULT 0,
            `registration` DATETIME NULL,
            `approved` TINYINT NULL,
            `eventId` INT NOT NULL,
            `year` INT NOT NULL,
            `week` INT NOT NULL,
            PRIMARY KEY (`username`, `eventId`, `year`, `week`),
            INDEX `fk_BenutzerProVeranstaltung_Benutzer1_idx` (`username` ASC),
            INDEX `fk_UserPerEvent_ProjectWeekEntry1_idx` (`eventId` ASC, `year` ASC, `week` ASC),
            CONSTRAINT `fk_BenutzerProVeranstaltung_Benutzer1`
                FOREIGN KEY (`username`)
                REFERENCES `".$db."`.`User` (`name`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
            CONSTRAINT `fk_UserPerEvent_ProjectWeekEntry1`
                FOREIGN KEY (`eventId` , `year` , `week`)
                REFERENCES `".$db."`.`ProjectWeekEntry` (`eventId` , `year` , `week`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
            
            
            -- -----------------------------------------------------
            -- Table `".$db."`.`Settings`
            -- -----------------------------------------------------
            CREATE TABLE IF NOT EXISTS `".$db."`.`Settings` (
            `key` VARCHAR(45) NOT NULL,
            `value` VARCHAR(45) NULL,
            PRIMARY KEY (`key`))
            ENGINE = InnoDB;
            
            CREATE USER 'Admin';
            
            GRANT ALL ON `".$db."`.* TO 'Admin';
            CREATE USER 'PersonnalManager';
            
            GRANT SELECT, INSERT, TRIGGER ON TABLE `".$db."`.* TO 'PersonnalManager';
            CREATE USER 'Employee';
            
            GRANT SELECT ON TABLE `".$db."`.* TO 'Employee';
            GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `".$db."`.* TO 'Employee';
            
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
            unlink('./installDatabase.php');

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