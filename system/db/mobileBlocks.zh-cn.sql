-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
("block1", 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'mobile','zh-cn'),
("block2", 'latestProduct', '最新产品', '{"category":"0","limit":"3","image":"show"}', 'mobile','zh-cn'),
("block3", 'slide', '手机版幻灯片', '', 'default','zh-cn'),
("block4", 'articleTree', '文章分类', '{"showChildren":"0"}', 'mobile','zh-cn'),
("block5", 'productTree', '产品分类', '{"showChildren":"0"}', 'mobile','zh-cn'),
("block6", 'pageList', '单页列表', '{"limit":"7"}', 'mobile','zh-cn'),
("block7", 'about', '公司简介', '', 'mobile','zh-cn');

INSERT INTO `eps_layout` (`template`, `theme`, `page`, `region`, `blocks`, `import`, `lang`) VALUES
('mobile','default','index_index','top','[{"id":"block3","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn'),
('mobile','default','index_index','middle','[{"id":"block7","grid":"0","titleless":"0","borderless":"0"},{"id":"block2","grid":"12","titleless":"0","borderless":"0"},{"id":"block1","grid":"0","titleless":"0","borderless":"0"}]','no','zh-cn');
