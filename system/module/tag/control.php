<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of tag module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     tag
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class tag extends control
{
    /**
     * Admin tags.
     * 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function admin($orderBy = 'rank_desc', $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {   
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $tag = $this->post->tag ? $this->post->tag : '';

        $this->view->title   = $this->lang->tag->common;
        $this->view->pager   = $pager;
        $this->view->tags    = $this->tag->getList($tag, $orderBy, $pager);
        $this->view->orderBy = $orderBy;
        $this->display();
    }   

    /**
     * What are the sources of tag.
     * 
     * @param  string   $tag 
     * @access public
     * @return void
     */
    public function source($tag)
    {
        $articles = $this->dao->select('*')->from(TABLE_ARTICLE)->where("concat(',', keywords, ',')")->like("%,{$tag},%")->orderBy('type, id_desc')->fetchAll();
        $products = $this->dao->select('*')->from(TABLE_PRODUCT)->where("concat(',', keywords, ',')")->like("%,{$tag},%")->fetchAll();
        $nodes    = $this->dao->select('*')->from(TABLE_BOOK)->where("concat(',', keywords, ',')")->like("%,{$tag},%")->fetchAll('id');
        $books = $this->dao->select('*')->from(TABLE_BOOK)->fetchAll('id');
        foreach($nodes as $node)
        {
            if($node->type == 'article')
            {
                $path   = explode(',', trim($node->path, ','));
                $bookID = $path[0];
                $node->book = new stdclass();
                $node->book->alias = $books[$bookID]->alias;
            }
        }

        $categories = $this->dao->select('*')->from(TABLE_CATEGORY)->where("concat(',', keywords, ',')")->like("%,{$tag},%")->fetchAll();

        $this->view->title      = $this->lang->tag->source;
        $this->view->articles   = $articles;
        $this->view->products   = $products;
        $this->view->nodes      = $nodes;
        $this->view->categories = $categories;

        $this->display();
    }

    /**
     * Set link for a tag.
     * 
     * @param  int    $tagID 
     * @access public
     * @return void
     */
    public function link($tagID)
    {
        if($_POST)
        {
            $link = fixer::input('post')->stripTags('link', $this->config->allowedTags->admin)->get();
            $this->dao->update(TABLE_TAG)->data($link)->autoCheck()->where('id')->eq($tagID)->exec();
            if(!dao::isError()) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title = "<i class='icon-edit'></i> " . $this->lang->tag->editLink;
        $this->view->tag   = $this->dao->select('*')->from(TABLE_TAG)->where('id')->eq($tagID)->fetch();
        $this->display();
    }
}
