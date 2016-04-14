-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
("block1", 'latestArticle', 'Latest Article', '{"category":"0","limit":"7"}', 'mobile','en'),
("block2", 'latestProduct', 'Latest Product', '{"category":"0","limit":"3","image":"show"}', 'mobile','en'),
("block3", 'slide', 'Slides for Mobile', '', 'mobile','en'),
("block4", 'articleTree', 'Article Category', '{"showChildren":"0"}', 'mobile','en'),
("block5", 'productTree', 'Product Category', '{"showChildren":"0"}', 'mobile','en'),
("block6", 'pageList', 'Page List', '{"limit":"7"}', 'mobile','en'),
("block7", 'about', 'About Us', '', 'mobile','en');

INSERT INTO `eps_layout` (`template`, `theme`, `page`, `region`, `blocks`, `import`, `lang`) VALUES
('mobile','default','index_index','top','[{"id":"block3","grid":"0","titleless":"0","borderless":"0"}]','no','en'),
('mobile','default','index_index','middle','[{"id":"block7","grid":"0","titleless":"0","borderless":"0"},{"id":"block2","grid":"12","titleless":"0","borderless":"0"},{"id":"block1","grid":"0","titleless":"0","borderless":"0"}]','no','en');
