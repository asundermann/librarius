ALTER TABLE `books` ADD `file_epub` VARCHAR(255) NOT NULL AFTER `image`;
ALTER TABLE `books` ADD `file_epub` VARCHAR(255) NOT NULL AFTER `file_pdf`;


ALTER TABLE `books` ADD `user_published_id` INT NOT NULL AFTER `file_epub`;
ALTER TABLE `books` ADD `user_edited_id` INT NOT NULL AFTER `user_published_id`;