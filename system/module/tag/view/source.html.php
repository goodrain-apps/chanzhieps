<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The source view file of tag of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai<daitingting@xirangit.com>
 * @package     tag
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
  <ul class='list-group'>
    <?php if(!empty($articles)):?>
    <?php foreach($articles as $article):?>
    <li class='list-group-item'>
      <span class='label label-danger'><?php echo $lang->tag->sourceList[$article->type];?></span>
      <?php echo html::a($this->loadModel('article')->createPreviewLink($article->id), $article->title, "target='_blank'");?>
    </li>
    <?php endforeach;?>
    <?php endif;?>

    <?php if($products):?>
    <?php foreach($products as $product):?>
    <li class='list-group-item'>
      <span class='label label-danger'><?php echo $lang->tag->sourceList['product'];?></span>
      <?php echo html::a(commonModel::createFrontLink('product', 'view', "productID=$product->id"), $product->name, "target='_blank'");?>
    </li>
    <?php endforeach;?>
    <?php endif;?>

    <?php if($nodes):?>
    <?php foreach($nodes as $node):?>
    <?php if($node->type != 'article') continue;?>
    <li class='list-group-item'>
      <span class='label label-danger'><?php echo $lang->tag->sourceList['book'];?></span>
      <?php echo html::a(commonModel::createFrontLink('book', 'read', "nodeID=$node->id", "book=$node->book->alias&node=$node->alias"), $node->title, "target='_blank'");?>
    </li>
    <?php endforeach;?>
    <?php endif;?>

    <?php if(!empty($categories)):?>
    <?php foreach($categories as $category):?>
    <li class='list-group-item'>
      <span class='label label-danger'>
        <?php echo $category->type == 'forum' ? $lang->tag->sourceList['board'] : $lang->tag->sourceList['category'];?>
      </span>
      <?php
      $method = 'browse';
      if($category->type == 'forum') $method = 'board';
      if($category->type == 'blog')  $method = 'index';
      echo html::a(commonModel::createFrontLink($category->type, $method, "categoryID={$category->id}", "category={$category->alias}"), $category->name, "target='_blank'");
      ?>
    </li>
    <?php endforeach;?>
    <?php endif;?>
  </ul>
<?php include '../../common/view/footer.modal.html.php';?>
