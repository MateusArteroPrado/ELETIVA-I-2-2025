-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema condominio
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `condominio` DEFAULT CHARACTER SET utf8 ;
USE `condominio` ;

-- -----------------------------------------------------
-- Table `condominio`.`unidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `condominio`.`unidade` (
  `id_unidade` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  `complemento` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_unidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `condominio`.`morador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `condominio`.`morador` (
  `id_morador` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `unidade_id_unidade` INT NOT NULL,
  PRIMARY KEY (`id_morador`),
  INDEX `fk_morador_unidade_idx` (`unidade_id_unidade` ASC)  ,
  CONSTRAINT `fk_morador_unidade`
    FOREIGN KEY (`unidade_id_unidade`)
    REFERENCES `condominio`.`unidade` (`id_unidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `condominio`.`veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `condominio`.`veiculo` (
  `placa` VARCHAR(7) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `cor` VARCHAR(45) NOT NULL,
  `morador_id_morador` INT NOT NULL,
  PRIMARY KEY (`placa`),
  INDEX `fk_veiculo_morador1_idx` (`morador_id_morador` ASC)  ,
  CONSTRAINT `fk_veiculo_morador1`
    FOREIGN KEY (`morador_id_morador`)
    REFERENCES `condominio`.`morador` (`id_morador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `condominio`.`ocorrencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `condominio`.`ocorrencia` (
  `id_ocorrencia` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `descricao` TEXT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `morador_id_morador` INT NOT NULL,
  PRIMARY KEY (`id_ocorrencia`),
  INDEX `fk_ocorrencia_morador1_idx` (`morador_id_morador` ASC)  ,
  CONSTRAINT `fk_ocorrencia_morador1`
    FOREIGN KEY (`morador_id_morador`)
    REFERENCES `condominio`.`morador` (`id_morador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `condominio`.`movimentacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `condominio`.`movimentacao` (
  `id_movimentacao` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `observacao` TEXT NOT NULL,
  `morador_id_morador` INT NOT NULL,
  `veiculo_placa` VARCHAR(7),
  PRIMARY KEY (`id_movimentacao`),
  INDEX `fk_movimentacao_morador1_idx` (`morador_id_morador` ASC),
  INDEX `fk_movimentacao_veiculo1_idx` (`veiculo_placa` ASC),
  CONSTRAINT `fk_movimentacao_morador1`
    FOREIGN KEY (`morador_id_morador`)
    REFERENCES `condominio`.`morador` (`id_morador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_veiculo1`
    FOREIGN KEY (`veiculo_placa`)
    REFERENCES `condominio`.`veiculo` (`placa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `condominio`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `condominio`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `senha` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
