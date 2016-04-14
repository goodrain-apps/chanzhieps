-- DROP TABLE IF EXISTS `eps_article`;
CREATE TABLE IF NOT EXISTS `eps_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `source` enum('original','copied','translational','article') NOT NULL,
  `copySite` varchar(60) NOT NULL,
  `copyURL` varchar(255) NOT NULL,
  `author` varchar(60) NOT NULL,
  `addedBy` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'normal',
  `type` varchar(30) NOT NULL,
  `submittion` enum('0', '1', '2', '3') NOT NULL DEFAULT '0',
  `views` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `sticky` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL,
  `link` varchar(255) NOT NULL,
  `css` text NOT NULL,
  `js` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `lang` (`lang`),
  KEY `views` (`views`),
  KEY `sticky` (`sticky`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_block`;
CREATE TABLE IF NOT EXISTS `eps_block` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `originID` smallint(5) unsigned NOT NULL,
  `template` varchar(30) NOT NULL DEFAULT 'default',
  `type` varchar(20) NOT NULL,
  `title` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_slide`;
CREATE TABLE IF NOT EXISTS `eps_slide` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group` smallint(5) unsigned NOT NULL,
  `title` varchar(60) NOT NULL,
  `titleColor` char(10) NOT NULL,
  `mainLink` varchar(255) NOT NULL,
  `target` enum('0', '1') NOT NULL DEFAULT '0',
  `backgroundType` char(20) NOT NULL,
  `backgroundColor` char(10) NOT NULL,
  `height` smallint(5) unsigned NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL,
  `label` varchar(255) NOT NULL,
  `buttonClass` varchar(255) NOT NULL,
  `buttonUrl` varchar(255) NOT NULL,
  `buttonTarget` varchar(30) NOT NULL,
  `summary` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_book`;
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
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `order` (`order`),
  KEY `parent` (`parent`),
  KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_category`;
CREATE TABLE IF NOT EXISTS `eps_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `abbr` varchar(60) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `path` char(255) NOT NULL DEFAULT '',
  `grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` char(30) NOT NULL,
  `readonly` enum('0','1') NOT NULL DEFAULT '0',
  `moderators` varchar(255) NOT NULL,
  `threads` smallint(5) NOT NULL,
  `posts` smallint(5) NOT NULL,
  `postedBy` varchar(30) NOT NULL,
  `postedDate` datetime NOT NULL,
  `postID` mediumint(9) NOT NULL,
  `replyID` mediumint(8) unsigned NOT NULL,
  `link` varchar(255) NOT NULL,
  `unsaleable` enum('0', '1') NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `tree` (`type`),
  KEY `order` (`order`),
  KEY `parent` (`parent`),
  KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_config`;
CREATE TABLE IF NOT EXISTS `eps_config` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` char(30) NOT NULL DEFAULT '',
  `module` varchar(30) NOT NULL,
  `section` char(30) NOT NULL DEFAULT '',
  `key` char(30) DEFAULT NULL,
  `value` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `unique` (`owner`,`module`,`section`,`key`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_package`;
