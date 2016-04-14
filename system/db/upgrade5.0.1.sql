ALTER TABLE `eps_layout` change `theme` plan char(30) NOT NULL after `page`;
DELETE FROM `eps_grouppriv` where `method` = 'setFavicon';
