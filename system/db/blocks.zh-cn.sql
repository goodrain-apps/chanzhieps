-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
("block1", 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'default', 'zh-cn'),
("block2", 'hotArticle', '热门文章', '{"category":"0","limit":"7"}', 'default', 'zh-cn'),
("block3", 'latestProduct', '最新产品', '{"category":"0","limit":"3","image":"show"}', 'default', 'zh-cn'),
("block4", 'hotProduct', '热门产品', '{"category":"0","limit":"3","image":"show"}', 'default', 'zh-cn'),
("block5", 'slide', '幻灯片', '', 'default', 'zh-cn'),
("block6", 'articleTree', '文章分类', '{"showChildren":"0"}', 'default', 'zh-cn'),
("block7", 'productTree', '产品分类', '{"showChildren":"0"}', 'default', 'zh-cn'),
("block8", 'blogTree', '博客分类', '{"showChildren":"1"}', 'default', 'zh-cn'),
("block9", 'contact', '联系我们', '', 'default', 'zh-cn'),
("block10", 'about', '公司简介', '', 'default', 'zh-cn'),
("block11", 'links', '友情链接', '', 'default', 'zh-cn'),
("block12", 'header', '网站头部', '', 'default', 'zh-cn'),
("block13", 'followUs', '关注我们', '', 'default', 'zh-cn');

INSERT INTO `eps_layout` (`page`, `region`, `blocks`, `template`,`lang`) VALUES
('all', 'top', '[{"id":"block12","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'top', '[{"id":"block5","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'middle', '[{"id":"block3","grid":12,"titleless":0,"borderless":0},{"id":"block10","grid":4,"titleless":0,"borderless":0},{"id":"block1","grid":4,"titleless":0,"borderless":0},{"id":"block9","grid":4,"titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'bottom', '[{"id":"block11","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('company_index', 'side', '[{"id":"block9","grid":"","titleless":0,"borderless":0},{"id":"block13","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('article_browse', 'side', '[{"id":"block6","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('article_view', 'side', '[{"id":"block6","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('product_browse', 'side', '[{"id":"block4","grid":"","titleless":0,"borderless":0},{"id":"block7","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('product_view', 'side', '[{"id":"block4","grid":"","titleless":0,"borderless":0},{"id":"block7","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('message_index', 'side', '[{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('blog_index', 'side', '[{"id":"block8","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('blog_view', 'side', '[{"id":"block8","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('page_index', 'side', '[{"id":"block2","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('page_view', 'side', '[{"id":"block2","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn');
