ALTER TABLE `books` ADD `file_epub` VARCHAR(255) NOT NULL AFTER `image`;
ALTER TABLE `books` ADD `file_epub` VARCHAR(255) NOT NULL AFTER `file_pdf`;