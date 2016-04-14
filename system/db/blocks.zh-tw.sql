-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
("block1", 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'default', 'zh-tw'),
("block2", 'hotArticle', '熱門文章', '{"category":"0","limit":"7"}', 'default', 'zh-tw'),
("block3", 'latestProduct', '最新產品', '{"category":"0","limit":"3","image":"show"}', 'default', 'zh-tw'),
("block4", 'hotProduct', '熱門產品', '{"category":"0","limit":"3","image":"show"}', 'default', 'zh-tw'),
("block5", 'slide', '幻燈片', '', 'default', 'zh-tw'),
("block6", 'articleTree', '文章分類', '{"showChildren":"0"}', 'default', 'zh-tw'),
("block7", 'productTree', '產品分類', '{"showChildren":"0"}', 'default', 'zh-tw'),
("block8", 'blogTree', '博客分類', '{"showChildren":"1"}', 'default', 'zh-tw'),
("block9", 'contact', '聯繫我們', '', 'default', 'zh-tw'),
("block10", 'about', '公司簡介', '', 'default', 'zh-tw'),
("block11", 'links', '友情鏈接', '', 'default', 'zh-tw'),
("block12", 'header', '網站頭部', '', 'default', 'zh-tw'),
("block13", 'followUs', '關注我們', '', 'default', 'zh-tw');

INSERT INTO `eps_layout` (`page`, `region`, `blocks`, `template`,`lang`) VALUES
('all', 'top', '[{"id":"block12","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'top', '[{"id":"block5","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'middle', '[{"id":"block3","grid":12,"titleless":0,"borderless":0},{"id":"block10","grid":4,"titleless":0,"borderless":0},{"id":"block1","grid":4,"titleless":0,"borderless":0},{"id":"block9","grid":4,"titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'bottom', '[{"id":"block11","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('company_index', 'side', '[{"id":"block9","grid":"","titleless":0,"borderless":0},{"id":"block13","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('article_browse', 'side', '[{"id":"block6","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('article_view', 'side', '[{"id":"block6","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('product_browse', 'side', '[{"id":"block4","grid":"","titleless":0,"borderless":0},{"id":"block7","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('product_view', 'side', '[{"id":"block4","grid":"","titleless":0,"borderless":0},{"id":"block7","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('message_index', 'side', '[{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('blog_index', 'side', '[{"id":"block8","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('blog_view', 'side', '[{"id":"block8","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('page_index', 'side', '[{"id":"block2","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('page_view', 'side', '[{"id":"block2","grid":"","titleless":0,"borderless":0},{"id":"block9","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw');
