SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `estoque` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `estoque` ;

-- -----------------------------------------------------
-- Table `estoque`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estoque`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estoque`.`categoria_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estoque`.`categoria_produto` (
  `id` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL COMMENT 'Nome da categoria do produto',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estoque`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estoque`.`produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL COMMENT 'Nome do produto',
  `descricao` TEXT NULL COMMENT 'Breve descrição sobre o produto',
  `data_cadastro` VARCHAR(45) NOT NULL COMMENT 'Data de cadastro do produto',
  `categoria_produto_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_produto_categoria_produto_idx` (`categoria_produto_id` ASC),
  CONSTRAINT `fk_produto_categoria_produto`
    FOREIGN KEY (`categoria_produto_id`)
    REFERENCES `estoque`.`categoria_produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estoque`.`estoque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estoque`.`estoque` (
  `id` INT NOT NULL,
  `quantidade` INT NOT NULL COMMENT 'Quantidade de produtos em estoque',
  `produto_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_estoque_produto1_idx` (`produto_id` ASC),
  CONSTRAINT `fk_estoque_produto1`
    FOREIGN KEY (`produto_id`)
    REFERENCES `estoque`.`produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estoque`.`movimentacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estoque`.`movimentacao` (
  `id` INT NOT NULL,
  `data_movimentacao` DATE NOT NULL COMMENT 'Data da operação',
  `quantidade` INT NOT NULL COMMENT 'Quantidade de produos em que foi movimentado',
  `tipo` INT NOT NULL COMMENT 'TIpo da movimentação\n0 - Entrada\n1 - Saida\n',
  `produto_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_movimentacao_produto1_idx` (`produto_id` ASC),
  CONSTRAINT `fk_movimentacao_produto1`
    FOREIGN KEY (`produto_id`)
    REFERENCES `estoque`.`produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
