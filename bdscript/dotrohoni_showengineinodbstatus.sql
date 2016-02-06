-- MySQL Script generated by MySQL Workbench
-- 02/06/16 13:20:10
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema DotroHoni
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `DotroHoni` ;
CREATE SCHEMA IF NOT EXISTS `DotroHoni` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
SHOW WARNINGS;
USE `DotroHoni` ;

-- -----------------------------------------------------
-- Table `DotroHoni`.`etablissement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`etablissement` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`etablissement` (
  `idetablissement` INT NOT NULL AUTO_INCREMENT,
  `etablissementlibelle` VARCHAR(45) NOT NULL,
  `etablissementlongitude` VARCHAR(45) NOT NULL,
  `etablissementlatitude` VARCHAR(45) NOT NULL,
  `etablissementcontact1` VARCHAR(45) NOT NULL,
  `etablissementcontact2` VARCHAR(45) NULL,
  `etablissementcontacturgence` VARCHAR(45) NULL,
  `etablissementcontactlabo` VARCHAR(45) NULL,
  PRIMARY KEY (`idetablissement`))
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DotroHoni`.`type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`type` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`type` (
  `idtype` INT NOT NULL AUTO_INCREMENT,
  `typelibelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtype`))
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DotroHoni`.`service`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`service` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`service` (
  `idservice` INT NOT NULL,
  `servicelibelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idservice`))
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DotroHoni`.`assurance`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`assurance` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`assurance` (
  `idassurance` INT NOT NULL AUTO_INCREMENT,
  `assurancelibelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idassurance`))
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DotroHoni`.`pathologie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`pathologie` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`pathologie` (
  `idpathologie` INT NOT NULL,
  `pathologielibelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpathologie`))
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DotroHoni`.`rel_etab_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`rel_etab_type` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`rel_etab_type` (
  `idetablissement` INT NOT NULL,
  `idtype` INT NOT NULL,
  `note` VARCHAR(45) NULL,
  PRIMARY KEY (`idetablissement`, `idtype`),
  INDEX `fk_type_idx` (`idtype` ASC),
  CONSTRAINT `fk_etab_type`
    FOREIGN KEY (`idetablissement`)
    REFERENCES `DotroHoni`.`etablissement` (`idetablissement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_type_etab`
    FOREIGN KEY (`idtype`)
    REFERENCES `DotroHoni`.`type` (`idtype`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DotroHoni`.`rel_etab_svce`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`rel_etab_svce` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`rel_etab_svce` (
  `idetablissement` INT NOT NULL,
  `idservice` INT NOT NULL,
  `note` VARCHAR(45) NULL,
  PRIMARY KEY (`idetablissement`, `idservice`),
  INDEX `fk_svce_idx` (`idservice` ASC),
  CONSTRAINT `fk_etab_svce`
    FOREIGN KEY (`idetablissement`)
    REFERENCES `DotroHoni`.`etablissement` (`idetablissement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_svce_etab`
    FOREIGN KEY (`idservice`)
    REFERENCES `DotroHoni`.`service` (`idservice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DotroHoni`.`rel_etab_assur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`rel_etab_assur` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`rel_etab_assur` (
  `idetablissement` INT NOT NULL,
  `idassurance` INT NOT NULL,
  `pourcent` VARCHAR(45) NULL,
  PRIMARY KEY (`idetablissement`, `idassurance`),
  INDEX `fk_assur_idx` (`idassurance` ASC),
  CONSTRAINT `fk_etab_assur`
    FOREIGN KEY (`idetablissement`)
    REFERENCES `DotroHoni`.`etablissement` (`idetablissement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assur_etab`
    FOREIGN KEY (`idassurance`)
    REFERENCES `DotroHoni`.`assurance` (`idassurance`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DotroHoni`.`rel_svce_patho`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DotroHoni`.`rel_svce_patho` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DotroHoni`.`rel_svce_patho` (
  `idservice` INT NOT NULL,
  `idpathologie` INT NOT NULL,
  PRIMARY KEY (`idservice`, `idpathologie`),
  INDEX `fk_patho_idx` (`idpathologie` ASC),
  CONSTRAINT `fk_svce_patho`
    FOREIGN KEY (`idservice`)
    REFERENCES `DotroHoni`.`service` (`idservice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_patho_svce`
    FOREIGN KEY (`idpathologie`)
    REFERENCES `DotroHoni`.`pathologie` (`idpathologie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
SHOW ENGINE INNODB STATUS;

SHOW WARNINGS;
SET SQL_MODE = '';
GRANT USAGE ON *.* TO dotrohoni;
 DROP USER dotrohoni;
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
SHOW WARNINGS;
CREATE USER 'dotrohoni' IDENTIFIED BY 'dotrohoni';

GRANT ALL ON `DotroHoni`.* TO 'dotrohoni';
GRANT SELECT ON TABLE `DotroHoni`.* TO 'dotrohoni';
GRANT SELECT, INSERT, TRIGGER ON TABLE `DotroHoni`.* TO 'dotrohoni';
GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `DotroHoni`.* TO 'dotrohoni';
SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
