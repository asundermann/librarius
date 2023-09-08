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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `buy_original` varchar(255) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `content` varchar(2555) NOT NULL,
  `image` varchar(255) NOT NULL,
  `file_pdf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `file_epub` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_published_id` int NOT NULL,
  `user_edited_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_published_id` (`user_published_id`),
  KEY `user_edited_id` (`user_edited_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`user_published_id`) REFERENCES `users` (`id`),
  CONSTRAINT `books_ibfk_2` FOREIGN KEY (`user_edited_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `books` (`id`, `title`, `author`, `genre`, `buy_original`, `review`, `content`, `image`, `file_pdf`, `file_epub`, `user_published_id`, `user_edited_id`) VALUES
(10,	'My book cover',	'George Brown',	'Odborná literatura',	NULL,	NULL,	'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Mauris elementum mauris vitae tortor. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Aenean id metus id velit ullamcorper pulvinar. Maecenas aliquet accumsan leo. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Aliquam erat volutpat. Curabitur vitae diam non enim vestibulum interdum. In dapibus augue non sapien. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. Duis condimentum augue id magna semper rutrum. Duis risus. Proin in tellus sit amet nibh dignissim sagittis. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>',	'e243d96361a9cf1510b5b7340c095797.jpeg',	'93184e0dafadab5015158823d6f354b7.pdf',	'a7affe1084539306e2651b69e2883aac.epub',	6,	6),
(11,	'The mind of a leader',	'Kevin Anderson',	'Odborná literatura',	NULL,	NULL,	'<p>Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Integer lacinia. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam id dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nullam feugiat, turpis at pulvinar vulputate, erat libero tristique tellus, nec bibendum odio risus sit amet ante. Aliquam erat volutpat. Aliquam ornare wisi eu metus.</p>',	'ff81a18937106cfdef004444b90f725e.jpeg',	'',	'',	6,	6),
(12,	'Lunar storm',	'Terry Crosby',	'Beletrie',	NULL,	NULL,	'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus ac leo pretium faucibus. Integer tempor. Sed ac dolor sit amet purus malesuada congue. Nam sed tellus id magna elementum tincidunt. Aliquam in lorem sit amet leo accumsan lacinia. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>',	'4bf16b0f2796a0a7c94da63fd505f411.jpeg',	'',	'',	6,	6),
(13,	'Hidden',	'Karl Winter Wray',	'Beletrie',	NULL,	NULL,	'<p>Aliquam in lorem sit amet leo accumsan lacinia. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Integer lacinia.&nbsp;</p>',	'4995a63d47ef2b52e2f3cd657d3709dc.jpeg',	'',	'',	6,	6),
(15,	'Pen&Ink Drawing',	'Alphonso Dunn',	'Odborná literatura',	NULL,	NULL,	'<p>Pen &amp; Ink Drawing: A Simple Guide covers the essential aspects of pen and ink drawing and more. It explores basic materials and instruments; fundamental properties of strokes and pen control; key elements of shading; and indispensable techniques for creating vibrant textures. As a bonus, a chapter is devoted to what the author refers to as, the secret Line of Balance. This book is not just written to instruct but also to inspire enthusiasts of pen and ink and drawing as well.</p>',	'f1d144b53a66e94e11fb3ca1e666a274.jpeg',	'',	'',	6,	6),
(27,	'Láska po španělsku',	'Elena Armas',	'Romantické',	NULL,	NULL,	'<p>Catalina opravdu zoufale potřebuje doprovod na svatbu své sestry. Zvlášť když tak trochu zalhala o tom, že má v Americe přítele. Celá rodina i známí teď čekají, až jim ho představí – včetně jejího bývalého a jeho současné snoubenky. Má jen měsíc na to, aby našla někoho, kdo bude ochotný přeletět Atlantik a krýt jí záda. Let z New Yorku do Španělska není zrovna krátký a její rodinu nebude vůbec snadné oklamat. Doprovod jí nabídne dvoumetrový modrooký Aaron Blackford, kolega z práce, který jí jinak věčně rozčiluje. Catalina se souhlasem váhá. Svatba se ale blíží a Aaron se nakonec zdá být nejlepší volbou. A co když mimo kancelář není až tak hrozný?</p>',	'0a7f162688ab6e902af0b54a2bf0e038.webp',	'470ef2049b1427c898bd3d22afdfdecc.pdf',	'e1a761f52a7e44b5262cbf58c2fdf31e.epub',	4,	4),
(35,	'Poslední přání',	'Andrzej Sapkowski',	'Fantasy',	'https://www.palmknihy.cz/kniha/zaklinac-i-posledni-prani-210075?utm_source=DK&utm_medium=web&utm_campaign=buy_palmknihy_book_GTM_direct',	'https://www.databazeknih.cz/knihy/posledni-prani-30396',	'<p>Zaklínač, ošlehaný muž bez věku, jehož bílé vlasy nejsou znakem stáří, ale mutace, kterou musel podstoupit. Placený i dobrovolný likvidátor prapodivných tvorů: mantichor, trollů, vidlohonů, strig, amfisbain – pokud ovšem ohrožují lidský rod; v takovém případě zabíjí i bytost zvanou člověk. Prvotřídní, skvělý bojovník, který není neporazitelný ani nezranitelný – naopak, téměř z každého dobrodružství si odnáší další šrámy na těle i na duši.<br>&nbsp;</p>',	'3794218bc31dcee7292675ee36d3e973.jpeg',	'b858234fdf96b6bde185171da04b3501.pdf',	'9b2e6e69e2f96ea7c60dc6ad58cacec5.epub',	6,	6),
(37,	'Meč osudu',	'Andrzej Sapkowski',	'Fantasy',	NULL,	NULL,	'<p>Zaklínač, ošlehaný muž bez věku, jehož bílé vlasy nejsou znakem stáří, ale mutace, kterou musel podstoupit. Placený i dobrovolný likvidátor prapodivných tvorů: mantichor, trollů, vidlohonů, strig, amfisbain – pokud ovšem ohrožují lidský rod; v takovém případě zabíjí i bytost zvanou člověk. Prvotřídní, skvělý bojovník, který není neporazitelný ani nezranitelný – naopak, téměř z každého dobrodružství si odnáší další šrámy na těle i na duši.<br>&nbsp;</p>',	'410e6b8e1be380f9dd201f3c977a59c2.jpeg',	'04650833ead4bb8c10f3639755bbc942.pdf',	'a167081af24062444134fcf4c66df75a.epub',	6,	6),
(38,	'Krev elfů',	'Andrzej Sapkowski',	'Fantasy',	'',	'',	'<p>Vydání třetí části ságy o Zaklínači.Meč, magie a vyzvědačké intriky.Geralt, Ciri, Yennefer, Triss Ranuncul, Yarpen Zigrin a další známí a oblíbení hrdinové ze Sapkowského povídek poprvé na stránkách románu, v němž se odehrává boj o osud světa. Zaklínač pečuje o plamen, který může zapálit celý svět.</p>',	'6c4a394b86b8d95beb051551e682f461.jpeg',	'baa6f91b49a237cbc4d3e87f8b96e1af.pdf',	'397952af6adad4876ae2bf4879e13369.epub',	6,	6),
(40,	'Spasitel',	'Frank Herbert',	'Sci-fi',	'',	'',	'<p>Druhý díl ságy Spasitel Duny nás zavádí do světa, jehož po tisíciletí zaběhaný systém se hroutí. Paul Atreides, zvaný teď převážně Muad´dib, je absolutním pánem světa – a zároveň obětí své vlastní předzvěstné schopnosti, která z něj v očích jeho poddaných udělala boha. Na Arrakis přijíždějí tisíce poutníků, aby se poklonili novému spasiteli a jeho sestře Alii. Fremenská vojska šíří vesmírem hrůzu a zkázu a ničí všechno a všechny, kdo se Paulovi postaví do cesty. Bývalé mocnosti, dnes do značné míry zbavené své moci, se ale nehodlají jen tak vzdát: Bene Gesserit, Gilda a Tleilaxané připravují tajné spiknutí proti božskému vládci – a silného spojence mají v jeho vlastní domácnosti: Paulovu manželku Irulán, dceru bývalého vládce Shaddama, která svému manželovi trpce vyčítá, že s ní nechce mít děti. Na scénu vstupuje tajná zbraň – ghola Hayt, Tleilaxany znovuoživený Duncan Idaho, který přináší svému staronovému vládci zkázu…</p>',	'723511f308d4531cff97d172f314404d.webp',	'8504ee679f3c1c84e46589699b080dc3.pdf',	'f2b6aae205d097e2eddc4d237419b54e.epub',	6,	6);

DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genre` varchar(2555) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `genres` (`id`, `genre`) VALUES
(32,	'České'),
(31,	'Cestopisy'),
(30,	'Sci-fi'),
(29,	'Young Adult'),
(28,	'Historické'),
(27,	'Beletrie'),
(26,	'Fantasy'),
(33,	'Anglické'),
(34,	'Poezie'),
(35,	'Odborná literatura'),
(36,	'Romantické');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`) VALUES
(4,	'pietrocassaman@gmail.com',	'pietros',	'$2y$10$uO7LUj2LYT8boqb9SuaVAOkfd6.o3BTYrSR/cZtlgopYmMRlPZpxC',	'librarius'),
(6,	'test@testovic.cz',	'test',	'$2y$10$GCn5kxx/wuvSdGkYkxV2Ael449LvHbR4pZdb.zk1wqkSeHike9E3y',	'admin'),
(11,	'sundermann.adam@gmail.com',	'kvek',	'$2y$10$NxGrL8dGUJkBnie08jFfmOHbZRXm9.umpACAWl925Jxt7YNyNsXIa',	'user');

-- 2023-09-08 08:38:03
