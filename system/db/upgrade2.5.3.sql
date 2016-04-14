ALTER TABLE `eps_article` ADD `css` text NOT NULL, ADD `js` text NOT NULL;

ALTER TABLE `eps_product` ADD `css` text NOT NULL, ADD `js` text NOT NULL;

UPDATE eps_product set `order` = `id`;

INSERT INTO eps_config (`owner`, `module`, `section`, `key`, `value`) SELECT 'system', 'common', 'site', 'allowUpload', count(*) as value 
FROM eps_config WHERE module = 'common' and `section` = 'site' and `key` = 'moduleEnabled' and value like '%upload%';

UPDATE eps_config SET value = replace(value, ',upload', '') WHERE module = 'common' AND `section` = 'site' and `key` = 'moduleEnabled';
UPDATE eps_config SET value = replace(value, 'upload,', '') WHERE module = 'common' AND `section` = 'site' and `key` = 'moduleEnabled';

DELETE FROM eps_config WHERE owner = 'system' AND module = 'common' AND section = 'template' AND `key` IN ('name', 'theme', 'customTheme', 'parser'); 
UPDATE eps_config SET section = 'template', `key` = 'name' WHERE owner = 'system' AND module = 'common' AND section = 'site' AND `key` = 'template';
UPDATE eps_config SET section = 'template', `key` = 'theme' WHERE owner = 'system' AND module = 'common' AND section = 'site' AND `key` = 'theme';
UPDATE eps_config SET section = 'template', `key` = 'customTheme' WHERE owner = 'sysTEM' AND module = 'common' AND section = 'site' AND `key` = 'customTheme';
INSERT eps_config SET owner = 'system', module = 'common',  section = 'template', `key` = 'parser', value = 'default';
