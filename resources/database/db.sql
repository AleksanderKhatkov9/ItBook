create database bookIt;
drop database bookIt;

CREATE TABLE bookIt.book (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `date` VARCHAR(45) NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE bookIt.author (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `fio` VARCHAR(255) NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `token` VARCHAR(100) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `rules` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `rules_user` VARCHAR(45) NOT NULL,
  `rules_code` VARCHAR(45) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `user_rules` (
    `user_id` INT,
    `rules_id` INT,
    FOREIGN KEY (user_id)  REFERENCES user (id),
    FOREIGN KEY (ruls_id)  REFERENCES ruls (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `bookit`.`user_ruls`
CHANGE COLUMN `user_id` `user_id` INT(11) NOT NULL ,
CHANGE COLUMN `ruls_id` `ruls_id` INT(11) NOT NULL ,
ADD PRIMARY KEY (`user_id`, `ruls_id`);


CREATE TABLE `book_author` (
  `id_book` INT,
  `id_author` INT,
    FOREIGN KEY (id_book)  REFERENCES book (id),
    FOREIGN KEY (id_author)  REFERENCES author (id),
    CONSTRAINT book_author PRIMARY KEY (id_book, id_author)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;











