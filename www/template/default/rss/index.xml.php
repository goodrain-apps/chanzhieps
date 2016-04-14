<?php if(!defined("RUN_MODE")) die();?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss version="2.0">
<channel>
  <title><?php echo $title;?></title>
  <link><?php echo $siteLink;?></link>
  <description><?php echo $desc;?></description>
  <copyright><?php echo $config->company->name . $config->site->copyright . '-' . date('Y');?></copyright>
  <lastBuildDate><?php echo $lastDate;?></lastBuildDate>
  
  <?php 
  foreach($articles as $article):
    $category = current($article->categories);
    $article->content = str_replace('src="/data/upload/', 'src="' . getWebRoot(true) . 'data/upload/', $article->content);
    $article->content = str_replace("src='/data/upload/", "src='" . getWebRoot(true) . 'data/upload/', $article->content);
  ?>
  <item>
    <title><?php echo $article->title?></title>
    <description><![CDATA[  <?php echo $article->content;?>]]></description>
    <link><?php echo str_replace('&', '&amp;', $siteLink . $this->createLink('blog', 'view', "id=$article->id", "category={$category->alias}&name=$article->alias", 'html'));?></link>
    <category><?php echo $category->name; ?></category>
    <pubDate><?php echo $article->addedDate . ' +0800';?></pubDate>
  </item>
  <?php endforeach;?>
</channel>
</rss>
