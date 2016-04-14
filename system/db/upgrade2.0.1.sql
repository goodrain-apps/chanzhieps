ALTER TABLE eps_layout CHANGE blocks blocks TEXT NOT NULL;
ALTER TABLE `eps_file` ADD `width` smallint unsigned NOT NULL AFTER `size`,
ADD `height` smallint unsigned NOT NULL AFTER `width`;

ALTER TABLE `eps_message` ADD `account` char(30) COLLATE 'utf8_general_ci' NOT NULL AFTER `objectID`;
ALTER TABLE eps_user CHANGE resetKey reset char(64) NOT NULL;
