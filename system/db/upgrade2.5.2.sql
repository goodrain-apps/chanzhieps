UPDATE eps_config SET value = concat(value, ',upload') WHERE `key` = 'moduleEnabled' AND value LIKE '%forum%';
