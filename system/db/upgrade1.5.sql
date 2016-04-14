ALTER TABLE eps_category CHANGE keyword keywords varchar(150) NOT NULL;
update eps_article set  editedDate = addedDate where editedDate='0000-00-00 00:00:00';
update eps_product set  editedDate = addedDate where editedDate='0000-00-00 00:00:00';
update eps_thread set  editedDate = addedDate where editedDate='0000-00-00 00:00:00';

CREATE TABLE IF NOT EXISTS  `eps_tag` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`),
  KEY `rank` (`rank`),
  KEY `link` (`link`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
