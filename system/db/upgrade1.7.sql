ALTER TABLE `eps_thread` CHANGE `readonly` `readonly` tinyint(1) NOT NULL DEFAULT '0' AFTER `editedDate`;
ALTER TABLE `eps_product` ADD `status` varchar(20) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'normal' AFTER `editedDate`;

CREATE TABLE IF NOT EXISTS `eps_book` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `type` enum('book','chapter','article') NOT NULL,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `path` char(255) NOT NULL DEFAULT '',
  `grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `views` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `parent` (`parent`),
  KEY `path` (`path`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
ALTER TABLE `eps_article` ADD `status` varchar(20) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'normal' AFTER `editedDate`;
ALTER TABLE `eps_relation` DROP `book`;

DROP  TABLE `eps_message`;

ALTER TABLE `eps_comment` ADD type char(20) NOT NULL AFTER id;
ALTER TABLE `eps_comment` CHANGE `author` `from` char(30) NOT NULL;
ALTER TABLE `eps_comment` ADD `to` char(30) NOT NULL AFTER `from`;
ALTER TABLE `eps_comment` ADD `phone` char(30) NOT NULL AFTER `to`;
ALTER TABLE `eps_comment` ADD  qq char(30) NOT NULL AFTER email;
ALTER TABLE `eps_comment` ADD  link varchar(100) NOT NULL AFTER content;
ALTER TABLE `eps_comment` CHANGE `status` `status` char(20) NOT NULL;
ALTER TABLE `eps_comment` ADD `public` enum('0', '1') NOT NULL default 1 AFTER `status`;
ALTER TABLE `eps_comment` ADD `readed` enum('0', '1') NOT NULL AFTER `public`;

RENAME TABLE `eps_comment` TO `eps_message`;

ALTER TABLE `eps_user` change gendar gender enum('f','m','u') NOT NULL DEFAULT 'u';
ALTER TABLE `eps_user` DROP locked;
ALTER TABLE `eps_user` CHANGE allowTime locked DATETIME NOT NULL;

UPDATE eps_config SET `value`=replace(value, 'help', 'book') WHERE owner='system' AND module='common' AND section='site' AND  `key` = 'moduleEnabled';
UPDATE eps_config SET `value`=replace(value, 'comment', 'message') WHERE owner='system' AND module='common' AND section='site' AND  `key` = 'moduleEnabled';
UPDATE eps_category SET `path`=replace(path, ',,', ',');
