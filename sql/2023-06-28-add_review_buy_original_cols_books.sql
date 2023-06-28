ALTER TABLE `books` ADD `buy_original` VARCHAR(255) NULL DEFAULT NULL AFTER `author`;
ALTER TABLE `books` ADD `review` VARCHAR(255) NULL DEFAULT NULL AFTER `buy_original`;
