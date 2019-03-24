<?php

$config = require_once __DIR__.'/../config/db.php';

$pdo = new PDO($config['dsn'], $config['username'], $config['password']);


$tables = [
	'users' => '
		CREATE TABLE IF NOT EXISTS `users` (
		  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
		  `digital_print` VARCHAR(128) NOT NULL,
		  `ip` VARCHAR(46) NOT NULL,
		  PRIMARY KEY (`id`),
		  UNIQUE INDEX `digital_print_UNIQUE` (`digital_print` ASC))
		ENGINE = InnoDB
	',
	'questionnaires' => '
		CREATE TABLE IF NOT EXISTS `questionnaires` (
		  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		  `user_id` INT(10) UNSIGNED NOT NULL,
		  PRIMARY KEY (`id`),
		  INDEX `questionnaire_user_fk_idx` (`user_id` ASC),
		  CONSTRAINT `questionnaire_user_fk`
			FOREIGN KEY (`user_id`)
			REFERENCES `users` (`id`)
			ON DELETE NO ACTION
			ON UPDATE NO ACTION)
		ENGINE = InnoDB
	',
	'fields' => '
		CREATE TABLE IF NOT EXISTS `fields` (
		  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
		  `name` VARCHAR(255) NULL,
		  `type` VARCHAR(255) NOT NULL,
		  `system` TINYINT(1) NOT NULL DEFAULT 0,
		  PRIMARY KEY (`id`),
		  UNIQUE INDEX `field_name_type_uix` (`name` ASC, `type` ASC))
		ENGINE = InnoDB
	',
	'user_fields' => '
		CREATE TABLE IF NOT EXISTS `user_fields` (
		  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		  `field_id` INT(10) UNSIGNED NOT NULL,
		  `user_id` INT(10) UNSIGNED NOT NULL,
		  PRIMARY KEY (`id`),
		  INDEX `user_fields_field_fk_idx` (`field_id` ASC),
		  INDEX `user_fields_user_fk_idx` (`user_id` ASC),
		  CONSTRAINT `user_fields_field_fk`
			FOREIGN KEY (`field_id`)
			REFERENCES `fields` (`id`)
			ON DELETE NO ACTION
			ON UPDATE NO ACTION,
		  CONSTRAINT `user_fields_user_fk`
			FOREIGN KEY (`user_id`)
			REFERENCES `users` (`id`)
			ON DELETE NO ACTION
			ON UPDATE NO ACTION)
		ENGINE = InnoDB
	',
	'questionnaire_field_values' => '
		CREATE TABLE IF NOT EXISTS `questionnaire_field_values` (
		  `id` INT(10) NOT NULL,
		  `questionnaire_id` INT(10) UNSIGNED NOT NULL,
		  `field_id` INT(10) UNSIGNED NOT NULL,
		  `value` VARCHAR(255) NOT NULL,
		  PRIMARY KEY (`id`),
		  INDEX `questionnaire_field_values_questionnaire_fk_idx` (`questionnaire_id` ASC),
		  INDEX `questionnaire_field_values_fileld_fk_idx` (`field_id` ASC),
		  CONSTRAINT `questionnaire_field_values_questionnaire_fk`
			FOREIGN KEY (`questionnaire_id`)
			REFERENCES `questionnaires` (`id`)
			ON DELETE NO ACTION
			ON UPDATE NO ACTION,
		  CONSTRAINT `questionnaire_field_values_fileld_fk`
			FOREIGN KEY (`field_id`)
			REFERENCES `fields` (`id`)
			ON DELETE NO ACTION
			ON UPDATE NO ACTION)
		ENGINE = InnoDB
	',
];

foreach ($tables as $tableName => $sql) {
	echo sprintf('Start creating %s table', $tableName) . PHP_EOL;

	echo $pdo->query($sql)
		? sprintf('Table %s has been created', $tableName) . PHP_EOL
		: sprintf('Could not create %s table', $tableName) . PHP_EOL;
}

