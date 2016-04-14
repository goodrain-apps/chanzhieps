UPDATE `eps_article` set sticky = '0' where sticky = '';
ALTER TABLE `eps_statreport` change `extra` `extra` text not null;
UPDATE `eps_statlog` as l, `eps_statreferer` as r SET l.link = r.url where l.link = '1' and l.referer = r.id;