CREATE TABLE IF NOT EXISTS `eps_package` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `code` varchar(30) NOT NULL,
  `version` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `license` text NOT NULL,
  `type` varchar(20) NOT NULL default 'extension',
  `site` varchar(150) NOT NULL,
  `chanzhiCompatible` varchar(100) NOT NULL,
  `templateCompatible` varchar(100) NOT NULL,
  `installedTime` datetime NOT NULL,
  `depends` varchar(100) NOT NULL,
  `dirs` text NOT NULL,
  `files` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `code` (`code`),
  KEY `name` (`name`),
  KEY `addedTime` (`installedTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_down`;
CREATE TABLE IF NOT EXISTS `eps_down` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account` char(30) DEFAULT NULL,
  `file` mediumint(5) DEFAULT NULL,
  `ip` char(15) NOT NULL,
  `time` datetime NOT NULL,
  `referer` varchar(200) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `fileID` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_file`;
CREATE TABLE IF NOT EXISTS `eps_file` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pathname` char(200) NOT NULL,
  `title` char(90) NOT NULL,
  `extension` char(30) NOT NULL,
  `size` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `width` smallint(5) unsigned NOT NULL DEFAULT '0',
  `height` smallint(5) unsigned NOT NULL DEFAULT '0',
  `objectType` char(20) NOT NULL,
  `objectID` char(50) NOT NULL,
  `addedBy` char(30) NOT NULL DEFAULT '',
  `addedDate` datetime NOT NULL,
  `public` enum('1','0') NOT NULL DEFAULT '1',
  `score` smallint unsigned NOT NULL DEFAULT 0,
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extra` varchar(255) NOT NULL,
  `primary` enum('1','0') DEFAULT '0',
  `editor` enum('1','0') NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `object` (`objectType`,`objectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_group`;
CREATE TABLE IF NOT EXISTS `eps_group` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` char(30) NOT NULL,
  `role` char(30) NOT NULL default '',
  `desc` char(255) NOT NULL default '',
  `lang` char(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_grouppriv`;
CREATE TABLE IF NOT EXISTS `eps_grouppriv` (
  `group` mediumint(8) unsigned NOT NULL default '0', 
  `module` char(30) NOT NULL default '',
  `method` char(30) NOT NULL default '',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `group` (`group`,`module`,`method`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_layout`;
CREATE TABLE IF NOT EXISTS `eps_layout` (
  `template` varchar(30) NOT NULL DEFAULT 'default',
  `plan` char(30) NOT NULL DEFAULT 'default',
  `page` varchar(30) NOT NULL,
  `region` varchar(30) NOT NULL,
  `blocks` text NOT NULL,
  `import` enum('no', 'doing', 'finished') NOT NULL DEFAULT 'no',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `layout` (`template`,`plan`,`page`,`region`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_message`;
CREATE TABLE IF NOT EXISTS `eps_message` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(20) NOT NULL,
  `objectType` varchar(30) NOT NULL DEFAULT '',
  `objectID` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `account` char(30) DEFAULT NULL,
  `from` char(30) NOT NULL,
  `to` char(30) NOT NULL,
  `phone` char(30) NOT NULL,
  `email` varchar(90) NOT NULL,
  `qq` char(30) NOT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `status` char(20) NOT NULL,
  `public` enum('0','1') NOT NULL DEFAULT '1',
  `readed` enum('0','1') NOT NULL,
  `receiveEmail` enum('0','1') NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `status` (`status`),
  KEY `object` (`objectType`,`objectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_oauth`;
CREATE TABLE IF NOT EXISTS `eps_oauth` (
  `account` varchar(30) NOT NULL,
  `provider` varchar(30) NOT NULL,
  `openID` varchar(60) NOT NULL,
  `lang` char(30) NOT NULL,
  UNIQUE KEY `account` (`account`,`provider`,`openID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_product`;
CREATE TABLE IF NOT EXISTS `eps_product` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `unsaleable` enum('0', '1') NOT NULL DEFAULT '0',
  `mall` text NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `model` char(30) DEFAULT NULL,
  `color` char(20) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `unit` char(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `promotion` decimal(10,2) NOT NULL,
  `amount` mediumint(8) unsigned DEFAULT NULL,
  `keywords` varchar(150) NOT NULL,
  `desc` text NOT NULL,
  `content` text NOT NULL,
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'normal',
  `views` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `sticky` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL,
  `css` text NOT NULL,
  `js` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `order` (`order`),
  KEY `views` (`views`),
  KEY `sticky` (`sticky`),
  KEY `model` (`model`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_relation`;
CREATE TABLE IF NOT EXISTS `eps_relation` (
  `type` char(20) NOT NULL,
  `id` mediumint(9) NOT NULL,
  `category` smallint(5) NOT NULL,
  `lang` char(30) NOT NULL,
  UNIQUE KEY `relation` (`type`,`id`,`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_reply`;
CREATE TABLE IF NOT EXISTS `eps_reply` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `thread` mediumint(8) unsigned NOT NULL,
  `content` text NOT NULL,
  `author` char(30) NOT NULL,
  `editor` char(30) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `thread` (`thread`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_product_custom`;
CREATE TABLE IF NOT EXISTS `eps_product_custom` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `label` varchar(100) NOT NULL,
  `value` varchar(200) NOT NULL,
  `order` smallint(5) unsigned NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `label` (`product`,`label`),
  KEY `product` (`product`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statvisitor`;
CREATE TABLE IF NOT EXISTS `eps_statvisitor`(
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `osName` varchar(100) NOT NULL,
  `osVersion` varchar(100) NOT NULL,
  `browserName` varchar(100) NOT NULL,
  `browserVersion` varchar(100) NOT NULL,
  `browserLanguage` varchar(100) NOT NULL,
  `device` varchar(100) NOT NULL,
  `resolution` varchar(100) NOT NULL,
  `createdTime` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `osName` (`osName`),
  KEY `browsername` (`browserName`),
  KEY `device` (`device`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statreferer`;
CREATE TABLE IF NOT EXISTS `eps_statreferer`(
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `domain` varchar(200) NOT NULL,
  `searchEngine` char(30) NOT NULL,
  `keywords` char(100) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`(300)),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statlog`;
CREATE TABLE IF NOT EXISTS `eps_statlog`(
  `id` int(9) unsigned NOT NULL auto_increment,
  `referer` int(8) NOT NULL,
  `domain` varchar(200) NOT NULL,
  `url` text NOT NULL,
  `link` text NOT NULL,
  `searchEngine` varchar(100) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `visitor` int(8) NOT NULL,
  `osName` varchar(100) NOT NULL,
  `browserName` varchar(100) NOT NULL,
  `browserVersion` varchar(100) NOT NULL,
  `ip` char(15) NOT NULL,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `account` char(30) NOT NULL,
  `year` char(4) NOT NULL,
  `month` char(6) NOT NULL,
  `day` char(8) NOT NULL,
  `hour` char(10) NOT NULL DEFAULT '0',
  `new` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `mobile` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `referer` (`referer`),
  KEY `searchEngine` (`searchEngine`),
  KEY `keywords` (`keywords`),
  KEY `time` (`year`, `month`, `day`, `hour`),
  KEY `location` (`country`, `province`, `city`),
  KEY `mobile` (`mobile`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statreport`;
CREATE TABLE IF NOT EXISTS `eps_statreport`(
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(30) NOT NULL,
  `item` char(100) NOT NULL DEFAULT '0',
  `extra` text NOT NULL,
  `timeType` enum('year','month','day','hour') NOT NULL DEFAULT 'hour',
  `timeValue` char(10) NOT NULL DEFAULT '0',
  `pv` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `uv` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `ip` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`timeType`,`timeValue`),
  KEY `type` (`type`,`item`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statregion`;
CREATE TABLE IF NOT EXISTS `eps_statregion`(
  `id` int(9) unsigned NOT NULL auto_increment,
  `timeType` enum('year', 'month', 'day', 'hour') NOT NULL default 'hour',
  `timeValue` char(10) NOT NULL default 0,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pv` mediumint(9) unsigned NOT NULL default 0,
  `uv` mediumint(9) unsigned NOT NULL default 0,
  `ip` mediumint(9) unsigned NOT NULL default 0,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `region` (`country`, `province`, `city`),
  KEY `time` (`timeType`, `timeValue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_tag`;
CREATE TABLE IF NOT EXISTS `eps_tag` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `tag` (`tag`),
  KEY `rank` (`rank`),
  KEY `link` (`link`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_thread`;
CREATE TABLE IF NOT EXISTS `eps_thread` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `board` mediumint(9) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` char(10) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `views` smallint(5) unsigned NOT NULL DEFAULT '0',
  `stick` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `replies` smallint(6) NOT NULL,
  `repliedBy` varchar(30) NOT NULL,
  `repliedDate` datetime NOT NULL,
  `replyID` mediumint(8) unsigned NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL,
  `lang` char(30) NOT NULL,
  `status` char(10) NOT NULL,
  `ip` char(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `category` (`board`),
  KEY `stick` (`stick`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_user`;
CREATE TABLE IF NOT EXISTS `eps_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `realname` char(30) NOT NULL DEFAULT '',
  `realnames` varchar(100) NOT NULL DEFAULT '',
  `nickname` char(60) NOT NULL DEFAULT '',
  `admin` enum('no','common','super') NOT NULL DEFAULT 'no',
  `avatar` char(30) NOT NULL DEFAULT '',
  `birthday` date NOT NULL,
  `gender` enum('f','m','u') NOT NULL DEFAULT 'u',
  `email` char(90) NOT NULL DEFAULT '',
  `skype` char(90) NOT NULL,
  `qq` char(20) NOT NULL DEFAULT '',
  `yahoo` char(90) NOT NULL DEFAULT '',
  `gtalk` char(90) NOT NULL DEFAULT '',
  `wangwang` char(90) NOT NULL DEFAULT '',
  `site` varchar(100) NOT NULL,
  `mobile` char(11) NOT NULL DEFAULT '',
  `phone` char(20) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL,
  `address` char(120) NOT NULL DEFAULT '',
  `zipcode` char(10) NOT NULL DEFAULT '',
  `visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `last` datetime NOT NULL,
  `score` mediumint NOT NULL,
  `rank` mediumint NOT NULL,
  `maxLogin` tinyint(4) NOT NULL DEFAULT '10',
  `fails` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `referer` varchar(255) NOT NULL,
  `join` datetime NOT NULL,
  `reset` char(64) NOT NULL,
  `locked` datetime NOT NULL,
  `public` varchar(30) NOT NULL DEFAULT '0',
  `emailCertified` enum('0', '1') NOT NULL DEFAULT '0',
  `security` text,
  `os` char(30) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `admin` (`admin`),
  KEY `account` (`account`,`password`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_usergroup`;
CREATE TABLE IF NOT EXISTS `eps_usergroup` (
  `account` char(30) NOT NULL default '',
  `group` mediumint(8) unsigned NOT NULL default '0',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `account` (`account`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_log`;
CREATE TABLE IF NOT EXISTS `eps_log` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `account` char(30) NOT NULL,
  `browser` char(100) NOT NULL,
  `ip` char(30) NOT NULL,
  `location` char(100) NOT NULL,
  `date` datetime NOT NULL,
  `desc` text NOT NULL,
  `ext` text NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'adminlogin',
  `lang` char(30) NOT NULL DEFAULT 'all',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_wx_public`;
CREATE TABLE IF NOT EXISTS `eps_wx_public` (
  `id`        smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account`   varchar(30) NOT NULL,
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
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_wx_response`;
CREATE TABLE IF NOT EXISTS `eps_wx_response` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `public` smallint(3) NOT NULL,
  `key` varchar(100) NOT NULL,
  `group` varchar(100) NOT NULL,
  `type` enum('text','news','link') NOT NULL DEFAULT 'text',
  `source` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `key` (`public`,`key`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_wx_message`;
CREATE TABLE IF NOT EXISTS `eps_wx_message` (
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
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_score`;
CREATE TABLE IF NOT EXISTS `eps_score` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(30) NOT NULL,
  `method` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `count` smallint(5) unsigned NOT NULL,
  `before` mediumint(5) NOT NULL,
  `after` mediumint(5) NOT NULL,
  `objectType` varchar(30) NOT NULL,
  `objectID` mediumint(9) NOT NULL,
  `actor` varchar(30) NOT NULL,
  `note` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`),
  KEY `method` (`method`),
  KEY `objectType` (`objectType`),
  KEY `objectID` (`objectID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_search_index`;
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

-- DROP TABLE IF EXISTS `eps_search_dict`;
CREATE TABLE IF NOT EXISTS `eps_search_dict` (
  `key` smallint(5) unsigned NOT NULL,
  `value` char(3) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_order`;
CREATE TABLE IF NOT EXISTS `eps_order` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment` char(30) NOT NULL,
  `sn` char(50) NOT NULL,
  `address` text NOT NULL,
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
  `type` varchar(30) NOT NULL default 'shop',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`),
  KEY `status` (`status`),
  KEY `createdDate` (`createdDate`),
  KEY `deliveriedDate` (`deliveriedDate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_order_product`;
CREATE TABLE IF NOT EXISTS `eps_order_product` (
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

-- DROP TABLE IF EXISTS `eps_cart`;
CREATE TABLE IF NOT EXISTS `eps_cart` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `product` mediumint(8) UNSIGNED Not null default 0,
  `count` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_address`;
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

-- DROP TABLE IF EXISTS `eps_blacklist`;
CREATE TABLE IF NOT EXISTS  `eps_blacklist` (
  `type` varchar(30) NOT NULL,
  `identity` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `expiredDate` datetime NOT NULL,
  `times` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `identity` (`type`, `identity`, `lang`),
  KEY `expiredDate` (`expiredDate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_operationlog`;
CREATE TABLE IF NOT EXISTS  `eps_operationlog` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `identity` varchar(100) NOT NULL,
  `operation` varchar(200) NOT NULL,
  `count` smallint(5) unsigned not null default 0,
  `createdTime` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  primary key (`id`),
  KEY operation (`type`, `identity`, `operation`, `createdTime`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- Insert data into `eps_layout`;
INSERT INTO `eps_layout` (`page`, `region`, `blocks`, `template`,`lang`) VALUES
('all', 'top', '[{"id":"13","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'top', '[{"id":"5","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'middle', '[{"id":"3","grid":12,"titleless":0,"borderless":0},{"id":"11","grid":4,"titleless":0,"borderless":0},{"id":"1","grid":4,"titleless":0,"borderless":0},{"id":"10","grid":4,"titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'bottom', '[{"id":"12","grid":12,"titleless":0,"borderless":0}]', 'default','zh-cn'),
('company_index', 'side', '[{"id":"10","grid":"","titleless":0,"borderless":0},{"id":"14","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('article_browse', 'side', '[{"id":"6","grid":"","titleless":0,"borderless":0},{"id":"10","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('article_view', 'side', '[{"id":"6","grid":"","titleless":0,"borderless":0},{"id":"10","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('product_browse', 'side', '[{"id":"4","grid":"","titleless":0,"borderless":0},{"id":"7","grid":"","titleless":0,"borderless":0},{"id":"10","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('product_view', 'side', '[{"id":"4","grid":"","titleless":0,"borderless":0},{"id":"7","grid":"","titleless":0,"borderless":0},{"id":"10","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('message_index', 'side', '[{"id":"10","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('blog_index', 'side', '[{"id":"8","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('blog_view', 'side', '[{"id":"8","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('page_index', 'side', '[{"id":"9","grid":"","titleless":0,"borderless":0},{"id":"2","grid":"","titleless":0,"borderless":0},{"id":"10","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('page_view', 'side', '[{"id":"9","grid":"","titleless":0,"borderless":0},{"id":"2","grid":"","titleless":0,"borderless":0},{"id":"10","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('all', 'top', '[{"id":"113","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'top', '[{"id":"105","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'middle', '[{"id":"103","grid":12,"titleless":0,"borderless":0},{"id":"111","grid":4,"titleless":0,"borderless":0},{"id":"101","grid":4,"titleless":0,"borderless":0},{"id":"110","grid":4,"titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'bottom', '[{"id":"112","grid":12,"titleless":0,"borderless":0}]', 'default','en'),
('company_index', 'side', '[{"id":"110","grid":"","titleless":0,"borderless":0},{"id":"114","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('article_browse', 'side', '[{"id":"106","grid":"","titleless":0,"borderless":0},{"id":"110","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('article_view', 'side', '[{"id":"106","grid":"","titleless":0,"borderless":0},{"id":"110","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('product_browse', 'side', '[{"id":"104","grid":"","titleless":0,"borderless":0},{"id":"107","grid":"","titleless":0,"borderless":0},{"id":"110","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('product_view', 'side', '[{"id":"104","grid":"","titleless":0,"borderless":0},{"id":"107","grid":"","titleless":0,"borderless":0},{"id":"110","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('message_index', 'side', '[{"id":"110","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('blog_index', 'side', '[{"id":"108","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('blog_view', 'side', '[{"id":"108","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('page_index', 'side', '[{"id":"109","grid":"","titleless":0,"borderless":0},{"id":"102","grid":"","titleless":0,"borderless":0},{"id":"110","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('page_view', 'side', '[{"id":"109","grid":"","titleless":0,"borderless":0},{"id":"102","grid":"","titleless":0,"borderless":0},{"id":"110","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('all', 'top', '[{"id":"213","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'top', '[{"id":"205","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'middle', '[{"id":"203","grid":12,"titleless":0,"borderless":0},{"id":"211","grid":4,"titleless":0,"borderless":0},{"id":"201","grid":4,"titleless":0,"borderless":0},{"id":"210","grid":4,"titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'bottom', '[{"id":"212","grid":12,"titleless":0,"borderless":0}]', 'default','zh-tw'),
('company_index', 'side', '[{"id":"210","grid":"","titleless":0,"borderless":0},{"id":"214","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('article_browse', 'side', '[{"id":"206","grid":"","titleless":0,"borderless":0},{"id":"210","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('article_view', 'side', '[{"id":"206","grid":"","titleless":0,"borderless":0},{"id":"210","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('product_browse', 'side', '[{"id":"204","grid":"","titleless":0,"borderless":0},{"id":"207","grid":"","titleless":0,"borderless":0},{"id":"210","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('product_view', 'side', '[{"id":"204","grid":"","titleless":0,"borderless":0},{"id":"207","grid":"","titleless":0,"borderless":0},{"id":"210","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('message_index', 'side', '[{"id":"210","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('blog_index', 'side', '[{"id":"208","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('blog_view', 'side', '[{"id":"208","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('page_index', 'side', '[{"id":"209","grid":"","titleless":0,"borderless":0},{"id":"202","grid":"","titleless":0,"borderless":0},{"id":"210","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('page_view', 'side', '[{"id":"209","grid":"","titleless":0,"borderless":0},{"id":"202","grid":"","titleless":0,"borderless":0},{"id":"210","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw');

INSERT INTO `eps_layout` (`template`, `plan`, `page`, `region`, `blocks`, `import`, `lang`) VALUES
('mobile','0','index_index','top','[{"id":"25","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','0','index_index','middle','[{"id":"31","grid":"0","titleless":"0","borderless":"0"},{"id":"23","grid":"12","titleless":"0","borderless":"0"},{"id":"21","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','0','index_index','top','[{"id":"125","grid":"0","titleless":"0","borderless":"0"}]','no','en'),
('mobile','0','index_index','middle','[{"id":"131","grid":"0","titleless":"0","borderless":"0"},{"id":"123","grid":"12","titleless":"0","borderless":"0"},{"id":"121","grid":"0","titleless":"0","borderless":"0"}]','no','en'),
('mobile','0','index_index','top','[{"id":"225","grid":"0","titleless":"0","borderless":"0"}]','no','zh-tw'),
('mobile','0','index_index','middle','[{"id":"231","grid":"0","titleless":"0","borderless":"0"},{"id":"223","grid":"12","titleless":"0","borderless":"0"},{"id":"221","grid":"0","titleless":"0","borderless":"0"}]','no','zh-tw');

UPDATE `eps_layout` SET plan = '0';

-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(1, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'default','zh-cn'),
(2, 'hotArticle', '热门文章', '{"category":"0","limit":"7"}', 'default','zh-cn'),
(3, 'latestProduct', '最新产品', '{"category":"0","limit":"3","image":"show"}', 'default','zh-cn'),
(4, 'hotProduct', '热门产品', '{"category":"0","limit":"3","image":"show"}', 'default','zh-cn'),
(5, 'slide', '幻灯片', '', 'default','zh-cn'),
(6, 'articleTree', '文章分类', '{"showChildren":"0"}', 'default','zh-cn'),
(7, 'productTree', '产品分类', '{"showChildren":"0"}', 'default','zh-cn'),
(8, 'blogTree', '博客分类', '{"showChildren":"1"}', 'default','zh-cn'),
(9, 'pageList', '单页列表', '{"limit":"7"}', 'default','zh-cn'),
(10, 'contact', '联系我们', '', 'default','zh-cn'),
(11, 'about', '公司简介', '', 'default','zh-cn'),
(12, 'links', '友情链接', '', 'default','zh-cn'),
(13, 'header', '网站头部', '', 'default','zh-cn'),
(14, 'followUs', '关注我们', '', 'default','zh-cn');

INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(21, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'mobile','zh-cn'),
(22, 'hotArticle', '热门文章', '{"category":"0","limit":"7"}', 'mobile','zh-cn'),
(23, 'latestProduct', '最新产品', '{"category":"0","limit":"3","image":"show"}', 'mobile','zh-cn'),
(24, 'hotProduct', '热门产品', '{"category":"0","limit":"3","image":"show"}', 'mobile','zh-cn'),
(25, 'slide', '手机版幻灯片', '', 'mobile','zh-cn'),
(26, 'articleTree', '文章分类', '{"showChildren":"0"}', 'mobile','zh-cn'),
(27, 'productTree', '产品分类', '{"showChildren":"0"}', 'mobile','zh-cn'),
(28, 'blogTree', '博客分类', '{"showChildren":"1"}', 'mobile','zh-cn'),
(29, 'pageList', '单页列表', '{"limit":"7"}', 'mobile','zh-cn'),
(30, 'contact', '联系我们', '', 'mobile','zh-cn'),
(31, 'about', '公司简介', '', 'mobile','zh-cn'),
(32, 'links', '友情链接', '', 'mobile','zh-cn'),
(33, 'followUs', '关注我们', '', 'mobile','zh-cn');

INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(101, 'latestArticle', 'Latest Article', '{"category":"0","limit":"7"}', 'default','en'),
(102, 'hotArticle', 'Hot Article', '{"category":"0","limit":"7"}', 'default','en'),
(103, 'latestProduct', 'Latest Product', '{"category":"0","limit":"3","image":"show"}', 'default','en'),
(104, 'hotProduct', 'Hot Product', '{"category":"0","limit":"3","image":"show"}', 'default','en'),
(105, 'slide', 'Slide', '', 'default','en'),
(106, 'articleTree', 'Article Category', '{"showChildren":"0"}', 'default','en'),
(107, 'productTree', 'Product Category', '{"showChildren":"0"}', 'default','en'),
(108, 'blogTree', 'Blog Category', '{"showChildren":"1"}', 'default','en'),
(109, 'pageList', 'Page List', '{"limit":"7"}', 'default','en'),
(110, 'contact', 'Contact Us', '', 'default','en'),
(111, 'about', 'About Us', '', 'default','en'),
(112, 'links', 'Link', '', 'default','en'),
(113, 'header', 'Header', '', 'default','en'),
(114, 'followUs', 'Follow Us', '', 'default','en');

INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(121, 'latestArticle', 'Latest Article', '{"category":"0","limit":"7"}', 'mobile','en'),
(122, 'hotArticle', 'Hot Article', '{"category":"0","limit":"7"}', 'mobile','en'),
(123, 'latestProduct', 'Latest Product', '{"category":"0","limit":"3","image":"show"}', 'mobile','en'),
(124, 'hotProduct', 'Hot Product', '{"category":"0","limit":"3","image":"show"}', 'mobile','en'),
(125, 'slide', 'Mobile Slide', '', 'mobile','en'),
(126, 'articleTree', 'Article Category', '{"showChildren":"0"}', 'mobile','en'),
(127, 'productTree', 'Product Category', '{"showChildren":"0"}', 'mobile','en'),
(128, 'blogTree', 'Blog Category', '{"showChildren":"1"}', 'mobile','en'),
(129, 'pageList', 'Page List', '{"limit":"7"}', 'mobile','en'),
(130, 'contact', 'Contact Us', '', 'mobile','en'),
(131, 'about', 'About Us', '', 'mobile','en'),
(132, 'links', 'Link', '', 'mobile','en'),
(133, 'followUs', 'Follow Us', '', 'mobile','en');

INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(201, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'default','zh-tw'),
(202, 'hotArticle', '熱門文章', '{"category":"0","limit":"7"}', 'default','zh-tw'),
(203, 'latestProduct', '最新產品', '{"category":"0","limit":"3","image":"show"}', 'default','zh-tw'),
(204, 'hotProduct', '熱門產品', '{"category":"0","limit":"3","image":"show"}', 'default','zh-tw'),
(205, 'slide', '幻燈片', '', 'default','zh-tw'),
(206, 'articleTree', '文章分類', '{"showChildren":"0"}', 'default','zh-tw'),
(207, 'productTree', '產品分類', '{"showChildren":"0"}', 'default','zh-tw'),
(208, 'blogTree', '博客分類', '{"showChildren":"1"}', 'default','zh-tw'),
(209, 'pageList', '單頁列表', '{"limit":"7"}', 'default','zh-tw'),
(210, 'contact', '聯繫我們', '', 'default','zh-tw'),
(211, 'about', '公司簡介', '', 'default','zh-tw'),
(212, 'links', '友情鏈接', '', 'default','zh-tw'),
(213, 'header', '網站頭部', '', 'default','zh-tw'),
(214, 'followUs', '關注我們', '', 'default','zh-tw');

INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(221, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'mobile','zh-tw'),
(222, 'hotArticle', '熱門文章', '{"category":"0","limit":"7"}', 'mobile','zh-tw'),
(223, 'latestProduct', '最新產品', '{"category":"0","limit":"3","image":"show"}', 'mobile','zh-tw'),
(224, 'hotProduct', '熱門產品', '{"category":"0","limit":"3","image":"show"}', 'mobile','zh-tw'),
(225, 'slide', '手機版幻燈片', '', 'mobile','zh-tw'),
(226, 'articleTree', '文章分類', '{"showChildren":"0"}', 'mobile','zh-tw'),
(227, 'productTree', '產品分類', '{"showChildren":"0"}', 'mobile','zh-tw'),
(228, 'blogTree', '博客分類', '{"showChildren":"1"}', 'mobile','zh-tw'),
(229, 'pageList', '單頁列表', '{"limit":"7"}', 'mobile','zh-tw'),
(230, 'contact', '聯繫我們', '', 'mobile','zh-tw'),
(231, 'about', '公司簡介', '', 'mobile','zh-tw'),
(232, 'links', '友情鏈接', '', 'mobile','zh-tw'),
(233, 'followUs', '關注我們', '', 'mobile','zh-tw');

INSERT INTO `eps_group` (`id`, `name`, `role`, `desc`, `lang`) VALUES
(1, '管理员', '', '拥有后台所有权限', 'zh-cn'),
(2, '网站编辑', '', '拥有发布以及编辑权限', 'zh-cn'),
(3, '客服', '', '管理论坛留言评论的权限', 'zh-cn');

INSERT INTO `eps_grouppriv` (`group`, `module`, `method`, `lang`) VALUES
(1, 'admin', 'ignore', 'zh-cn'),
(1, 'admin', 'ignoreupgrade', 'zh-cn'),
(1, 'article', 'admin', 'zh-cn'),
(1, 'article', 'create', 'zh-cn'),
(1, 'article', 'edit', 'zh-cn'),
(1, 'article', 'delete', 'zh-cn'),
(1, 'article', 'forward2Forum', 'zh-cn'),
(1, 'article', 'forward2Blog', 'zh-cn'),
(1, 'article', 'check', 'zh-cn'),
(1, 'article', 'reject', 'zh-cn'),
(1, 'article', 'setcss', 'zh-cn'),
(1, 'article', 'setjs', 'zh-cn'),
(1, 'article', 'stick', 'zh-cn'),
(1, 'product', 'admin', 'zh-cn'),
(1, 'product', 'create', 'zh-cn'),
(1, 'product', 'edit', 'zh-cn'),
(1, 'product', 'changeStatus', 'zh-cn'),
(1, 'product', 'currency', 'zh-cn'),
(1, 'product', 'delete', 'zh-cn'),
(1, 'product', 'setcss', 'zh-cn'),
(1, 'product', 'setjs', 'zh-cn'),
(1, 'product', 'setting', 'zh-cn'),
(1, 'book', 'admin', 'zh-cn'),
(1, 'book', 'catalog', 'zh-cn'),
(1, 'book', 'create', 'zh-cn'),
(1, 'book', 'edit', 'zh-cn'),
(1, 'book', 'sort', 'zh-cn'),
(1, 'book', 'delete', 'zh-cn'),
(1, 'forum', 'admin', 'zh-cn'),
(1, 'forum', 'update', 'zh-cn'),
(1, 'reply', 'admin', 'zh-cn'),
(1, 'reply', 'edit', 'zh-cn'),
(1, 'reply', 'delete', 'zh-cn'),
(1, 'reply', 'deleteFile', 'zh-cn'),
(1, 'thread', 'transfer', 'zh-cn'),
(1, 'thread', 'switchStatus', 'zh-cn'),
(1, 'thread', 'delete', 'zh-cn'),
(1, 'thread', 'deleteFile', 'zh-cn'),
(1, 'site', 'setBasic', 'zh-cn'),
(1, 'site', 'setLang', 'zh-cn'),
(1, 'site', 'setRobots', 'zh-cn'),
(1, 'site', 'setUpload', 'zh-cn'),
(1, 'site', 'setOauth', 'zh-cn'),
(1, 'site', 'setRecPerPage', 'zh-cn'),
(1, 'site', 'setsecurity', 'zh-cn'),
(1, 'site', 'setsensitive', 'zh-cn'),
(1, 'nav', 'admin', 'zh-cn'),
(1, 'tag', 'admin', 'zh-cn'),
(1, 'tag', 'link', 'zh-cn'),
(1, 'links', 'admin', 'zh-cn'),
(1, 'mail', 'admin', 'zh-cn'),
(1, 'mail', 'detect', 'zh-cn'),
(1, 'mail', 'edit', 'zh-cn'),
(1, 'mail', 'save', 'zh-cn'),
(1, 'mail', 'test', 'zh-cn'),
(1, 'mail', 'reset', 'zh-cn'),
(1, 'wechat', 'admin', 'zh-cn'),
(1, 'wechat', 'create', 'zh-cn'),
(1, 'wechat', 'integrate', 'zh-cn'),
(1, 'wechat', 'edit', 'zh-cn'),
(1, 'wechat', 'delete', 'zh-cn'),
(1, 'wechat', 'adminResponse', 'zh-cn'),
(1, 'wechat', 'setResponse', 'zh-cn'),
(1, 'wechat', 'deleteResponse', 'zh-cn'),
(1, 'wechat', 'reply', 'zh-cn'),
(1, 'wechat', 'commitMenu', 'zh-cn'),
(1, 'wechat', 'deleteMenu', 'zh-cn'),
(1, 'wechat', 'message', 'zh-cn'),
(1, 'wechat', 'qrcode', 'zh-cn'),
(1, 'group', 'browse', 'zh-cn'),
(1, 'group', 'create', 'zh-cn'),
(1, 'group', 'edit', 'zh-cn'),
(1, 'group', 'copy', 'zh-cn'),
(1, 'group', 'delete', 'zh-cn'),
(1, 'group', 'managePriv', 'zh-cn'),
(1, 'group', 'manageMember', 'zh-cn'),
(1, 'ui', 'setTemplate', 'zh-cn'),
(1, 'ui', 'customTheme', 'zh-cn'),
(1, 'ui', 'setLogo', 'zh-cn'),
(1, 'ui', 'setBaseStyle', 'zh-cn'),
(1, 'ui', 'deleteFavicon', 'zh-cn'),
(1, 'ui', 'deleteLogo', 'zh-cn'),
(1, 'ui', 'others', 'zh-cn'),
(1, 'ui', 'setCode', 'zh-cn'),
(1, 'slide', 'admin', 'zh-cn'),
(1, 'slide', 'create', 'zh-cn'),
(1, 'slide', 'edit', 'zh-cn'),
(1, 'slide', 'delete', 'zh-cn'),
(1, 'slide', 'sort', 'zh-cn'),
(1, 'slide', 'browse', 'zh-cn'),
(1, 'slide', 'createGroup', 'zh-cn'),
(1, 'slide', 'editGroup', 'zh-cn'),
(1, 'slide', 'removeGroup', 'zh-cn'),
(1, 'block', 'admin', 'zh-cn'),
(1, 'block', 'pages', 'zh-cn'),
(1, 'block', 'setregion', 'zh-cn'),
(1, 'block', 'create', 'zh-cn'),
(1, 'block', 'edit', 'zh-cn'),
(1, 'block', 'delete', 'zh-cn'),
(1, 'block', 'switchLayout', 'zh-cn'),
(1, 'block', 'cloneLayout', 'zh-cn'),
(1, 'block', 'removeLayout', 'zh-cn'),
(1, 'block', 'renameLayout', 'zh-cn'),
(1, 'company', 'setbasic', 'zh-cn'),
(1, 'company', 'setcontact', 'zh-cn'),
(1, 'user', 'admin', 'zh-cn'),
(1, 'user', 'edit', 'zh-cn'),
(1, 'user', 'forbid', 'zh-cn'),
(1, 'user', 'adminlog', 'zh-cn'),
(1, 'message', 'admin', 'zh-cn'),
(1, 'message', 'reply', 'zh-cn'),
(1, 'message', 'pass', 'zh-cn'),
(1, 'message', 'delete', 'zh-cn'),
(1, 'package', 'browse', 'zh-cn'),
(1, 'package', 'obtain', 'zh-cn'),
(1, 'package', 'install', 'zh-cn'),
(1, 'package', 'uninstall', 'zh-cn'),
(1, 'package', 'activate', 'zh-cn'),
(1, 'package', 'deactivate', 'zh-cn'),
(1, 'package', 'upload', 'zh-cn'),
(1, 'package', 'erase', 'zh-cn'),
(1, 'package', 'upgrade', 'zh-cn'),
(1, 'package', 'structure', 'zh-cn'),
(1, 'tree', 'browse', 'zh-cn'),
(1, 'tree', 'edit', 'zh-cn'),
(1, 'tree', 'children', 'zh-cn'),
(1, 'tree', 'delete', 'zh-cn'),
(1, 'tree', 'redirect', 'zh-cn'),
(1, 'file', 'browse', 'zh-cn'),
(1, 'file', 'setPrimary', 'zh-cn'),
(1, 'file', 'upload', 'zh-cn'),
(1, 'file', 'download', 'zh-cn'),
(1, 'file', 'edit', 'zh-cn'),
(1, 'file', 'sort', 'zh-cn'),
(1, 'file', 'fileManager', 'zh-cn'),
(1, 'file', 'delete', 'zh-cn'),
(1, 'file', 'sourceBrowse', 'zh-cn'),
(1, 'file', 'sourceDelete', 'zh-cn'),
(1, 'file', 'sourceEdit', 'zh-cn'),
(1, 'file', 'selectImage', 'zh-cn'),
(1, 'file', 'browseSource', 'zh-cn'),
(1, 'search', 'buildIndex', 'zh-cn'),
(1, 'order', 'admin', 'zh-cn'),
(1, 'order', 'delivery', 'zh-cn'),
(1, 'order', 'finish', 'zh-cn'),
(1, 'order', 'pay', 'zh-cn'),
(1, 'order', 'setting', 'zh-cn'),
(1, 'order', 'deliveryInfo', 'zh-cn'),
(1, 'stat', 'traffic', 'zh-cn'),
(1, 'stat', 'from', 'zh-cn'),
(1, 'stat', 'search', 'zh-cn'),
(1, 'stat', 'client', 'zh-cn'),
(1, 'stat', 'keywords', 'zh-cn'),
(1, 'stat', 'keywordReport', 'zh-cn'),
(1, 'stat', 'domainList', 'zh-cn'),
(1, 'stat', 'domainTrend', 'zh-cn'),
(1, 'stat', 'domainPage', 'zh-cn'),
(1, 'stat', 'page', 'zh-cn'),
(1, 'stat', 'ignoreKeyword', 'zh-cn'),
(1, 'score', 'setCounts', 'zh-cn'),
(2, 'file', 'fileManager', 'zh-cn'),
(2, 'file', 'sort', 'zh-cn'),
(2, 'file', 'download', 'zh-cn'),
(2, 'file', 'edit', 'zh-cn'),
(2, 'file', 'upload', 'zh-cn'),
(2, 'file', 'setPrimary', 'zh-cn'),
(2, 'file', 'browse', 'zh-cn'),
(2, 'file', 'sourceBrowse', 'zh-cn'),
(2, 'file', 'sourceDelete', 'zh-cn'),
(2, 'file', 'sourceEdit', 'zh-cn'),
(2, 'file', 'selectImage', 'zh-cn'),
(2, 'file', 'browseSource', 'zh-cn'),
(2, 'ui', 'setTemplate', 'zh-cn'),
(2, 'tag', 'link', 'zh-cn'),
(2, 'site', 'setRecPerPage', 'zh-cn'),
(2, 'links', 'admin', 'zh-cn'),
(2, 'tag', 'admin', 'zh-cn'),
(2, 'nav', 'admin', 'zh-cn'),
(2, 'site', 'setLang', 'zh-cn'),
(2, 'site', 'setBasic', 'zh-cn'),
(2, 'book', 'delete', 'zh-cn'),
(2, 'company', 'setbasic', 'zh-cn'),
(2, 'block', 'delete', 'zh-cn'),
(2, 'block', 'edit', 'zh-cn'),
(2, 'block', 'setregion', 'zh-cn'),
(2, 'block', 'pages', 'zh-cn'),
(2, 'block', 'create', 'zh-cn'),
(2, 'book', 'sort', 'zh-cn'),
(2, 'book', 'edit', 'zh-cn'),
(2, 'ui', 'customTheme', 'zh-cn'),
(2, 'product', 'setcss', 'zh-cn'),
(2, 'product', 'delete', 'zh-cn'),
(2, 'ui', 'setLogo', 'zh-cn'),
(2, 'article', 'admin', 'zh-cn'),
(2, 'article', 'stick', 'zh-cn'),
(2, 'article', 'create', 'zh-cn'),
(2, 'article', 'delete', 'zh-cn'),
(2, 'article', 'edit', 'zh-cn'),
(2, 'article', 'setjs', 'zh-cn'),
(2, 'article', 'setcss', 'zh-cn'),
(2, 'article', 'forward2Forum', 'zh-cn'),
(2, 'article', 'forward2Blog', 'zh-cn'),
(2, 'article', 'check', 'zh-cn'),
(2, 'article', 'reject', 'zh-cn'),
(2, 'book', 'create', 'zh-cn'),
(2, 'book', 'catalog', 'zh-cn'),
(2, 'book', 'admin', 'zh-cn'),
(2, 'product', 'setjs', 'zh-cn'),
(2, 'tree', 'redirect', 'zh-cn'),
(2, 'tree', 'browse', 'zh-cn'),
(2, 'company', 'setcontact', 'zh-cn'),
(2, 'tree', 'delete', 'zh-cn'),
(2, 'tree', 'edit', 'zh-cn'),
(2, 'tree', 'children', 'zh-cn'),
(2, 'block', 'admin', 'zh-cn'),
(2, 'slide', 'sort', 'zh-cn'),
(2, 'product', 'currency', 'zh-cn'),
(2, 'product', 'create', 'zh-cn'),
(2, 'product', 'changeStatus', 'zh-cn'),
(2, 'product', 'edit', 'zh-cn'),
(2, 'product', 'admin', 'zh-cn'),
(2, 'slide', 'delete', 'zh-cn'),
(2, 'ui', 'deleteFavicon', 'zh-cn'),
(2, 'ui', 'setBaseStyle', 'zh-cn'),
(2, 'slide', 'create', 'zh-cn'),
(2, 'slide', 'admin', 'zh-cn'),
(2, 'ui', 'deleteLogo', 'zh-cn'),
(2, 'ui', 'others', 'zh-cn'),
(2, 'slide', 'edit', 'zh-cn'),
(2, 'file', 'delete', 'zh-cn'),
(3, 'message', 'delete', 'zh-cn'),
(3, 'reply', 'delete', 'zh-cn'),
(3, 'message', 'pass', 'zh-cn'),
(3, 'message', 'reply', 'zh-cn'),
(3, 'message', 'admin', 'zh-cn'),
(3, 'thread', 'deleteFile', 'zh-cn'),
(3, 'reply', 'edit', 'zh-cn'),
(3, 'forum', 'admin', 'zh-cn'),
(3, 'reply', 'admin', 'zh-cn'),
(3, 'forum', 'update', 'zh-cn'),
(3, 'article', 'admin', 'zh-cn'),
(3, 'product', 'admin', 'zh-cn'),
(3, 'book', 'catalog', 'zh-cn'),
(3, 'book', 'admin', 'zh-cn'),
(3, 'thread', 'delete', 'zh-cn'),
(3, 'reply', 'deleteFile', 'zh-cn'),
(3, 'thread', 'transfer', 'zh-cn'),
(3, 'thread', 'switchStatus', 'zh-cn');
