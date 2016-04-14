ALTER TABLE `eps_article` CHANGE `original` `source` varchar(30);
UPDATE `eps_article` SET `source` = 'original' WHERE `source`='0';
UPDATE `eps_article` SET `source` = 'copied'   WHERE `source`='1';
UPDATE `eps_article` SET `source` = 'translational' WHERE `source`='2';
ALTER TABLE `eps_article` CHANGE `source` `source` enum('original','copied','translational') NOT NULL;
ALTER TABLE `eps_category` CHANGE `desc` `desc` text NOT NULL;
