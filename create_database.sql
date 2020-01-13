CREATE DATABASE `blog_php_sem_framework`;

USE `blog_php_sem_framework`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `users` (`name`, `email`, `password`) VALUES
  ("Erik", "erik@erik.com", "secret"),
  ("Erik 2", "erik2@erik.com", "12345678"),
  ("Erik 3", "erik3@erik.com", "654321"),
  ("Erik 4", "erik4@erik.com", "qwe123");