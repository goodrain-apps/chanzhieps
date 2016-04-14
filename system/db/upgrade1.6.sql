ALTER TABLE `eps_user` ADD `fails` tinyint unsigned NOT NULL DEFAULT '0' AFTER `last`,
ADD `locked` int(10) unsigned NOT NULL DEFAULT '0' AFTER `fails`;
ALTER TABLE `eps_product` ADD `mall` VARCHAR( 255 ) NOT NULL AFTER `alias`;
ALTER TABLE `eps_file` ADD `editor` ENUM( '0', '1' ) NOT NULL DEFAULT '0' AFTER `primary`;
ALTER TABLE `eps_block` CHANGE `type` `type` VARCHAR( 20 ) NOT NULL;

INSERT INTO `eps_block` (`id`, `type`, `title`, `content`) VALUES
(1, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}'),
(2, 'hotArticle', '热门文章', '{"category":"0","limit":"7"}'),
(3, 'latestProduct', '最新产品', '{"category":"0","limit":"3","image":"show"}'),
(4, 'hotProduct', '热门产品', '{"category":"0","limit":"3","image":"show"}'),
(5, 'slide', '幻灯片', ''),
(6, 'articleTree', '文章分类', '{"showChildren":"0"}'),
(7, 'productTree', '产品分类', '{"showChildren":"0"}'),
(8, 'blogTree', '博客分类', '{"showChildren":"1"}'),
(9, 'contact', '联系我们', ''),
(10, 'about', '公司简介', ''),
(11, 'links', '友情链接', '');

INSERT INTO `eps_layout` (`page`, `region`, `blocks`) VALUES
('index_index', 'header', '5,'),
('index_index', 'bottom', '10,1,9,'),
('index_index', 'footer', '11,'),
('article_browse', 'side', '6,9,'),
('article_view', 'side', '6,9,'),
('product_browse', 'side', '4,7,9,'),
('product_view', 'side', '4,7,9,');
