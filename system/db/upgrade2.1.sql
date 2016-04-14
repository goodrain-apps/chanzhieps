CREATE TABLE IF NOT EXISTS `eps_wx_public` (
  `id`        smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account`   varchar(20) NOT NULL,
  `name`      varchar(60) NOT NULL,
  `appID`     char(30) NOT NULL,
  `appSecret` char(32) NOT NULL,
  `url`       varchar(100) NOT NULL,
  `token`     varchar(100) NOT NULL,
  `qrcode`    varchar(100) NOT NULL,
  `primary`   tinyint(3) NOT NULL DEFAULT 0,
  `type`      enum('subscribe', 'service') NOT NULL,
  `status`    enum('wait', 'normal') NOT NULL,
  `certified` enum('1', '0') NOT NULL DEFAULT '0',
  `addedDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `eps_wx_response` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `public` smallint(3) NOT NULL,
  `key` varchar(100) NOT NULL,
  `group` varchar(100) NOT NULL,
  `type` enum('text','news','link') NOT NULL DEFAULT 'text',
  `source` varchar(100) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`public`,`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `eps_wx_message` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `public` smallint(3) NOT NULL,
  `wid` char(64) NOT NULL,
  `to` varchar(50) NOT NULL,
  `from` varchar(50) NOT NULL,
  `response` mediumint(8) unsigned NOT NULL,
  `content` text NOT NULL,
  `type` char(30) NOT NULL,
  `replied` tinyint(3) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `eps_user` ADD `public` smallint(30) NOT NULL DEFAULT '0';
