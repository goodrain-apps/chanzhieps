CREATE TABLE IF NOT EXISTS `eps_group` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` char(30) NOT NULL,
  `role` char(30) NOT NULL default '',
  `desc` char(255) NOT NULL default '',
  `lang` char(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `eps_grouppriv` (
  `group` mediumint(8) unsigned NOT NULL default '0', 
  `module` char(30) NOT NULL default '',
  `method` char(30) NOT NULL default '',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `group` (`group`,`module`,`method`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `eps_usergroup` (
  `account` char(30) NOT NULL default '',
  `group` mediumint(8) unsigned NOT NULL default '0',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `account` (`account`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `eps_category` CHANGE `name` `name` varchar(100) NOT NULL;

CREATE TABLE IF NOT EXISTS `eps_log` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `account` char(30) NOT NULL,
  `browser` char(100) NOT NULL,
  `fingerprint` char(100) NOT NULL,
  `ip` char(30) NOT NULL,
  `position` char(100) NOT NULL,
  `date` datetime NOT NULL,
  `desc` text NOT NULL,
  `ext` text NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'adminlogin',
  `lang` char(30) NOT NULL DEFAULT 'all',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `eps_search_index` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `objectType` char(20) NOT NULL,
  `objectID` mediumint(9) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `params` text NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `status` char(30) NOT NULL DEFAULT 'normal',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `object` (`objectType`,`objectID`),
  KEY `lang` (`lang`),
  KEY `addedDate` (`addedDate`),
  FULLTEXT KEY `content` (`title`,`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `eps_search_dict` (
  `key` smallint(5) unsigned NOT NULL,
  `value` char(3) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `eps_user` ADD `realnames` varchar(100) NOT NULL default '';
ALTER TABLE `eps_thread` ADD `color` char(10) NOT NULL AFTER `title`;

-- DROP TABLE IF EXISTS `eps_order`;
CREATE TABLE IF NOT EXISTS `eps_order` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `payment` char(30) NOT NULL,
  `sn` char(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `paidDate` datetime NOT NULL,
  `payStatus` enum('not_paid', 'paid') NOT NULL DEFAULT 'not_paid',
  `deliveriedDate` datetime NOT NULL,
  `deliveriedBy` char(30) NOT NULL,
  `deliveryStatus` enum('not_send', 'send', 'confirmed') NOT NULL DEFAULT 'not_send',
  `express` smallint(5) unsigned NOT NULL DEFAULT '0',
  `waybill` char(30) NOT NULL,
  `confirmedDate` datetime NOT NULL,
  `finishedDate` datetime NOT NULL,
  `finishedBy` char(30) NOT NULL,
  `status` enum('normal', 'canceled', 'finished') NOT NULL DEFAULT 'normal',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`),
  KEY `status` (`status`),
  KEY `createdDate` (`createdDate`),
  KEY `deliveriedDate` (`deliveriedDate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `eps_orderProduct` (
  `id`          mediumint(9) NOT NULL AUTO_INCREMENT,
  `orderID`     mediumint(9) UNSIGNED NOT NULL default 0, 
  `productID`   mediumint(8) UNSIGNED Not null default 0,
  `productName` varchar(150) NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `count` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderID` (`orderID`),
  KEY `productID` (`productID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `eps_cart` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `product` mediumint(8) UNSIGNED Not null default 0,
  `count` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `eps_address` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` char(20) NOT NULL,
  `zipcode` char(6) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
