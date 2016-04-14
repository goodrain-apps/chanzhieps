CREATE TABLE IF NOT EXISTS `eps_oauth` (
  `account` varchar(30) character set utf8 NOT NULL,
  `provider` varchar(30) character set utf8 NOT NULL,
  `openID` varchar(60) character set utf8 NOT NULL,
  UNIQUE KEY `account` (`account`,`provider`,`openID`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `eps_article`  ADD `alias` varchar(100) NOT NULL AFTER `title`;
ALTER TABLE `eps_product`  ADD `alias` varchar(100) NOT NULL AFTER `name`;
ALTER TABLE `eps_category` ADD `alias` varchar(100) NOT NULL AFTER `name`;
