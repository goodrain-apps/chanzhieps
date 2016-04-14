-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
("block1", 'latestArticle', 'Latest Article', '{"category":"0","limit":"7"}', 'default', 'en'),
("block2", 'hotArticle', 'Hot Article', '{"category":"0","limit":"7"}', 'default', 'en'),
("block3", 'latestProduct', 'Latest Product', '{"category":"0","limit":"3","image":"show"}', 'default', 'en'),
("block4", 'hotProduct', 'Hot Product', '{"category":"0","limit":"3","image":"show"}', 'default', 'en'),
("block5", 'slide', 'Slide', '', 'default', 'en'),
("block6", 'articleTree', 'Article Category', '{"showChildren":"0"}', 'default', 'en'),
("block7", 'productTree', 'Product Category', '{"showChildren":"0"}', 'default', 'en'),
("block8", 'blogTree', 'Blog Category', '{"showChildren":"1"}', 'default', 'en'),
("block9", 'contact', 'Contact Us', '', 'default', 'en'),
("block10", 'about', 'About Us', '', 'default', 'en'),
("block11", 'links', 'Link', '', 'default', 'en'),
("block12", 'header', 'Header', '', 'default', 'en'),
("block13", 'followUs', 'Follow Us', '', 'default', 'en');

INSERT INTO `eps_layout` (`page`, `region`, `blocks`, `template`,`lang`) VALUES
('all', 'top', '[{"id":"block12","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'top', '[{"id":"block5","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'middle', '[{"id":"block3","grid":12,"titleless":0,"borderless":0},{"id":"block10","grid":4,"titleless":0,"borderless":0},{"id":"block1","grid":4,"titleless":0,"borderless":0},{"id":"block9","grid":4,"titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'bottom', '[{"id":"block11","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('company_index', 'side', '[{"id":"block9","grid":"","titleless":0,"borderless":0},{"id":"block13","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('article_browse', 'side', '[{"id":"block6","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('article_view', 'side', '[{"id":"block6","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('product_browse', 'side', '[{"id":"block4","grid":"","titleless":0,"borderless":0},{"id":"block7","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('product_view', 'side', '[{"id":"block4","grid":"","titleless":0,"borderless":0},{"id":"block7","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('message_index', 'side', '[{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('blog_index', 'side', '[{"id":"block8","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('blog_view', 'side', '[{"id":"block8","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('page_index', 'side', '[{"id":"block2","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('page_view', 'side', '[{"id":"block2","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','en');
