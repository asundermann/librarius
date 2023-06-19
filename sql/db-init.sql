-- Adminer 4.8.1 MySQL 8.0.29 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `librarius` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `librarius`;

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `perex` varchar(255) NOT NULL,
  `content` varchar(2555) NOT NULL,
  `date_publish` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `articles` (`id`, `title`, `perex`, `content`, `date_publish`, `date_created`) VALUES
(49,	'aerae',	'fggdf',	'<p>cbvncvncv</p>',	'2023-05-05 00:00:00',	'2023-05-16 12:07:37'),
(50,	'hafahahfsadas',	'safasfgcxb',	'<p>dhdfhnvb</p>',	'2023-05-18 00:00:00',	'2023-05-16 12:09:20'),
(43,	'as ovníksdgfdsgs',	'adfgiji',	'<p>sjgkj kjkewj oujewkjkwej &nbsp;eraedfgdf</p>',	'2023-05-19 00:00:00',	'2023-05-16 11:54:44'),
(45,	'Brtník',	'adfgiji',	'<p>sjgkj kjkewj oujewkjkwej &nbsp;erae</p>',	'2023-05-17 00:00:00',	'2023-05-16 11:55:44'),
(46,	'Brtník',	'adfgiji',	'<p>sjgkj kjkewj oujewkjkwej &nbsp;erae</p>',	'2023-05-17 00:00:00',	'2023-05-16 11:56:57'),
(47,	'Mydlinka',	'adfgiji',	'<p>fgdfgd</p>',	'2023-05-17 00:00:00',	'2023-05-16 11:57:13'),
(39,	'Tavený sýr Liptovníksd',	'adfgiji',	'<p>sjgkj kjkewj oujewkjkwej &nbsp;erae</p>',	'2023-05-18 00:00:00',	'2023-05-16 11:01:10'),
(40,	'Tavený sýr Liptovníksd',	'adfgiji',	'<p>sjgkj kjkewj oujewkjkwej &nbsp;erae</p>',	'2023-05-11 00:00:00',	'2023-05-16 11:32:10'),
(41,	'asfas',	'fvbcvb',	'<p>bcvbcvb</p>',	'2023-05-18 00:00:00',	'2023-05-16 11:36:58'),
(42,	'as ovníksdgfdsgs',	'adfgiji',	'<p>sjgkj kjkewj oujewkjkwej &nbsp;erae</p>',	'2023-05-17 00:00:00',	'2023-05-16 11:53:29'),
(37,	'Tavený sýr Liptovníček',	'adfgiji',	'<p>sjgkj kjkewj oujewkjkwej &nbsp;erae</p>',	'2023-05-18 00:00:00',	'2023-05-16 10:59:48'),
(36,	'Spišské párky',	'Mám rád uzené párky',	'<p>Jedinečné a nezapomenutelné, tak bych popsal dokonalost spišských párků.</p>',	'2023-05-18 00:00:00',	'2023-05-16 10:55:37');

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` varchar(2555) NOT NULL,
  `image` varchar(255) NOT NULL,
  `file_pdf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_epub` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `books` (`id`, `title`, `author`, `content`, `image`, `file_pdf`, `file_epub`) VALUES
(12,	'Lunar storm',	'Terry Crosby',	'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus ac leo pretium faucibus. Integer tempor. Sed ac dolor sit amet purus malesuada congue. Nam sed tellus id magna elementum tincidunt. Aliquam in lorem sit amet leo accumsan lacinia. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>',	'4bf16b0f2796a0a7c94da63fd505f411.jpeg',	'',	''),
(11,	'The mind of a leader',	'Kevin Anderson',	'<p>Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Integer lacinia. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam id dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nullam feugiat, turpis at pulvinar vulputate, erat libero tristique tellus, nec bibendum odio risus sit amet ante. Aliquam erat volutpat. Aliquam ornare wisi eu metus.</p>',	'ff81a18937106cfdef004444b90f725e.jpeg',	'',	''),
(10,	'My book cover',	'George Brown',	'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Mauris elementum mauris vitae tortor. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Aenean id metus id velit ullamcorper pulvinar. Maecenas aliquet accumsan leo. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Aliquam erat volutpat. Curabitur vitae diam non enim vestibulum interdum. In dapibus augue non sapien. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. Duis condimentum augue id magna semper rutrum. Duis risus. Proin in tellus sit amet nibh dignissim sagittis. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>',	'e243d96361a9cf1510b5b7340c095797.jpeg',	'93184e0dafadab5015158823d6f354b7.pdf',	'a7affe1084539306e2651b69e2883aac.epub'),
(13,	'Hidden',	'Karl Winter Wray',	'<p>Aliquam in lorem sit amet leo accumsan lacinia. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Integer lacinia.&nbsp;</p>',	'4995a63d47ef2b52e2f3cd657d3709dc.jpeg',	'',	''),
(15,	'Pen&Ink Drawing',	'Alphonso Dunn',	'<p>Pen &amp; Ink Drawing: A Simple Guide covers the essential aspects of pen and ink drawing and more. It explores basic materials and instruments; fundamental properties of strokes and pen control; key elements of shading; and indispensable techniques for creating vibrant textures. As a bonus, a chapter is devoted to what the author refers to as, the secret Line of Balance. This book is not just written to instruct but also to inspire enthusiasts of pen and ink and drawing as well.</p>',	'f1d144b53a66e94e11fb3ca1e666a274.jpeg',	'',	'');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`) VALUES
(6,	'test@testovic.cz',	'test',	'$2y$10$GCn5kxx/wuvSdGkYkxV2Ael449LvHbR4pZdb.zk1wqkSeHike9E3y',	'admin'),
-- 2023-06-19 09:36:44
